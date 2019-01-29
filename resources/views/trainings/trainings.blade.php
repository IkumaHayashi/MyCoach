<!-- resources/views/trainings.blade.php -->
@extends('..layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-24 col-md-12 col-lg-12">
        <a href="{{ action('TrainingsController@create') }}">トレーニングを追加する</a>
    </div>
</div>


<div class="row">

    @forelse ($trainings as $training)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 thumbnail-div">

        <figure class="figure-img img-fluid rounded">
            <a href="{{ action('TrainingsController@show', $training->id) }}">
                <img class="img-thumbnail" src="{{ $training->default_thumbnail_url }}" />
                <figcaption class="figure-caption">
                    {{ $training->title }} <br/>
                    {{ $training->user->name }}<br/>

                </figcaption>
            </a>

            <form action="{{ action('TrainingsController@delete', $training->id) }}" method="POST">
                {{csrf_field()}} {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> 削除
                </button>
            </form>
        </figure>
    </div>
    @empty
        トレーニングが登録されていません。
    @endforelse($training)

</div>


@endsection
