@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

           
        </div>
    </div> -->
    <div class="row mt-5">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">To do</h5>
                    <p class="card-text">Create your own to do list!</p>
                    <a href="{{url('/todo')}}" class="btn btn-primary">Check My Todos</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Body Mass Index</h5>
                    <p class="card-text">Calculate your BMI and track your progress</p>
                    <a href="{{url('/bmi')}}" class="btn btn-primary">My BMI Progress</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Food Menus</h5>
                    <p class="card-text">Search up recipes and save them for later</p>
                    <a href="{{url('/foodmenu')}}" class="btn btn-primary">Search Food Menus</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection