@extends('layouts.page')

@section('title', $post->original_name.' - drib')

@section('content')

    <div id="page" class="shared-file mx-auto py-3">
        <h1 class="text-center mb-5">Download</h1>
        <div class="mb-3">

            @if ($post->category == 'audio')

                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-self-start icon mr-2">
                        <i class="far fa-file-audio"></i>
                    </div>
                    <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                </div>
                <div class="position-relative wavesurfer-audio">
                    <div id="waveform"></div>
                    <div class="d-flex justify-content-center mt-1 mb-2">
                        <button type="button" class="wave-rewind round-button dark text-dark d-flex justify-content-center">
                            <i class="material-icons">fast_rewind</i>
                            <div class="rippleJS"></div>
                        </button>
                        <button type="button" class="wave-play-pause round-button dark text-dark d-flex justify-content-center mx-1">
                            <i class="material-icons">play_arrow</i>
                            <div class="rippleJS"></div>
                        </button>
                        <button type="button" class="wave-forward round-button dark text-dark d-flex justify-content-center">
                            <i class="material-icons">fast_forward</i>
                            <div class="rippleJS"></div>
                        </button>
                    </div>
                    <div class="loader">
                        <div class="position-relative d-flex flex-column justify-content-center align-items-center w-100 h-100">
                            <img src="{{asset('assets/loader-dark.gif')}}" alt="loader">
                        </div>
                    </div>
                </div>

            @elseif ($post->category == 'video')

                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-self-start icon mr-2">
                        <i class="far fa-file-video"></i>
                    </div>
                    <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                </div>
                <div class="mb-2">
                    <video class="player mw-100" src="../../../{{ $post->storage_path }}" playsinline controls></video>
                </div>

            @elseif ($post->category == 'image')

                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-self-start icon mr-2">
                        <i class="far fa-file-image"></i>
                    </div>
                    <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                </div>
                <picture class="position-relative d-block thumbnail text-center mb-2">
                    <img class="mw-100 rounded" src="../../../{{ $post->storage_path }}">
                </picture>
                
            @elseif ($post->category == 'archive')

                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-archive"></i>
                    </div>
                    <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                </div>
                
            @elseif ($post->category == 'document')

                @if ($post->format == 'pdf')

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-pdf"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>
                    
                    
                @elseif ($post->format == 'doc' || $post->format == 'docx')

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-word"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>
                    
                @elseif ($post->format == 'xls' || $post->format == 'xlsx')

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-excel"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>

                @elseif ($post->format == 'ppt' || $post->format == 'pptx')
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-powerpoint"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>

                @else

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>
                    
                @endif
            
            @elseif ($post->category == 'other')

                @if (in_array($post->format, ['php','css','htm','html','js','json','asm','bas','fs','py','luac','cc','pl','nupkg','java','cpp','mm','fmb','swift','perl','d','bal','rpg','graphml','jav','pyc','asic','cxx','pas','x','l','rb','jl','f','lss','styl','jade','pyx','cbl','j','c++','cp','sass','less','scss']))

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file-code"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>
                    
                @else

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-self-start icon mr-2">
                            <i class="far fa-file"></i>
                        </div>
                        <h5 class="font-weight-bold mb-0">{{ $post->original_name }}</h5>
                    </div>
                    
                @endif

            @endif

            <ul class="details list-group list-group-flush">
                <li class="list-group-item d-flex rounded-top border-top-0">
                    <div class="desc">Size</div>
                    <div class="value">{{ $post->size }}</div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="desc">Format</div>
                    <div class="value text-uppercase">{{ $post->format }}</div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="desc">Mimetype</div>
                    <div class="value">{{ $post->mimetype }}</div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="desc">Uploaded</div>
                    <div class="value">
                        {{ date('M d, Y', strtotime($post->created_at)) }}
                        ({{ $post->created_at->diffForHumans() }})
                    </div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="desc">Owner</div>
                    <div class="d-flex justify-content-center align-items-top value">

                        @if (!empty($post->owner_avatar))

                            <img class="rounded-circle mr-1" src="../../../storage/{{ $post->owner_avatar }}" width="25px" height="25px" alt="{{ $post->owner }}">

                        @endif

                        <span>{{ $post->owner }}</span>
                    </div>
                </li>
                <li class="list-group-item d-flex rounded-bottom">
                    <div class="desc">Downloads</div>
                    <div class="value">{{ $post->downloads }}</div>
                </li>
            </ul>
        </div>

        {!! Form::open(['action' => ['PostsController@guestDownload', $post->id, $post->share_token], 'method' => 'POST', 'id' => 'download_form']) !!}
            <button id="download_button" type="button" class="btn btn-dark btn-lg w-100">Download</button>
        {!! Form::close() !!}

    </div>
    
@endsection

@section('page-script')

    @if ($post->category == 'audio')

        <script src="{{ asset('js/vendor9GHCJ726OI99ES8EE325981232V98.js') }}"></script>
        <script>
            $(function() {
                const audioUrl = window.location.origin + '/' + {!! json_encode($post->storage_path) !!};
                wavesurfer.load(audioUrl);
            });
        </script>

    @endif

@endsection
