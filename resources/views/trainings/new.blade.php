<!-- resources/views/new.blade.php -->
@extends('..layouts.app')
@section('content')

<div class="card">

    <div class="card-header">
        トレーニング作成
    </div>

    <div class="card-body">
        <!-- バリデーションエラーの 表示 に 使用 -->
        @include('..common.errors')


        <!-- トレーニング 登 録 フォーム -->
        <form action="{{ action('TrainingsController@store') }}" method="POST" class="form-horizontal">
            {{csrf_field()}}

            <div class="form-group">
                <label class="col-sm-3 control-label">トレーニング</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">所要時間</label>
                <div class="col-sm-6">
                    <input type="number" name="duration_minutes" class="form-control"
                            min="1" max="120">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">練習人数目安</label>
                <div class="col-sm-6">
                    <input type="number" name="recomended_person_number" class="form-control"
                            min="1" max="120">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Youtube URL</label>
                <div class="col-sm-6">
                    <input type="text" name="video_url" class="form-control">
                </div>
            </div>

            <div class="form-group">

            @forelse ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id}}">
                    <label class="form-check-label">{{ $tag->name }}</label>
                </div>
            @empty
                タグが登録されていません。
            @endforelse
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>登録
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
