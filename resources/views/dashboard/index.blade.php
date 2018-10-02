@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">Dashboard</h1>
        <div class="d-flex">
            <button class="grid-view round-button dark text-dark d-flex justify-content-center mr-2
            {{ !Session::has('view') ? 'active'.Session::put('view', 'grid') : Session::get('view') == 'grid' ? 'active' : ''}}"
            type="button" data-view="grid" data-toggle="tooltip" data-placement="bottom" title="Grid View">
                <i class="material-icons">view_module</i>
                <div class="rippleJS"></div>
            </button>
            <button class="list-view round-button dark text-dark d-flex justify-content-center {{ Session::get('view') == 'list' ? 'active' : '' }}" type="button" data-view="list" data-toggle="tooltip" data-placement="bottom" title="List View">
                <i class="material-icons">view_list</i>
                <div class="rippleJS"></div>
            </button>
        </div>
    </div>
    
    @if (count($recentActivity) > 0 OR count($recentlyAdded) > 0)
          
        @if (count($recentActivity) > 0)

            <div class="position-relative">
                <div class="sub-header sticky-top d-flex border-bottom bg-light py-2 mb-3">
                    <h4 class="mb-0">Recent Activities</h4>
                </div>
                <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                    @foreach ($recentActivity as $react)

                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3" data-id="{{$react->id}}">
                            <div class="card" tabindex='1'>
                                <a class="preview-thumb" href="javascript:void(0)" data-for="{{$react->category}}" data-id="{{$react->id}}" data-target="#preview_modal">
                                    <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                        
                                        @if ($react->category == 'audio')
                        
                                            <i class="fas fa-file-audio"></i>
                                            <h4 class="text-uppercase">{{$react->format}}</h4>
                        
                                        @elseif ($react->category == 'video')
                        
                                            <i class="fas fa-file-video"></i>
                                            <h4 class="text-uppercase">{{$react->format}}</h4>
                        
                                        @elseif ($react->category == 'image')
                        
                                            <div class="image-thumb rounded-top" style="background:url(../{{$react->storage_path}}) no-repeat scroll center center / cover;"></div>
                        
                                        @elseif ($react->category == 'archive')
                        
                                            <i class="fas fa-file-archive"></i>
                                            <h4 class="text-uppercase">{{$react->format}}</h4>
                                        
                                        @elseif ($react->category == 'document')

                                            @if ($react->format == 'pdf')
       
                                               <i class="fas fa-file-pdf"></i>
                                               <h4 class="text-uppercase">{{$react->format}}</h4>
                                               
                                            @elseif ($react->format == 'doc' || $react->format == 'docx')
        
                                                <i class="fas fa-file-word"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
        
                                            @elseif ($react->format == 'xls' || $react->format == 'xlsx')
        
                                                <i class="fas fa-file-excel"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
        
                                            @elseif ($react->format == 'ppt' || $react->format == 'pptx')
        
                                                <i class="fas fa-file-powerpoint"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
        
                                            @else
        
                                                <i class="fas fa-file-alt"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
        
                                            @endif
                                       
                                        @elseif ($react->category == 'other')
       
                                            @if (in_array($react->format, ['php','css','htm','html','js','json','asm','bas','fs','py','luac','cc','pl','nupkg','java','cpp','mm','fmb','swift','perl','d','bal','rpg','graphml','jav','pyc','asic','cxx','pas','x','l','rb','jl','f','lss','styl','jade','pyx','cbl','j','c++','cp','sass','less','scss']))
        
                                                <i class="fas fa-file-code"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
                                                
                                            @else
        
                                                <i class="fas fa-file"></i>
                                                <h4 class="text-uppercase">{{$react->format}}</h4>
                                                
                                            @endif
       
                                        @endif
                        
                                    </div>
                                </a>
                                <div class="card-body position-relative px-2 py-2">
                                    <h6 class="card-title text-truncate mb-0">{{$react->original_name}}</h6>
                                    <h6 class="text-truncate text-secondary mt-1 mb-0">{{$react->updated_at->diffForHumans()}}</h6>
                        
                                    @if ($react->category == 'audio')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-audio"></i>
                                        </span> 
                        
                                    @elseif ($react->category == 'video')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-video"></i>
                                        </span> 
                        
                                    @elseif ($react->category == 'image')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-image"></i>
                                        </span> 
                        
                                    @elseif ($react->category == 'archive')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-archive"></i>
                                        </span> 
                                    
                                    @elseif ($react->category == 'document')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </span> 
                                    
                                    @elseif ($react->category == 'other')
                        
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
                                        <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$react->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                            <div class="d-table-cell">Preview</div>
                                        </a>
                                            
                                        @if ($react->shared)
                        
                                            <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$react->id}}" data-share-id="{{$react->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                                <div class="d-table-cell">Share</div>
                                            </a>
                                            <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$react->id}}" data-unshare-id="{{$react->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                                <div class="d-table-cell">Unshare</div>
                                            </a>
                                            <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$react->id}}" data-sharelink-id="{{$react->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                                <div class="d-table-cell">Shared link</div>
                                            </a>
                        
                                        @else
                        
                                            <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$react->id}}" data-share-id="{{$react->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                                <div class="d-table-cell">Share</div>
                                            </a>
                                            <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$react->id}}" data-unshare-id="{{$react->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                                <div class="d-table-cell">Unshare</div>
                                            </a>
                                            <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$react->id}}" data-sharelink-id="{{$react->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                                <div class="d-table-cell">Shared link</div>
                                            </a>
                        
                                        @endif
                        
                                        <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$react->id}}" data-from="main">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                            <div class="d-table-cell">Details</div>
                                        </a>
                        
                                        {!! Form::open(['action' => ['PostsController@userDownload', $react->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                            <div class="d-table-cell">Download</div>
                                            {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                        {!! Form::close() !!}
                        
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$react->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                                            <div class="d-table-cell">Remove</div>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    
                </div>
            </div>
                
        @else

            <h4 class="text-center mt-5">No recent activity.</h1>

        @endif

        @if (count($recentlyAdded) > 0)
            
            <div class="position-relative">
                <div class="sub-header sticky-top d-flex justify-content-between align-items-center border-bottom bg-light py-2 mb-3">
                    <h4 class="mb-0">Recently Added</h4>
                    <a href="/dashboard/recent" class="d-flex text-dark">
                        <h6 class="mb-0 mr-1">See All</h6>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                    @foreach ($recentlyAdded as $readd)

                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3" data-id="{{$readd->id}}">
                            <div class="card" tabindex='1'>
                                <a class="preview-thumb" href="javascript:void(0)" data-for="{{$readd->category}}" data-id="{{$readd->id}}" data-target="#preview_modal">
                                    <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                        
                                        @if ($readd->category == 'audio')
                        
                                            <i class="fas fa-file-audio"></i>
                                            <h4 class="text-uppercase">{{$readd->format}}</h4>
                        
                                        @elseif ($readd->category == 'video')
                        
                                            <i class="fas fa-file-video"></i>
                                            <h4 class="text-uppercase">{{$readd->format}}</h4>
                        
                                        @elseif ($readd->category == 'image')
                        
                                            <div class="image-thumb rounded-top" style="background:url(../{{$readd->storage_path}}) no-repeat scroll center center / cover;"></div>
                        
                                        @elseif ($readd->category == 'archive')
                        
                                            <i class="fas fa-file-archive"></i>
                                            <h4 class="text-uppercase">{{$readd->format}}</h4>
                                        
                                        @elseif ($readd->category == 'document')

                                            @if ($readd->format == 'pdf')
       
                                               <i class="fas fa-file-pdf"></i>
                                               <h4 class="text-uppercase">{{$readd->format}}</h4>
                                                
                                            @elseif ($readd->format == 'doc' || $readd->format == 'docx')
        
                                                <i class="fas fa-file-word"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
        
                                            @elseif ($readd->format == 'xls' || $readd->format == 'xlsx')
        
                                                <i class="fas fa-file-excel"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
        
                                            @elseif ($readd->format == 'ppt' || $readd->format == 'pptx')
        
                                                <i class="fas fa-file-powerpoint"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
        
                                            @else
        
                                                <i class="fas fa-file-alt"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
        
                                            @endif
                                        
                                        @elseif ($readd->category == 'other')
        
                                            @if (in_array($readd->format, ['php','css','htm','html','js','json','asm','bas','fs','py','luac','cc','pl','nupkg','java','cpp','mm','fmb','swift','perl','d','bal','rpg','graphml','jav','pyc','asic','cxx','pas','x','l','rb','jl','f','lss','styl','jade','pyx','cbl','j','c++','cp','sass','less','scss']))
        
                                                <i class="fas fa-file-code"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
                                                
                                            @else
        
                                                <i class="fas fa-file"></i>
                                                <h4 class="text-uppercase">{{$readd->format}}</h4>
                                                
                                            @endif
        
                                        @endif
                        
                                    </div>
                                </a>
                                <div class="card-body position-relative px-2 py-2">
                                    <h6 class="card-title text-truncate mb-0">{{$readd->original_name}}</h6>
                                    <h6 class="text-truncate text-secondary mt-1 mb-0">{{$readd->created_at->diffForHumans()}}</h6>
                        
                                    @if ($readd->category == 'audio')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-audio"></i>
                                        </span> 
                        
                                    @elseif ($readd->category == 'video')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-video"></i>
                                        </span> 
                        
                                    @elseif ($readd->category == 'image')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-image"></i>
                                        </span> 
                        
                                    @elseif ($readd->category == 'archive')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-archive"></i>
                                        </span> 
                                    
                                    @elseif ($readd->category == 'document')
                        
                                        <span class="card-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </span> 
                                    
                                    @elseif ($readd->category == 'other')
                        
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
                                        <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$readd->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                            <div class="d-table-cell">Preview</div>
                                        </a>
                                            
                                        @if ($readd->shared)
                        
                                            <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$readd->id}}" data-share-id="{{$readd->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                                <div class="d-table-cell">Share</div>
                                            </a>
                                            <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$readd->id}}" data-unshare-id="{{$readd->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                                <div class="d-table-cell">Unshare</div>
                                            </a>
                                            <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$readd->id}}" data-sharelink-id="{{$readd->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                                <div class="d-table-cell">Shared link</div>
                                            </a>
                        
                                        @else
                        
                                            <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$readd->id}}" data-share-id="{{$readd->id}}">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                                <div class="d-table-cell">Share</div>
                                            </a>
                                            <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$readd->id}}" data-unshare-id="{{$readd->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                                <div class="d-table-cell">Unshare</div>
                                            </a>
                                            <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$readd->id}}" data-sharelink-id="{{$readd->id}}" style="display: none">
                                                <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                                <div class="d-table-cell">Shared link</div>
                                            </a>
                        
                                        @endif
                        
                                        <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$readd->id}}" data-from="main">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                            <div class="d-table-cell">Details</div>
                                        </a>
                        
                                        {!! Form::open(['action' => ['PostsController@userDownload', $readd->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                            <div class="d-table-cell">Download</div>
                                            {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                        {!! Form::close() !!}
                        
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$readd->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                                            <div class="d-table-cell">Remove</div>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    
                </div>
            </div>
        @else

            <h4 class="text-center mt-5">No recently added files.</h1>

        @endif

    @else

        <div class="text-center">
            <h1 class="my-5">It's lonely here.</h1>
            <img src="{{ asset('assets/dashboard-default.png') }}" width="170px" height="170px" alt="lonely">
            <button type="button" data-toggle="modal" data-target="#upload_modal" class="d-flex justify-content-center align-items-center btn btn-dark btn-lg mx-auto">
                <i class="material-icons mr-2">add</i> Upload
                <div class="rippleJS"></div>
            </button>
        </div>
        
    @endif

@endsection
