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

        @endif
        @foreach ($training->tags as $tag)
            <a class="btn btn-sm btn-outline-info"
               href="{{ action('TrainingsController@index') }}?tag_id={{$tag->id}}">
                {{ $tag->name }}
            </a>
        @endforeach

    </div>
</div>
<div class="row">
    <div class="col-6 col-sm-6 col-md-3 col-lg-4 col-xl-4
                             offset-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
        <h2>手順</h2>
    </div>
</div>
<div class="offset-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">
    <tennis_courts-component
        :training-id="{{$training->id}}"
        :is-display-button="false">
    </tennis_court-component>
</div>

@endsection
