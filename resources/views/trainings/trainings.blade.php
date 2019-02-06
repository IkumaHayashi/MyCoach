<!-- resources/views/trainings.blade.php -->
@extends('..layouts.app')
@section('content')

<div class="row">

    @forelse ($trainings as $training)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 thumbnail-div">

        <figure class="figure-img img-fluid rounded">
            <a href="{{ action('TrainingsController@show', $training->id) }}">
                <img class="img-thumbnail" src="{{ $training->mqdefault_thumbnail_url }}" />
                <figcaption class="figure-caption">
                    {{ $training->title }} <br/>
                    {{ $training->user->name }}
                </figcaption>
            </a>

        </figure>
    </div>
    @empty
        トレーニングが登録されていません。
    @endforelse($training)

</div>


@endsection
