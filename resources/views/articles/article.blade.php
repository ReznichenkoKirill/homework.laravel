@extends('layouts.default')
@section('content');

<div class="container">
    <nav class="navbar navbar-default">
        <div class="btn btn-secondary align"><a href="{{route('articles.all')}}">Back</a></div>
    </nav>
</div>
<div class="panel-body ">

    <div class="container w-50">
<table class="table table-striped task-table">
    <tr>
        <td><h2 class="text-center">{{$article->name}}</h2></td>
    </tr>
    <tr>
        <td><p class="text-center">{{$article->description}}</p></td>
    </tr>
</table>
    </div>
</div>

@endsection