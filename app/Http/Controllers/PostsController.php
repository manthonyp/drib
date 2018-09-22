<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Post;
use App\User;
use File;
use getID3;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'guestDownload']]);
    }

    public function store(Request $request)
    {
        // handle file upload
        if ($request->hasFile('file')) {
            
            // get user id
            $user_id = auth()->user()->id;

            // request file from form
            $file = $request->file('file');
               
            // get filename
            $filename = $file->getClientOriginalName();

            // get file extension
            $extension = Str::lower(pathinfo($filename, PATHINFO_EXTENSION));

            // get file size
            $fileBytesSize = $file->getClientSize();
            $filesize = sizeConvert($fileBytesSize);

            // determine file type
            if
                (
                    $extension == 'zip'     ||
                    $extension == 'rar'     ||
                    $extension == 'tar'     ||
                    $extension == 'gz'      ||
                    $extension == 'tgz'     ||
                    $extension == '7z'  
                )
            {
                $filetype = 'archive';
            }

            elseif
                (
                    $extension == 'mp3'     ||
                    $extension == 'm4a'     ||
                    $extension == 'wav'     ||
                    $extension == 'flac'    ||
                    $extension == 'ogg'     
                )
            {
                $filetype = 'audio';
            }
            
            elseif
                (
                    $extension == 'mp4'     ||
                    $extension == 'm4v'     ||
                    $extension == 'mkv'     ||
                    $extension == 'flv'     ||
                    $extension == 'ogv'     ||
                    $extension == 'mov'     ||
                    $extension == 'wmv'     ||
                    $extension == 'webm'    ||
                    $extension == 'avi'
                )
            {
                $filetype = 'video';
            }

            elseif
                (
                    $extension == 'jpeg'    ||
                    $extension == 'jpg'     ||
                    $extension == 'bmp'     ||
                    $extension == 'png'     ||
                    $extension == 'gif'     ||
                    $extension == 'svg'     ||
                    $extension == 'ico'     ||
                    $extension == 'tiff'    ||
                    $extension == 'webp'    
                )
            {
                $filetype = 'image';
            }

            elseif
                (
                    $extension == 'pdf'     ||
                    $extension == 'doc'     ||
                    $extension == 'docx'    ||
                    $extension == 'xls'     ||
                    $extension == 'xlsx'    ||
                    $extension == 'ppt'     ||
                    $extension == 'pptx'    ||
                    $extension == 'pps'     
                )
            {
                $filetype = 'document';
            }

            else
            {
                $filetype = 'other';
            }
            
            // rename file
            $newFileName = uniqid().'_'.time().'.'.$extension;

            // public path
            $path = 'public/uploads/'.$user_id;

            // make user directory
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // get mimetype
            $mime =$file->getMimeType();

            // set directory to store
            $storage = 'storage/uploads/'.$user_id.'/'.$newFileName;
            $public = 'public/uploads/'.$user_id.'/'.$newFileName;
            
            // insert to database
            $post = new Post;
            $post->user_id = $user_id;
            $post->original_name = $filename;
            $post->category = $filetype;
            $post->format = $extension;
            $post->mimetype = $mime;
            $post->size = $filesize;
            $post->size_bytes = $fileBytesSize;
            $post->storage_path = $storage;
            $post->public_path = $public;
            $post->save();
            
            // store file
            $file->storeAs($path, $newFileName);

            return response()->json($file);
        }    
    }

    public function shareLink(Request $request)
    {
        // get requested shared url link
        $post = Post::find($request->id);

        return response()->json($post);
    }

    public function getFileInfo(Request $request)
    {
        // get requested shared url link
        $post = Post::find($request->id);

        // update date of modificition
        $post->updated_at = Carbon::now();
        $post->save();

        // set values
        $post->modified = date('M d, Y H:i:s', strtotime($post->updated_at));
        $post->uploaded = date('M d, Y H:i:s', strtotime($post->created_at));
        $post->from = $request->from;

        // get file owner
        $user = User::find($post->user_id);
        $post->owner = $user->name;

        // getID3 instance
        $getID3 = new getID3;
        $getID3->encoding = 'UTF-8';

        // analyze file
        $fileinfo = $getID3->analyze($post->storage_path);

        // check if category is audio
        if ($post->category == 'audio') {

            // get audio tags
            $tags = @$fileinfo['tags'];

            // check if array has value
            if ($tags) {

                // get array value
                foreach ($tags as $tag) {

                    (!empty($tag['title'])) ? $title = $tag['title'] : $title = null;
        
                    (!empty($tag['artist'])) ? $artist = implode(' & ', $tag['artist']) : $artist = null;
        
                    (!empty($tag['album_artist'])) ? $album_artist = $tag['album_artist'] : $album_artist = null;
                    
                    (!empty($tag['album'])) ? $album = $tag['album'] : $album = null;
        
                    (!empty($tag['genre'])) ? $genre = $tag['genre'] : $genre = null;
        
                    (!empty($tag['track_number'])) ? $track_number = $tag['track_number'] : $track_number = null;
        
                    (!empty($tag['disc_number'])) ? $disc_number = $tag['disc_number'] : $disc_number = null;
                    
                    (!empty($tag['copyright'])) ? $copyright = $tag['copyright'] : $copyright = null;
                    
                }

            }

            // check if cover art is present
            if (isset($fileinfo['comments']['picture'][0])) {
                $cover_art = 'data:'.$fileinfo['comments']['picture'][0]['image_mime'].';charset=utf-8;base64,'.base64_encode($fileinfo['comments']['picture'][0]['data']);
            } else {
                $cover_art = null;
            }

            $bitrate = round((@$fileinfo['audio']['bitrate']/1000)).'kbps';
            $playtime = @$fileinfo['playtime_string'];
            $year = @$fileinfo['id3v2']['comments']['year'];

            // set values
            $post->track_title = $title[0];
            $post->track_artist = $artist;
            $post->track_album_artist = $album_artist[0];
            $post->track_album = $album[0];
            $post->track_genre = $genre[0];
            $post->track_year = $year[0];
            $post->track_number = $track_number[0];
            $post->track_disc_number = $disc_number[0];
            $post->track_copyright = $copyright[0];
            $post->track_bitrate = $bitrate;
            $post->track_duration = $playtime;
            $post->track_bitrate = $bitrate;
            $post->track_cover_art = $cover_art;
        }

        elseif ($post->category == 'video') {
            
            $framerate = @$fileinfo['video']['frame_rate'].' frames/second';
            $resx = @$fileinfo['video']['resolution_x'];
            $resy = @$fileinfo['video']['resolution_y'];
            $playtime = @$fileinfo['playtime_string'];
            $bitrate = round((@$fileinfo['video']['bitrate']/1000)).'kbps';

            // set values
            $post->video_framerate = $framerate;
            $post->video_width = $resx;
            $post->video_height = $resy;
            $post->video_duration = $playtime;
            $post->video_bitrate = $bitrate;
        }

        return response()->json($post);
    }

    public function show($id, $share_token)
    {
        // get file requested
        $post = Post::where([['id', $id],['share_token', $share_token]])->firstOrFail();

        // get file owner
        $user = User::find($post->user_id);

        // if not empty
        if (!empty($post)) {

            // if trashed status is not true
            if (!$post->trashed) {

                // if shared status is true
                if ($post->shared) {

                    // set file owner
                    $post->owner = $user->name;
                    
                    return view('pages.share')->with('post', $post);

                } else {
                    return view('errors.denied');
                }
                
            } else {
                return view('errors.removed');
            }

        } else {
            return view('errors.removed');
        }
    }

    public function userDownload($id)
    {
        // get file requested
        $post = Post::where('id', $id)->firstOrFail();

        // check if the file owner is logged in
        if (auth()->user()->id == $post->user_id) {
            
            // update modified date
            $post->updated_at = Carbon::now();
            $post->save();

            return response()->download($post->storage_path, $post->original_name);

        } else {

            return view('errors.denied');

        }
    }

    public function guestDownload($id, $share_token)
    {
        // get file requested
        $post = Post::where([['id', $id], ['share_token', $share_token]])->firstOrFail();

        // if not empty
        if (!empty($post)) {

            // if trashed status is not true
            if (!$post->trashed) {

                // if shared status is true
                if ($post->shared) {
                    
                    // stop timestamps from updating
                    $post->timestamps = false;

                    // increment download count
                    $post->downloads++;
                    $post->save();
                    
                    return response()->download($post->storage_path, $post->original_name);

                } else {
                    return view('errors.denied');
                }
                
            } else {
                return view('errors.removed');
            }

        } else {
            return view('errors.removed');
        }
    }

    public function update(Request $request)
    {
        // get file with id
        $post = Post::find($request->id);

        if ($request->action == 'trash') {
            // set trashed status to true
            $post->trashed = true;
            $post->save();

            return response()->json($post);
        }

        elseif ($request->action == 'restore') {
            // set trashed status to false
            $post->trashed = false;
            $post->save();

            return response()->json($post);
        }

        elseif ($request->action == 'grant') {
            // set shared status to true
            // set share token
            // set share url
            $share_token = str_random(32);
            $post = Post::find($request->id);
            $post->shared = true;
            $post->share_token = $share_token;
            $post->share_url = '/file/shared/'.$post->id.'/'.$share_token;
            $post->save();
    
            return response()->json($post);
        }

        elseif ($request->action == 'revoke') {
            // set shared status to false
            $post = Post::find($request->id);
            $post->shared = false;
            $post->save();

            return response()->json($post);
        }
    }

    public function destroy(Request $request)
    {
        // get file with id
        $post = Post::find($request->id);

        // delete file from storage
        Storage::delete($post->public_path);

        // delete from database
        $post->delete();

        return response()->json($post);
    }

    public function destroyMultiple()
    {
        // get file with id
        $posts = Post::where('user_id', auth()->user()->id)->get(['id', 'public_path', 'trashed']);

        foreach ($posts as $post) {

            if ($post->trashed == true) {
                // delete file from storage
                Storage::delete($post->public_path);

                // delete from database
                $post->delete();
            }
        }
       
        return redirect()->back()->with('success', 'Trash has been cleaned');
    }
}
