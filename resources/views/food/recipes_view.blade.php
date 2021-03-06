@extends('layouts.app')


@section('content')
<div class="row">

    
        @if (\Session::has('message'))
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                {{ \Session::get('message') }}
                </div>
            </div>
            
        @endif
        @if(count($recipes) > 0)
        
 
       
            @foreach($recipes as $recipe)
            
            <div class="col-3 mb-4">
            <div class="card">
            <img src="{{$recipe->image_path}}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{$recipe->label}}</h5>
                    
                    <p class="card-text"> <p>Health Label</p>  
                   
                    @foreach(explode(',', $recipe->healthLabels) as $healthLable) 
                    <span class="mx-1 my-1 badge badge-success"> {{$healthLable}} </span>


                    @endforeach
                        
                    </p><form action="recipes/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$recipe->id}}">
                    
                    <input type="submit" class="btn btn-primary" name="save" value="Remove"></form>
                </div>
            </div>
        </div>


            @endforeach
       
        @else
        <h1 class="text-center">No save recipes</h1>
        <a class="d-block btn btn-link my-4 text-center" href="{{url('/foodmenu')}}">Search a recipe</a>
        @endif
    
</div>
@endsection