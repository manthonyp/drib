@extends('layouts.page')

@section('title', $post->original_name.' - drib')

@section('content')

    <div id="page" class="shared-file mx-auto py-3">
        <h1 class="text-center mb-5">Download</h1>
        <div class="d-flex flex-column mb-5">
            <h4 class="font-weight-bold text-center mb-4">{{$post->original_name}}</h4>
            <div class="d-flex">
                <div class="d-flex flex-column">
                    <div class="position-relative d-flex justify-content-center align-items-center thumbnail mr-3 mb-2">

                        @if ($post->category == 'audio')

                            <i class="far fa-file-audio"></i>

                        @elseif ($post->category == 'video')

                            <i class="far fa-file-video"></i>

                        @elseif ($post->category == 'image')

                            <div class="image-thumb rounded" style="background:url(../../../{{$post->storage_path}}) no-repeat scroll center center / cover;"></div>

                        @elseif ($post->category == 'archive')

                            <i class="far fa-file-archive"></i>
                        
                        @elseif ($post->category == 'document')

                            @if ($post->format == 'pdf')

                                <i class="far fa-file-pdf"></i>
                                
                            @elseif ($post->format == 'doc' || $post->format == 'docx')

                                <i class="far fa-file-word"></i>

                            @elseif ($post->format == 'xls' || $post->format == 'xlsx')

                                <i class="far fa-file-excel"></i>

                            @elseif ($post->format == 'ppt' || $post->format == 'pptx')

                                <i class="far fa-file-powerpoint"></i>

                            @else

                                <i class="far fa-file-alt"></i>

                            @endif
                        
                        @elseif ($post->category == 'other')

                            @if (in_array($post->format, ['php','css','htm','html','js','json','asm','bas','fs','py','luac','cc','pl','nupkg','java','cpp','mm','fmb','swift','perl','d','bal','rpg','graphml','jav','pyc','asic','cxx','pas','x','l','rb','jl','f','lss','styl','jade','pyx','cbl','j','c++','cp','sass','less','scss']))

                                <i class="far fa-file-code"></i>
                                
                            @else

                                <i class="far fa-file"></i>
                                
                            @endif

                        @endif

                    </div>
                    <h5 class="extension text-uppercase text-center">{{$post->format}}</h5>
                </div>
                <div class="d-flex flex-column details w-100">
                    <div class="d-flex border-top border-bottom py-2">
                        <div class="desc">Size</div>
                        <div class="value">{{$post->size}}</div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="desc">Type</div>
                        <div class="value">{{$post->mimetype}}</div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="desc">Uploaded</div>
                        <div class="value">{{$post->created_at->diffForHumans()}}</div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="desc">Owner</div>
                        <div class="d-flex justify-content-center align-items-top value">

                            @if (!empty($post->owner_avatar))

                                <img class="rounded-circle mr-1" src="../../../storage/{{ $post->owner_avatar }}" width="25px" height="25px" alt="{{ $post->owner }}">

                            @endif

                            <span>{{ $post->owner }}</span>
                        </div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="desc">Downloads</div>
                        <div class="value">{{$post->downloads}}</div>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::open(['action' => ['PostsController@guestDownload', $post->id, $post->share_token], 'method' => 'GET']) !!}
            {{Form::submit('Download', ['id' => 'download_button', 'class' => 'btn btn-dark btn-lg w-100', 'data-id' => $post->id, 'data-share-token' => $post->share_token])}}
        {!! Form::close() !!}

    </div>
    
@endsection
