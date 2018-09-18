@extends('layouts.app')

@section('title', 'Admin')

@section('content')

    <div id="admin">
        <h1 class="page-title mb-3">Admin</h1>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Registed Users</h6>
                        <h1 class="text-center">{{$users}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Files Uploaded</h6>
                        <h1 class="text-center">{{$files}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Shared</h6>
                        <h1 class="text-center">{{$shared}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Trashed</h6>
                        <h1 class="text-center">{{$trashed}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Image</h6>
                        <h1 class="text-center">{{$image}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Audio</h6>
                        <h1 class="text-center">{{$audio}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <h6 class="border-bottom pt-1 pb-2">Video</h6>
                        <h1 class="text-center">{{$video}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-6 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <div class="sub-header sticky-top border-bottom bg-white py-2 mb-2">
                            <h6 class="mb-0">Recent Users</h6>
                        </div>
                        <div class="row list">

                            @foreach ($recentUsers as $reus)
                        
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
                                    <div class="card" tabindex='1'>
                                        <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">

                                            @if (!empty($reus->avatar))
                            
                                                <div class="image-thumb rounded-circle" style="background:url(../storage/{{$reus->avatar}}) no-repeat scroll center center / cover;"></div>

                                            @else

                                                <div class="image-thumb rounded-circle" style="background:url('../assets/default-avatar.png') no-repeat scroll center center / cover;"></div>

                                            @endif
                            
                                        </div>
                                        <div class="card-body position-relative px-2 py-2">
                                            <h6 class="text-truncate mb-0">{{$reus->name}}</h6>
                                            <h6 class="text-truncate text-secondary mt-1 mb-0">{{$reus->created_at->diffForHumans()}}</h6>          
                                        </div>
                                    </div>
                                </div>
                            
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-6 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <div class="sub-header sticky-top border-bottom bg-white py-2 mb-2">
                            <h6 class="mb-0">Recently Uploaded</h6>
                        </div>
                        <div class="row list">

                            @foreach ($recentUploads as $reup)
        
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$reup->id}}">
                                    <div class="card" tabindex='1'>
                                        <a class="preview-thumb" href="javascript:void(0)" data-for="{{$reup->category}}" data-id="{{$reup->id}}" data-target="#preview_modal">
                                            <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                                
                                                @if ($reup->category == 'audio')
                                
                                                    <i class="fas fa-file-audio"></i>
                                                    <h4 class="text-uppercase">{{$reup->format}}</h4>
                                
                                                @elseif ($reup->category == 'video')
                                
                                                    <i class="fas fa-file-video"></i>
                                                    <h4 class="text-uppercase">{{$reup->format}}</h4>
                                
                                                @elseif ($reup->category == 'image')
                                
                                                    <div class="image-thumb rounded-top" style="background:url(../{{$reup->storage_path}}) no-repeat scroll center center / cover;"></div>
                                
                                                @elseif ($reup->category == 'archive')
                                
                                                    <i class="fas fa-file-archive"></i>
                                                    <h4 class="text-uppercase">{{$reup->format}}</h4>
                                                
                                                @elseif ($reup->category == 'document')
                                
                                                    <i class="fas fa-file-alt"></i>
                                                    <h4 class="text-uppercase">{{$reup->format}}</h4>
                                                
                                                @elseif ($reup->category == 'other')
                                
                                                    <i class="fas fa-file"></i>
                                                    <h4 class="text-uppercase">{{$reup->format}}</h4>
                                
                                                @endif
                                
                                            </div>
                                        </a>
                                        <div class="card-body position-relative px-2 py-2">
                                            <h6 class="card-title text-truncate mb-0">{{$reup->original_name}}</h6>
                                            <h6 class="text-truncate text-secondary mt-1 mb-0">{{$reup->updated_at->diffForHumans()}}</h6>
                                
                                            @if ($reup->category == 'audio')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-audio"></i>
                                                </span> 
                                
                                            @elseif ($reup->category == 'video')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-video"></i>
                                                </span> 
                                
                                            @elseif ($reup->category == 'image')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-image"></i>
                                                </span> 
                                
                                            @elseif ($reup->category == 'archive')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-archive"></i>
                                                </span> 
                                            
                                            @elseif ($reup->category == 'document')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-alt"></i>
                                                </span> 
                                            
                                            @elseif ($reup->category == 'other')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file"></i>
                                                </span> 
                                
                                            @endif
                                                    
                                        </div>
                                        <div class="card-dropdown rounded-circle">
                                            <button class="dropdown-toggle rounded-circle px-2 py-1" id="cardDropdown" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                                <div class="rippleJS"></div>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cardDropdown">
                                                <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$reup->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                                    <div class="d-table-cell">Preview</div>
                                                </a>
                                                <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$reup->id}}" data-from="main">
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                                    <div class="d-table-cell">Details</div>
                                                </a>
                                
                                                {!! Form::open(['action' => ['PostsController@userDownload', $reup->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                                    <div class="d-table-cell">Download</div>
                                                    {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-12 col-xl-4">
                <div class="item card border rounded mb-4 p-2">
                    <div class="d-flex flex-column">
                        <div class="sub-header sticky-top border-bottom bg-white py-2 mb-2">
                            <h6 class="mb-0">Most Downloads</h6>
                        </div>
                        <div class="row list">

                            @foreach ($recentDownloads as $redl)
                        
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3" data-id="{{$redl->id}}">
                                    <div class="card" tabindex='1'>
                                        <a class="preview-thumb" href="javascript:void(0)" data-for="{{$redl->category}}" data-id="{{$redl->id}}" data-target="#preview_modal">
                                            <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">
                                
                                                @if ($redl->category == 'audio')
                                
                                                    <i class="fas fa-file-audio"></i>
                                                    <h4 class="text-uppercase">{{$redl->format}}</h4>
                                
                                                @elseif ($redl->category == 'video')
                                
                                                    <i class="fas fa-file-video"></i>
                                                    <h4 class="text-uppercase">{{$redl->format}}</h4>
                                
                                                @elseif ($redl->category == 'image')
                                
                                                    <div class="image-thumb rounded-top" style="background:url(../{{$redl->storage_path}}) no-repeat scroll center center / cover;"></div>
                                
                                                @elseif ($redl->category == 'archive')
                                
                                                    <i class="fas fa-file-archive"></i>
                                                    <h4 class="text-uppercase">{{$redl->format}}</h4>
                                                
                                                @elseif ($redl->category == 'document')
                                
                                                    <i class="fas fa-file-alt"></i>
                                                    <h4 class="text-uppercase">{{$redl->format}}</h4>
                                                
                                                @elseif ($redl->category == 'other')
                                
                                                    <i class="fas fa-file"></i>
                                                    <h4 class="text-uppercase">{{$redl->format}}</h4>
                                
                                                @endif
                                
                                            </div>
                                        </a>
                                        <div class="card-body position-relative px-2 py-2">
                                            <h6 class="card-title text-truncate mb-0">{{$redl->original_name}}</h6>
                                            <h6 class="text-truncate text-secondary mt-1 mb-0">Downloads: {{$redl->downloads}}</h6>
                                
                                            @if ($redl->category == 'audio')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-audio"></i>
                                                </span> 
                                
                                            @elseif ($redl->category == 'video')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-video"></i>
                                                </span> 
                                
                                            @elseif ($redl->category == 'image')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-image"></i>
                                                </span> 
                                
                                            @elseif ($redl->category == 'archive')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-archive"></i>
                                                </span> 
                                            
                                            @elseif ($redl->category == 'document')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file-alt"></i>
                                                </span> 
                                            
                                            @elseif ($redl->category == 'other')
                                
                                                <span class="card-icon">
                                                    <i class="fas fa-file"></i>
                                                </span> 
                                
                                            @endif
                                                    
                                        </div>
                                        <div class="card-dropdown rounded-circle">
                                            <button class="dropdown-toggle rounded-circle px-2 py-1" id="cardDropdown" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                                <div class="rippleJS"></div>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cardDropdown">
                                                <a class="dropdown-item preview" href="javascript:void(0)" data-id="{{$redl->id}}" data-from="preview" data-toggle="modal" data-target="#preview_modal">
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-eye"></i></div>
                                                    <div class="d-table-cell">Preview</div>
                                                </a>
                                                <a class="dropdown-item file-showinfo" href="javascript:void(0)" data-id="{{$redl->id}}" data-from="main">
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-info-circle"></i></div>
                                                    <div class="d-table-cell">Details</div>
                                                </a>
                                
                                                {!! Form::open(['action' => ['PostsController@userDownload', $redl->id], 'method' => 'GET', 'class' => 'dropdown-item download-form']) !!}
                                                    <div class="d-table-cell text-center pr-3"><i class="fas fa-download"></i></div>
                                                    <div class="d-table-cell">Download</div>
                                                    {{Form::submit('', ['class' => 'preview-download d-none'])}}
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
