@extends('..layouts.app')
@section('content')

<div class="row">
    <div class="col-10 col-sm-10 col-md-7 col-lg-8 col-xl-8 embed-responsive embed-responsive-16by9
                offset-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
        <iframe class="embed-responsive-item"
            src="{{ $training->embed_video_url }}"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
</div>
<div class="row">
    <h2 class="col-10 col-sm-10 col-md-7 col-lg-8 col-xl-8
               offset-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
        {{ $training->title}}
    </h2>
</div>
<div class="row">
    <div id="favorite_button" class="col-10 col-sm-10 col-md-7 col-lg-8 col-xl-8
                         offset-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
        @if(Auth::check())
        <favorite_button-component training_id={{$training->id}}></favorite_button-component>
        <!--
        <button type="button" id="favorite_button"
                class="btn rounded-circle"
                v-bind:class="{'btn-outline-danger': !isFavorite, 'btn-danger': isFavorite}"
                value="{{$training->id}}" v-on:click="switch_favorite({{$training->id}})" v-bind:disabled="!canPush" >
            <i class="far fa-heart"></i>
        </button>
    -->
        @endif
        @foreach ($training->tags as $tag)
            <a class="btn btn-sm btn-outline-info"
               href="{{ action('TrainingsController@index') }}?tag_id={{$tag->id}}">
                {{ $tag->name }}
            </a>
        @endforeach

    </div>
</div>

@endsection
