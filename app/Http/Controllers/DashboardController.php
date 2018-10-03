<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Post;
use Auth;
use Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        $recentActivity = User::find($id)
                        ->posts()
                        ->where('trashed', false)
                        ->orderby('updated_at', 'desc')
                        ->take(4)
                        ->get();

        $recentlyAdded = User::find($id)
                        ->posts()
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->take(8)
                        ->get();
            
        return view('dashboard.index')
                        ->with('recentActivity', $recentActivity)
                        ->with('recentlyAdded', $recentlyAdded);
    }

    public function all()
    {
        $id = Auth::id();
        $posts = User::find($id)
                        ->posts()
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->paginate(20);
        
        return view('dashboard.all')->with('posts', $posts);
    }

    public function recent()
    {
        $id = Auth::id();
        $date = Carbon::now();

        $postsToday = User::find($id)
                        ->posts()
                        ->where('created_at', '>=', Carbon::today())
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->get();
                
        $postsYesterday = User::find($id)
                        ->posts()
                        ->where('created_at', '>=', Carbon::yesterday())
                        ->where('created_at', '<', Carbon::today())
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->get();

        $postsWeek = User::find($id)
                        ->posts()
                        ->where('created_at', '>=', Carbon::now()->subWeek())
                        ->where('created_at', '<', Carbon::today())
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->get();

        $postsMonth = User::find($id)
                        ->posts()
                        ->where('created_at', '>=',  Carbon::now()->subMonth())
                        ->where('created_at', '<', Carbon::today())
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->get();

        $todayCount = count($postsToday);
        $yesterdayCount = count($postsYesterday);
        $weekCount = count($postsWeek);
        $monthCount = count($postsMonth);
        
        return view('dashboard.recent')
                        ->with('postsToday', $postsToday)
                        ->with('postsYesterday', $postsYesterday)
                        ->with('postsWeek', $postsWeek)
                        ->with('postsMonth', $postsMonth);
    }

    public function shared()
    {
        $id = Auth::id();
        $posts = User::find($id)
                        ->posts()
                        ->where('trashed', false)
                        ->where('shared', true)
                        ->orderby('id', 'desc')
                        ->paginate(20);
        
        return view('dashboard.shared')->with('posts', $posts);
    }

    public function trash()
    {
        $id = Auth::id();
        $posts = User::find($id)
                        ->posts()
                        ->where('trashed', true)
                        ->orderby('id', 'desc')
                        ->paginate(20);
        
        return view('dashboard.trash')->with('posts', $posts);
    }

    public function search(Request $request)
    {
        // get input query
        $query = $request->input('search');

        $this->validate($request , [
            'search' => 'required|string|min:3'
        ]);

        $id = Auth::id();

        // get all models that matched the search query
        $posts = Post::where('original_name', 'like', '%'.$query.'%')
                        ->where('user_id', $id)
                        ->where('trashed', false)
                        ->orderby('id', 'desc')
                        ->take(100)
                        ->get();
        
        $count = count($posts);
        
        return view('dashboard.search')
                        ->with('posts', $posts)
                        ->with('query', $query)
                        ->with('count', $count);
    }

    public function view(Request $request)
    {
        // get input query
        $view = $request->view;

        if ($view == 'grid') {
            // set session view to grid
            Session::put('view', 'grid');
        } else {
            // set session view to list
            Session::put('view', 'list');
        }
    }

    public function admin()
    {
        // get users count
        $users = User::all();
        $users = count($users);

        // get files count
        $files = Post::all();
        $files = count($files);

        // get shared files count
        $shared = Post::where('shared', true)->get();
        $shared = count($shared);

        // get trashed files count
        $trashed = Post::where('trashed', true)->get();
        $trashed = count($trashed);

        // get image files count
        $image = Post::where('category', 'image')->get();
        $image = count($image);

        // get audio files count
        $audio = Post::where('category', 'audio')->get();
        $audio = count($audio);
 
        // get video files count
        $video = Post::where('category', 'video')->get();
        $video = count($video);

        // get latest regsitered users
        $recentUsers = User::latest()
                        ->take(10)
                        ->get();

        // get latest uploads
        $recentUploads = Post::latest()
                        ->take(10)
                        ->get();

        // get most downloaded files
        $recentDownloads = Post::where('downloads', '<>', 0)
                        ->orderby('downloads', 'desc')
                        ->take(10)
                        ->get();

        return view('dashboard.admin')
                        ->with('users', $users)
                        ->with('files', $files)
                        ->with('shared', $shared)
                        ->with('trashed', $trashed)
                        ->with('image', $image)
                        ->with('audio', $audio)
                        ->with('video', $video)
                        ->with('recentUsers', $recentUsers)
                        ->with('recentUploads', $recentUploads)
                        ->with('recentDownloads', $recentDownloads);
    }
}
