@extends('layouts.app')


@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        {{$error}}
    @endforeach
@endif
    <h1 class="mt-5">Create New To do</h1>
    <form action="todo/store" method="POST">
        @csrf
        <div class="form-group">
        
        <input type="text" id="todo" name="todo" class="form-control" placeholder="Todo Name">
        </div>
        <input type="submit" value="Create a Todo" class="btn btn-primary">
    </form>
@endsection