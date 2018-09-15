@extends('layouts.app')

@section('title', 'All Files')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">All Files</h1>
        <div class="d-flex align-items-center">
            <h6 class="result-count rounded text-secondary border">Page {{ Request::query('page') === null ? 1 : Request::query('page') }}</h6>
            <button class="grid-view round-button dark text-dark d-flex justify-content-center mr-2 {{ Session::get('view') == 'grid' ? 'active' : '' }}" type="button" data-view="grid" data-toggle="tooltip" data-placement="bottom" title="Grid View">
                <i class="material-icons">view_module</i>
                <div class="rippleJS"></div>
            </button>
            <button class="list-view round-button dark text-dark d-flex justify-content-center {{ Session::get('view') == 'list' ? 'active' : '' }}" type="button" data-view="list" data-toggle="tooltip" data-placement="bottom" title="List View">
                <i class="material-icons">view_list</i>
                <div class="rippleJS"></div>
            </button>
        </div>
    </div>
    
    @if (count($posts) > 0)

        <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

            @foreach ($posts as $post)

                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$post->id}}">
                    <div class="card" tabindex='1'>
                        <a class="preview-thumb" href="javascript:void(0)" data-for="{{$post->category}}" data-id="{{$post->id}}" data-target="#preview_modal">
                            <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">

                                @if ($post->category == 'audio')

                                    <i class="fas fa-file-audio"></i>
                                    <h4 class="text-uppercase">{{$post->format}}</h4>

                                @elseif ($post->category == 'video')

                                    <i class="fas fa-file-video"></i>
                                    <h4 class="text-uppercase">{{$post->format}}</h4>

                                @elseif ($post->category == 'image')

                                    <div class="image-thumb rounded-top" style="background:url(../{{$post->storage_path}}) no-repeat scroll center center / cover;"></div>

                                @elseif ($post->category == 'archive')

                                    <i class="fas fa-file-archive"></i>
                                    <h4 class="text-uppercase">{{$post->format}}</h4>
                                
                                @elseif ($post->category == 'document')

                                    <i class="fas fa-file-alt"></i>
                                    <h4 class="text-uppercase">{{$post->format}}</h4>
                                
                                @elseif ($post->category == 'other')

                                    <i class="fas fa-file"></i>
                                    <h4 class="text-uppercase">{{$post->format}}</h4>

                                @endif

                            </div>
                        </a>
                        <div class="card-body position-relative px-2 py-2">
                            <h6 class="card-title text-truncate mb-0">{{$post->original_name}}</h6>
                            <h6 class="text-truncate text-secondary mt-1 mb-0">{{$post->size}}</h6>

                            @if ($post->category == 'audio')

                                <span class="card-icon">
                                    <i class="fas fa-file-audio"></i>
                                </span> 

                            @elseif ($post->category == 'video')

                                <span class="card-icon">
                                    <i class="fas fa-file-video"></i>
                                </span> 

                            @elseif ($post->category == 'image')

                                <span class="card-icon">
                                    <i class="fas fa-file-image"></i>
                                </span> 

                            @elseif ($post->category == 'archive')

                                <span class="card-icon">
                                    <i class="fas fa-file-archive"></i>
                                </span> 
                            
                            @elseif ($post->category == 'document')

                                <span class="card-icon">
                                    <i class="fas fa-file-alt"></i>
                                </span> 
                            
                            @elseif ($post->category == 'other')

                                <span class="card-icon">
                                    <i class="fas fa-file"></i>
                                </span> 

                            @endif
                                    
                        </div>
                        <div class="card-dropdown dropup rounded-circle">
                            <button class="dropdown-toggle rounded-circle px-2 py-1" id="cardDropdown" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                                <div class="rippleJS"></div>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cardDropdown">
                                <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$post->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                    <div class="d-table-cell">Preview</div>
                                </a>
                                    
                                @if ($post->shared)

                                    <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$post->id}}" data-share-id="{{$post->id}}" style="display: none">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                        <div class="d-table-cell">Share</div>
                                    </a>
                                    <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$post->id}}" data-unshare-id="{{$post->id}}">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                        <div class="d-table-cell">Unshare</div>
                                    </a>
                                    <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$post->id}}" data-sharelink-id="{{$post->id}}">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                        <div class="d-table-cell">Shared link</div>
                                    </a>

                                @else

                                    <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$post->id}}" data-share-id="{{$post->id}}">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                        <div class="d-table-cell">Share</div>
                                    </a>
                                    <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$post->id}}" data-unshare-id="{{$post->id}}" style="display: none">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                        <div class="d-table-cell">Unshare</div>
                                    </a>
                                    <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$post->id}}" data-sharelink-id="{{$post->id}}" style="display: none">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                        <div class="d-table-cell">Shared link</div>
                                    </a>

                                @endif

                                <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$post->id}}" data-from="main">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                    <div class="d-table-cell">Details</div>
                                </a>

                                {!! Form::open(['action' => ['PostsController@userDownload', $post->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                    <div class="d-table-cell">Download</div>
                                    {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                {!! Form::close() !!}

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$post->id}}">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                                    <div class="d-table-cell">Remove</div>
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            
        </div>

    @else

        <h1 class="text-center mt-5">No item found.</h1>
        
    @endif

    {{$posts->links()}}

@endsection
