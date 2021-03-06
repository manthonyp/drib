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

    /**
     * Storing file to storage and data to database
     *
     * @param Request $request
     * @return void
     */
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

            // check if file will exceed the storage limit
            if (storageSum() + $fileBytesSize > 5368709120) {
                return response()->json(true);
            }

            // set list of extension in an array
            $inArchive = ['zip','rar','tar','gz','tgz','7z'];
            $inAudio = ['mp3','m4a','wav','flac','ogg'];
            $inVideo = ['mp4','m4v','mkv','flv','ogv','mov','wmv','webm','avi'];
            $inImage = ['jpeg','jpg','bmp','png','gif','svg','ico','tiff','webp','jfif'];
            $inDocument = ['pdf','doc','docx','xls','xlsx','ppt','pptx','pps','rtf','epub','odf','ods','pub','txt'];

            // determine file type
            if (in_array($extension, $inArchive)) {
                $filetype = 'archive';
            }

            elseif (in_array($extension, $inAudio)) {
                $filetype = 'audio';
            }
            
            elseif (in_array($extension, $inVideo)) {
                $filetype = 'video';
            }

            elseif (in_array($extension, $inImage)) {
                $filetype = 'image';
            }

            elseif (in_array($extension, $inDocument)) {
                $filetype = 'document';
            }

            else {
                $filetype = 'other';
            }
            
            // rename file
            $newFileName = uniqid().time().'.'.$extension;

            // public path
            $path = 'public/uploads/'.$user_id;

            // get mimetype
            $mime = $file->getMimeType();

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

    /**
     * Get file shareable link
     *
     * @param Request $request
     * @return void
     */
    public function shareLink(Request $request)
    {
        // get requested shared url link
        $post = Post::find($request->id);

        return response()->json($post);
    }

    /**
     * Get file metadata
     *
     * @param Request $request
     * @return void
     */
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
            $bitrate = round((@$fileinfo['bitrate']/1000)).'kbps';

            // set values
            $post->video_framerate = $framerate;
            $post->video_width = $resx;
            $post->video_height = $resy;
            $post->video_duration = $playtime;
            $post->video_bitrate = $bitrate;
        }

        return response()->json($post);
    }

    /**
     * Show shared file
     *
     * @param integer $id
     * @param string $share_token
     * @return void
     */
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
                    $post->owner_avatar = $user->avatar;
                    
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

    /**
     * Download for file owner
     *
     * @param integer $id
     * @return void
     */
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

    /**
     * Download for guest
     *
     * @param integer $id
     * @param string $share_token
     * @return void
     */
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

                    // set response headers
                    $headers =[
                        'Content-Description' => 'File Transfer',
                        'Content-Type' => $post->mimetype,
                    ];
                    
                    return response()->download($post->storage_path, $post->original_name, $headers);

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

    /**
     * Updating file statuses
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $post = Post::find($request->id);

        switch ($request->action) {
            // set file status to trashed
            case 'trash':
                $post->trashed = true;
                $post->save();

                return response()->json($post);
                break;
            
            // untrash file status
            case 'restore':
                $post->trashed = false;
                $post->save();

                return response()->json($post);
                break;
            
            // make file available for sharing
            case 'grant':
                $share_token = str_random(32);
                $post->shared = true;
                $post->share_token = $share_token;
                $post->share_url = '/file/shared/'.$post->id.'/'.$share_token;
                $post->save();
    
                return response()->json($post);
                break;
            
            // make file unavailable for sharing
            case 'revoke':
                $post->shared = false;
                $post->save();

                return response()->json($post);
                break;

            default:
                break;
        }
    }

    /**
     * File deletion
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        Storage::delete($post->public_path);
        $post->delete();

        return response()->json($post);
    }

    /**
     * Multiple file deletion
     *
     * @return void
     */
    public function destroyMultiple()
    {
        $posts = Post::where('user_id', auth()->user()->id)->get(['id', 'public_path', 'trashed']);

        foreach ($posts as $post) {
            if ($post->trashed) {
                Storage::delete($post->public_path);
                $post->delete();
            }
        }
       
        return redirect()->back()->with('success', 'Trash has been cleaned.');
    }
}
