@extends('layouts.app')

@section('title', 'Recently Added')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">Recent</h1>
        <div class="d-flex">
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
        
    @if (count($postsToday) > 0)

        <div class="position-relative">
            <div class="sub-header sticky-top d-flex justify-content-between align-items-center border-bottom bg-light py-2 mb-3">
                <h4 class="mb-0">Today</h4>
                <h6 class="result-count rounded text-secondary border mr-0">{{count($postsToday)}} {{count($postsToday) == 1 ? 'item' : 'items'}}</h6>
            </div>
            <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                @foreach ($postsToday as $today)

                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$today->id}}">
                        <div class="card" tabindex='1'>
                            <a class="preview-thumb" href="javascript:void(0)" data-for="{{$today->category}}" data-id="{{$today->id}}" data-target="#preview_modal">
                                <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                    
                                    @if ($today->category == 'audio')
                    
                                        <i class="fas fa-file-audio"></i>
                                        <h4 class="text-uppercase">{{$today->format}}</h4>
                    
                                    @elseif ($today->category == 'video')
                    
                                        <i class="fas fa-file-video"></i>
                                        <h4 class="text-uppercase">{{$today->format}}</h4>
                    
                                    @elseif ($today->category == 'image')
                    
                                        <div class="image-thumb rounded-top" style="background:url(../{{$today->storage_path}}) no-repeat scroll center center / cover;"></div>
                    
                                    @elseif ($today->category == 'archive')
                    
                                        <i class="fas fa-file-archive"></i>
                                        <h4 class="text-uppercase">{{$today->format}}</h4>
                                    
                                    @elseif ($today->category == 'document')
                    
                                        <i class="fas fa-file-alt"></i>
                                        <h4 class="text-uppercase">{{$today->format}}</h4>
                                    
                                    @elseif ($today->category == 'other')
                    
                                        <i class="fas fa-file"></i>
                                        <h4 class="text-uppercase">{{$today->format}}</h4>
                    
                                    @endif
                    
                                </div>
                            </a>
                            <div class="card-body position-relative px-2 py-2">
                                <h6 class="card-title text-truncate mb-0">{{$today->original_name}}</h6>
                                <h6 class="text-truncate text-secondary mt-1 mb-0">{{$today->size}}</h6>
                    
                                @if ($today->category == 'audio')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-audio"></i>
                                    </span> 
                    
                                @elseif ($today->category == 'video')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-video"></i>
                                    </span> 
                    
                                @elseif ($today->category == 'image')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-image"></i>
                                    </span> 
                    
                                @elseif ($today->category == 'archive')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-archive"></i>
                                    </span> 
                                
                                @elseif ($today->category == 'document')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span> 
                                
                                @elseif ($today->category == 'other')
                    
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
                                    <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$today->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                        <div class="d-table-cell">Preview</div>
                                    </a>
                                        
                                    @if ($today->shared)
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$today->id}}" data-share-id="{{$today->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$today->id}}" data-unshare-id="{{$today->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$today->id}}" data-sharelink-id="{{$today->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @else
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$today->id}}" data-share-id="{{$today->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$today->id}}" data-unshare-id="{{$today->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$today->id}}" data-sharelink-id="{{$today->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @endif
                    
                                    <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$today->id}}" data-from="main">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                        <div class="d-table-cell">Details</div>
                                    </a>
                    
                                    {!! Form::open(['action' => ['PostsController@userDownload', $today->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                        <div class="d-table-cell">Download</div>
                                        {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                    {!! Form::close() !!}
                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$today->id}}">
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
        
    @endif

    @if (count($postsYesterday) > 0)

        <div class="position-relative">
            <div class="sub-header sticky-top d-flex justify-content-between align-items-center border-bottom bg-light py-2 mb-3">
                <h4 class="mb-0">Yesterday</h4>
                <h6 class="result-count rounded text-secondary border mr-0">{{count($postsYesterday)}} {{count($postsYesterday) == 1 ? 'item' : 'items'}}</h6>
            </div>
            <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                @foreach ($postsYesterday as $yesterday)

                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$yesterday->id}}">
                        <div class="card" tabindex='1'>
                            <a class="preview-thumb" href="javascript:void(0)" data-for="{{$yesterday->category}}" data-id="{{$yesterday->id}}" data-target="#preview_modal">
                                <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                    
                                    @if ($yesterday->category == 'audio')
                    
                                        <i class="fas fa-file-audio"></i>
                                        <h4 class="text-uppercase">{{$yesterday->format}}</h4>
                    
                                    @elseif ($yesterday->category == 'video')
                    
                                        <i class="fas fa-file-video"></i>
                                        <h4 class="text-uppercase">{{$yesterday->format}}</h4>
                    
                                    @elseif ($yesterday->category == 'image')
                    
                                        <div class="image-thumb rounded-top" style="background:url(../{{$yesterday->storage_path}}) no-repeat scroll center center / cover;"></div>
                    
                                    @elseif ($yesterday->category == 'archive')
                    
                                        <i class="fas fa-file-archive"></i>
                                        <h4 class="text-uppercase">{{$yesterday->format}}</h4>
                                    
                                    @elseif ($yesterday->category == 'document')
                    
                                        <i class="fas fa-file-alt"></i>
                                        <h4 class="text-uppercase">{{$yesterday->format}}</h4>
                                    
                                    @elseif ($yesterday->category == 'other')
                    
                                        <i class="fas fa-file"></i>
                                        <h4 class="text-uppercase">{{$yesterday->format}}</h4>
                    
                                    @endif
                    
                                </div>
                            </a>
                            <div class="card-body position-relative px-2 py-2">
                                <h6 class="card-title text-truncate mb-0">{{$yesterday->original_name}}</h6>
                                <h6 class="text-truncate text-secondary mt-1 mb-0">{{$yesterday->size}}</h6>
                    
                                @if ($yesterday->category == 'audio')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-audio"></i>
                                    </span> 
                    
                                @elseif ($yesterday->category == 'video')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-video"></i>
                                    </span> 
                    
                                @elseif ($yesterday->category == 'image')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-image"></i>
                                    </span> 
                    
                                @elseif ($yesterday->category == 'archive')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-archive"></i>
                                    </span> 
                                
                                @elseif ($yesterday->category == 'document')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span> 
                                
                                @elseif ($yesterday->category == 'other')
                    
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
                                    <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                        <div class="d-table-cell">Preview</div>
                                    </a>
                                        
                                    @if ($yesterday->shared)
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-share-id="{{$yesterday->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-unshare-id="{{$yesterday->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-sharelink-id="{{$yesterday->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @else
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-share-id="{{$yesterday->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-unshare-id="{{$yesterday->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-sharelink-id="{{$yesterday->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @endif
                    
                                    <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$yesterday->id}}" data-from="main">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                        <div class="d-table-cell">Details</div>
                                    </a>
                    
                                    {!! Form::open(['action' => ['PostsController@userDownload', $yesterday->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                        <div class="d-table-cell">Download</div>
                                        {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                    {!! Form::close() !!}
                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$yesterday->id}}">
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

    @endif

    @if (count($postsWeek) > 0)

        <div class="position-relative">
            <div class="sub-header sticky-top d-flex justify-content-between align-items-center border-bottom bg-light py-2 mb-3">
                <h4 class="mb-0">Earlier this week</h4>
                <h6 class="result-count rounded text-secondary border mr-0">{{count($postsWeek)}} {{count($postsWeek) == 1 ? 'item' : 'items'}}</h6>
            </div>
            <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                @foreach ($postsWeek as $week)

                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$week->id}}">
                        <div class="card" tabindex='1'>
                            <a class="preview-thumb" href="javascript:void(0)" data-for="{{$week->category}}" data-id="{{$week->id}}" data-target="#preview_modal">
                                <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                    
                                    @if ($week->category == 'audio')
                    
                                        <i class="fas fa-file-audio"></i>
                                        <h4 class="text-uppercase">{{$week->format}}</h4>
                    
                                    @elseif ($week->category == 'video')
                    
                                        <i class="fas fa-file-video"></i>
                                        <h4 class="text-uppercase">{{$week->format}}</h4>
                    
                                    @elseif ($week->category == 'image')
                    
                                        <div class="image-thumb rounded-top" style="background:url(../{{$week->storage_path}}) no-repeat scroll center center / cover;"></div>
                    
                                    @elseif ($week->category == 'archive')
                    
                                        <i class="fas fa-file-archive"></i>
                                        <h4 class="text-uppercase">{{$week->format}}</h4>
                                    
                                    @elseif ($week->category == 'document')
                    
                                        <i class="fas fa-file-alt"></i>
                                        <h4 class="text-uppercase">{{$week->format}}</h4>
                                    
                                    @elseif ($week->category == 'other')
                    
                                        <i class="fas fa-file"></i>
                                        <h4 class="text-uppercase">{{$week->format}}</h4>
                    
                                    @endif
                    
                                </div>
                            </a>
                            <div class="card-body position-relative px-2 py-2">
                                <h6 class="card-title text-truncate mb-0">{{$week->original_name}}</h6>
                                <h6 class="text-truncate text-secondary mt-1 mb-0">{{$week->size}}</h6>
                    
                                @if ($week->category == 'audio')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-audio"></i>
                                    </span> 
                    
                                @elseif ($week->category == 'video')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-video"></i>
                                    </span> 
                    
                                @elseif ($week->category == 'image')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-image"></i>
                                    </span> 
                    
                                @elseif ($week->category == 'archive')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-archive"></i>
                                    </span> 
                                
                                @elseif ($week->category == 'document')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span> 
                                
                                @elseif ($week->category == 'other')
                    
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
                                    <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$week->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                        <div class="d-table-cell">Preview</div>
                                    </a>
                                        
                                    @if ($week->shared)
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$week->id}}" data-share-id="{{$week->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$week->id}}" data-unshare-id="{{$week->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$week->id}}" data-sharelink-id="{{$week->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @else
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$week->id}}" data-share-id="{{$week->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$week->id}}" data-unshare-id="{{$week->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$week->id}}" data-sharelink-id="{{$week->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @endif
                    
                                    <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$week->id}}" data-from="main">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                        <div class="d-table-cell">Details</div>
                                    </a>
                    
                                    {!! Form::open(['action' => ['PostsController@userDownload', $week->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                        <div class="d-table-cell">Download</div>
                                        {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                    {!! Form::close() !!}
                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$week->id}}">
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

    @endif

    @if (count($postsMonth) > 0)

        <div class="position-relative">
            <div class="sub-header sticky-top d-flex justify-content-between align-items-center border-bottom bg-light py-2 mb-3">
                <h4 class="mb-0">Earlier this month</h4>
                <h6 class="result-count rounded text-secondary border mr-0">{{count($postsMonth)}} {{count($postsMonth) == 1 ? 'item' : 'items'}}</h6>
            </div>
            <div class="row {{ Session::get('view') == 'list' ? 'list' : '' }}">

                @foreach ($postsMonth as $month)

                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$month->id}}">
                        <div class="card" tabindex='1'>
                            <a class="preview-thumb" href="javascript:void(0)" data-for="{{$month->category}}" data-id="{{$month->id}}" data-target="#preview_modal">
                                <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                    
                                    @if ($month->category == 'audio')
                    
                                        <i class="fas fa-file-audio"></i>
                                        <h4 class="text-uppercase">{{$month->format}}</h4>
                    
                                    @elseif ($month->category == 'video')
                    
                                        <i class="fas fa-file-video"></i>
                                        <h4 class="text-uppercase">{{$month->format}}</h4>
                    
                                    @elseif ($month->category == 'image')
                    
                                        <div class="image-thumb rounded-top" style="background:url(../{{$month->storage_path}}) no-repeat scroll center center / cover;"></div>
                    
                                    @elseif ($month->category == 'archive')
                    
                                        <i class="fas fa-file-archive"></i>
                                        <h4 class="text-uppercase">{{$month->format}}</h4>
                                    
                                    @elseif ($month->category == 'document')
                    
                                        <i class="fas fa-file-alt"></i>
                                        <h4 class="text-uppercase">{{$month->format}}</h4>
                                    
                                    @elseif ($month->category == 'other')
                    
                                        <i class="fas fa-file"></i>
                                        <h4 class="text-uppercase">{{$month->format}}</h4>
                    
                                    @endif
                    
                                </div>
                            </a>
                            <div class="card-body position-relative px-2 py-2">
                                <h6 class="card-title text-truncate mb-0">{{$month->original_name}}</h6>
                                <h6 class="text-truncate text-secondary mt-1 mb-0">{{$month->size}}</h6>
                    
                                @if ($month->category == 'audio')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-audio"></i>
                                    </span> 
                    
                                @elseif ($month->category == 'video')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-video"></i>
                                    </span> 
                    
                                @elseif ($month->category == 'image')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-image"></i>
                                    </span> 
                    
                                @elseif ($month->category == 'archive')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-archive"></i>
                                    </span> 
                                
                                @elseif ($month->category == 'document')
                    
                                    <span class="card-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </span> 
                                
                                @elseif ($month->category == 'other')
                    
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
                                    <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$month->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                        <div class="d-table-cell">Preview</div>
                                    </a>
                                        
                                    @if ($month->shared)
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$month->id}}" data-share-id="{{$month->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$month->id}}" data-unshare-id="{{$month->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$month->id}}" data-sharelink-id="{{$month->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @else
                    
                                        <a class="dropdown-item preview-share" href="javascript:void(0)" data-id="{{$month->id}}" data-share-id="{{$month->id}}">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-link"></i></div>
                                            <div class="d-table-cell">Share</div>
                                        </a>
                                        <a class="dropdown-item preview-unshare" href="javascript:void(0)" data-id="{{$month->id}}" data-unshare-id="{{$month->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-unlink"></i></div>
                                            <div class="d-table-cell">Unshare</div>
                                        </a>
                                        <a class="dropdown-item preview-sharelink" href="javascript:void(0)" data-id="{{$month->id}}" data-sharelink-id="{{$month->id}}" style="display: none">
                                            <div class="d-table-cell text-center pr-3"><i class="fas fa-copy"></i></div>
                                            <div class="d-table-cell">Shared link</div>
                                        </a>
                    
                                    @endif
                    
                                    <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$month->id}}" data-from="main">
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                        <div class="d-table-cell">Details</div>
                                    </a>
                    
                                    {!! Form::open(['action' => ['PostsController@userDownload', $month->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                        <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                        <div class="d-table-cell">Download</div>
                                        {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                    {!! Form::close() !!}
                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item file-trash" href="javascript:void(0)" data-id="{{$month->id}}">
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
        
    @endif

    @if (count($postsToday) < 1 && count($postsYesterday) < 1 && count($postsWeek) < 1 && count($postsMonth) < 1)

        <h1 class="text-center mt-5">No recent item found.</h1>

    @endif

@endsection
