@extends('layouts.page')

@section('title', $post->original_name.' - drib')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto py-3">
            <h1 class="text-center mb-5">Download</h1>
            <h4 class="text-center mb-5">{{$post->original_name}}</h4>
            <div class="d-flex flex-column mb-5">
                <div class="row mb-2 pb-2">
                    <div class="desc col-sm-4 text-secondary">Size</div>
                    <div class="value col-sm-8">{{$post->size}}</div>
                </div>
                <div class="row mb-2 pb-2">
                    <div class="desc col-sm-4 text-secondary">Type</div>
                    <div class="value col-sm-8">{{$post->mimetype}}</div>
                </div>
                <div class="row mb-2 pb-2">
                    <div class="desc col-sm-4 text-secondary">Uploaded</div>
                    <div class="value col-sm-8">{{$post->created_at->diffForHumans()}}</div>
                </div>
                <div class="row flex-wrap mb-2 pb-2">
                    <div class="desc col-sm-4 text-secondary">Owner</div>
                    <div class="value col-sm-8">{{$post->owner}}</div>
                </div>
                <div class="row mb-3">
                    <div class="desc col-sm-4 text-secondary">Downloads</div>
                    <div class="value col-sm-8">{{$post->downloads}}</div>
                </div>
            </div>

            {!! Form::open(['action' => ['PostsController@guestDownload', $post->id, $post->share_token], 'method' => 'GET']) !!}
                {{Form::submit('Download', ['id' => 'download_button', 'class' => 'btn btn-dark btn-lg w-100', 'data-id' => $post->id, 'data-share-token' => $post->share_token])}}
            {!! Form::close() !!}

        </div>
    </div>
    
@endsection
