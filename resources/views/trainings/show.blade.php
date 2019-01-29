@extends('..layouts.app')
@section('content')

<div class="row">
    <h1 class="col-12 col-sm-12 col-md-8 col-lg-8">
        {{ $training->title}}
    </h1>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <button class="btn btn-light rounded-pill" type="button">
            <i class="far fa-heart"></i> お気に入り
        </button>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8 embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item"
            src="{{ $training->embed_video_url }}"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <ul class="list-group">
            @foreach ($training->tags as $tag)
                <li class="list-group-item list-group-item-primary">{{ $tag->name }}</li>
            @endforeach
        </ul>

    </div>
</div>
<div class="row">
    <h2>
        手順
    </h2>
</div>

@endsection
