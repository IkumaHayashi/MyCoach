<!-- resources/views/trainings.blade.php -->
@extends('..layouts.app')
@section('content')

<div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home"></i>
                        トレーニング一覧 <span class="sr-only">(現位置)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-home"></i>
                        コメント一覧
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>保存されたレポート</span>
                <a class="d-flex align-items-center text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        今月
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">管理画面</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">シェア</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">輸出</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    今週
                </button>
            </div>
        </div>


        <h2>投稿済みのトレーニング</h2>

        <a href="{{ action('TrainingsController@create') }}">トレーニングを追加する</a>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th style="width:200px;"></th>
                        <th>作成日</th>
                        <th style="width:100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainings as $training)
                    <tr>
                        <td>
                            <a href="{{ action('TrainingsController@edit', $training->id) }}">
                                <img src="{{ $training->default_thumbnail_url }}" />
                            </a>
                        </td>
                        <td>
                            <a href="{{ action('TrainingsController@edit', $training->id) }}">
                                {{$training->title}}
                            </a>
                        </td>
                        <td>
                            {{$training->created_at->format('Y/m/d')}}
                        </td>
                        <td>

                            <form action="{{ action('TrainingsController@delete', $training) }}" method="POST" class="form-horizontal">
                                {{csrf_field()}} @method("DELETE")
                                <button type="submit" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>&nbsp削除
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>トレーニングが登録されていません。</td>
                    </tr>
                    @endforelse($training)
                </tbody>
            </table>
        </div>
    </main>
</div>



@endsection
