@extends('..layouts.app')
@section('content')

<div class="row">
    <h1 class="col-12 col-sm-12 col-md-8 col-lg-8">
        {{ $training->title}}
    </h1>
    <div id="app" class="col-10 col-sm-10 col-md-4 col-lg-4
                         offset-1 offset-sm-1 offset-md-1 offset-lg-1">

        @if(Auth::check())
        <button type="button" id="favorite_button"
                class="btn rounded-circle"
                v-bind:class="{'btn-outline-danger': !isFavorite, 'btn-danger': isFavorite}"
                value="{{$training->id}}" v-on:click="switch_favorite({{$training->id}})" v-bind:disabled="!canPush" >
            <i class="far fa-heart"></i>
        </button>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-10 col-sm-10 col-md-8 col-lg-8 embed-responsive embed-responsive-16by9
                offset-1 offset-sm-1 offset-md-1 offset-lg-1">
        <iframe class="embed-responsive-item"
            src="{{ $training->embed_video_url }}"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
    <div class="col-10 col-sm-12 col-md-4 col-lg-4
                offset-1 offset-sm-1 offset-md-1 offset-lg-1">
        @foreach ($training->tags as $tag)
            <a class="btn btn-sm btn-outline-info"
               href="{{ action('TrainingsController@index') }}?tag_id={{$tag->id}}">
                {{ $tag->name }}
            </a>
        @endforeach

    </div>
</div>

@endsection
