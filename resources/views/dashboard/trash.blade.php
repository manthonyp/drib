@extends('layouts.app')

@section('title', 'Trash')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">Trash</h1>
        <div class="d-flex">

            @if (count($posts) > 0)

                {!! Form::open(['action' => 'PostsController@destroyMultiple', 'method' => 'POST']) !!}
                    <button class="round-button dark text-dark d-flex justify-content-center mr-2" type="submit" data-toggle="tooltip" data-placement="bottom" title="Clean Trash">
                        <i class="material-icons">delete</i>
                        <div class="rippleJS"></div>
                    </button>
                {!! Form::close() !!}

            @endif

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

                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3" data-id="{{$post->id}}">
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

                                    @if ($post->format == 'pdf')

                                       <i class="fas fa-file-pdf"></i>
                                       <h4 class="text-uppercase">{{$post->format}}</h4>
                                       
                                    @elseif ($post->format == 'doc' || $post->format == 'docx')

                                        <i class="fas fa-file-word"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>

                                    @elseif ($post->format == 'xls' || $post->format == 'xlsx')

                                        <i class="fas fa-file-excel"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>

                                    @elseif ($post->format == 'ppt' || $post->format == 'pptx')

                                        <i class="fas fa-file-powerpoint"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>

                                    @else

                                        <i class="fas fa-file-alt"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>

                                    @endif
                                
                                @elseif ($post->category == 'other')

                                    @if (in_array($post->format, ['php','css','htm','html','js','json','asm','bas','fs','py','luac','cc','pl','nupkg','java','cpp','mm','fmb','swift','perl','d','bal','rpg','graphml','jav','pyc','asic','cxx','pas','x','l','rb','jl','f','lss','styl','jade','pyx','cbl','j','c++','cp','sass','less','scss']))

                                        <i class="fas fa-file-code"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>
                                        
                                    @else

                                        <i class="fas fa-file"></i>
                                        <h4 class="text-uppercase">{{$post->format}}</h4>
                                        
                                    @endif

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
                                <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$post->id}}" data-from="main">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                    <div class="d-table-cell">Details</div>
                                </a>
                                <a class="dropdown-item file-restore" href="javascript:void(0)" data-id="{{$post->id}}">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-clock"></i></div>
                                    <div class="d-table-cell">Restore</div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item file-delete" href="javascript:void(0)" data-id="{{$post->id}}">
                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                                    <div class="d-table-cell">Delete Forever</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            
        </div>

    @else

        <h1 class="text-center mt-5">Trash is empty.</h1>
        
    @endif

    <div class="text-center">
        {{$posts->links()}}
    </div>

@endsection