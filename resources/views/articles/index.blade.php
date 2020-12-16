@extends('layouts.default')
<!-- url к подключаемому файлу -->
@section('content')
<!-- место подключения -->

<div class="panel-body">

@include('common.errors')
<!--подключние ошибок -->

    <form action="{{route('articles.all')}}" method="POST" class="form-horizontal">
        {{csrf_field()}}
{{--    Название статьи--}}
        <div class="form-group">
            <label for="task"
                   class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control">
            </div>
        </div>
{{--        Описание статьи--}}
        <div class="form-group">
            <label for="task"
                   class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
<!--    Кнопка добавления контента -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить
                </button>
            </div>
        </div>
    </form>
</div>

@if(count($articles) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Текущая задача
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td class="table-text">
                            <a href="{{route('articles.item', $article->id)}}">{{ $article->name }}</a>
                            {{$article->id}}
                        </td>

                        <td>
                            <form method="POST" action="{{route('articles.delete', $article->id)}}"> <!-- $tasks->id - это ходящее значение для Route::delete -->
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
{{--                        method_field('TYPE') определяет метод передачи, без него не сработает Route::delete --}}
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
<!--конец секции -->