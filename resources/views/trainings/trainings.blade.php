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
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!--テーブル本体--->
            <tbody>
                @foreach($trainings as $training)
                    <tr>
                        <td class="table-text">
                            <div>{{ $training->Title}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->DurationMinutes}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->RecomendedPersonNumber}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $training->VideoUrl}}</div>
                        </td>

                        <td>
                            <form action="{{ url('training/edit/'.$training->id)}}" method="GET">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> 編集
                                </button>
                            </form>
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
