<!-- resources/views/trainings.blade.php -->
@extends('..layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        トレーニング一覧
    </div>

    <div class="card-body">
        <div class="row">
            <a href="{{ action('TrainingsController@new') }}">トレーニングを追加する</a>
        </div>

        @if(count($trainings) == 0)
            <div class="row">
                トレーニングが登録されていません。
            </div>
        @else

        <table class="table table-stripe task-table">
            <!--テーブルヘッダ-->
            <thead>
                <th>タイトル</th>
                <th>所要時間</th>
                <th>練習人数目安</th>
                <th>Youtube URL</th>
                <th>投稿者</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!--テーブル本体--->
            <tbody>
                @foreach($trainings as $training)
                    <tr>
                        <td class="table-text">
                            <div>{{ $training->title }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->duration_minutes }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->recomended_person_number }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->video_url }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->user->name }}</div>
                        </td>

                        <td>
                            <button class="btn btn-primary"
                                    onClick="location.href='{{ url('trainings/'.$training->id.'/edit')}}'">
                                <i class="fas fa-edit"></i> 編集
                            </button>
                        </td>
                        <td>
                            <form action="{{ url('training/'.$training->id)}}" method="POST">
                                {{csrf_field()}} {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> 削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>

        @endif
    </div>
</div>

@endsection
