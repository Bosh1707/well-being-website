@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        <div id="chartContainer" style="width: 100%;"></div>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {
 
 var chart = new CanvasJS.Chart("chartContainer", {
     title: {
         text: "YOUR BMI HISTORY"
     },
     axisY: {
         title: "BMI"
     },
     data: [{
         type: "line",
         dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();
  

 
 }



  

</script> 
@endsection