@extends('layouts.app')


@section('content')
<div class="container">
<h1>BMI Calculator</h1>
<a href="chart">view my bmi history</a>
<div class="col-md-6">
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
 
@endif
<form action="bmi" method="post" id="frm-bmi">
{{csrf_field()}}
<div>
<div class="form-group">
    <label for="mass">Mass (kg)</label>
    <input type="number" class="form-control" id="weight" name="weight" step="any" placeholder="">
</div>
<div class="form-group">
    <label for="height">Height (m)</label>
    <input type="number" class="form-control" id="height" name="height" step="any"  placeholder="">
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="">
</div>
<div class="form-group">
    <label for="bmi">BMI</label>
    <input type="number" readonly class="form-control" id="bmi-value" name="bmi"  placeholder="">
</div>
<div class="form-group">
    <label for="bmi">Your BMI Class: </label>
    <label id="bmi-class" class="badge"></label>
</div>
<div class="form-group">
<button class="btn btn-primary" id="btn-cal">Calculate</button>
<button class="btn btn-default" id="btn-clear" >Clear</button>
</div>
</div>
<div class="form-group">
<input type="submit"  class="btn btn-success" style="display: none;" id="btn-save" value="Save">
</div>
</form>


</div>

</div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
$(function(){
    $('#btn-save').hide();
    $('#btn-cal').on('click',function(e){
        // prevent submitting form
        e.preventDefault()
        var height = $('#height').val();
        var weight = $('#weight').val();
        var bmiClass;
        var color;

        var val = weight / (height * height)
        var bmi = val.toFixed(2);
        if(!isNaN(bmi)){
            $('#btn-save').show();
        }
        $('#bmi-value').val(bmi);
        
        
        if(bmi < 18.5){
            bmiClass = 'Under weight';
            color = 'badge badge-primary';
        }else if(bmi < 24.9){
            bmiClass = 'Normal';
            color = 'badge badge-success';
        }else if(bmi < 29.9){
            bmiClass = 'Overweight';
            color = 'badge badge-warning';
        }else if(bmi < 34.9){
            bmiClass = 'OBESE';
            color = 'badge badge-light';
        }else if(bmi > 35){
            bmiClass = 'extremly OBESE';
            color = 'badge badge-danger';
        }
        $('#bmi-class').removeClass();
        $('#bmi-class').addClass(color);
        
        $('#bmi-class').text(bmiClass);

    });
    $('#btn-clear').on('click',function(e){
        e.preventDefault()
        $('#height').val('');
        $('#weight').val('');
        $('#bmi-value').val('');
        $('#date').val('');
        $('#btn-save').hide();
    });


    setTimeout(function() {
        $(".alert").hide();
    }, 5000);
    // $('#btn-save').on('click',function(e){
    //     document.getElementById("frm-bmi").submit();
    // });
});
</script> 