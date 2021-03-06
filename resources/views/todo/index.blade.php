@extends('layouts.app')


@section('content')
<div class="row">

    <div class="col-12">
        @if (\Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{ \Session::get('success') }}
            </div>
        @endif
        @if(count($todos) > 0)
        <h1 class="mt-4">To do List</h1>
        <a class="btn btn-danger mb-4 float-right" href="{{url('/create')}}">Add New Todo</a>
        <table class='table'>
            <thead>
                <tr>
                    <th>ToDo Name</th>
                    <th>Completed</th>
                    <th>Action</th>
                </tr>
                @foreach($todos as $todo)
            <tbody>
                <tr>
                    <td>{{$todo->name}}</td>
                    <td>
                        @if($todo->complete == 0)
                        <span>Pending</span>
                        @else
                        <span>Complete</span>

                        @endif
                    </td>
                    <td>
                        @if($todo->complete == 0)
                        <form action="todo/update" method="POST" class="forms-inline">
                            @csrf

                            <input value="{{$todo->id}}" type="hidden" name="todoId">
                            <input class="btn btn-success btn-sm" type="submit" name="complete" value="Complete">


                        </form>





                        @else

                        <form action="todo/update" method="POST" class="forms-inline">
                            @csrf

                            <input value="{{$todo->id}}" type="hidden" name="todoId">
                            <input class="btn btn-primary btn-sm" type="submit" name="complete" value="Incomplete">

                        </form>

                        @endif

                        <form action="todo/update" method="POST" class="forms-inline">
                            @csrf

                            <input value="{{$todo->id}}" type="hidden" name="todoId">


                            <input class="btn btn-danger btn-sm" type="submit" name="complete" value="Delete">
                        </form>

                    </td>
                </tr>
            </tbody>


            @endforeach
        </table>
        @else
        <h1 class="text-center">No to do's available yet</h1>
        <a class="d-block btn btn-link my-4 text-center" href="{{url('/create')}}">Create new Todo</a>
        @endif
    </div>
</div>
@endsection