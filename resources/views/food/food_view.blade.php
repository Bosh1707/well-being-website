@extends('layouts.app')


@section('content')

<h1>Food Menu Search</h1>


@if(session('message'))
<div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

@endif

<div class="row">
    <div class="col-8">
        <input type="text" class="form-inline form-control" id="searchInput">
    </div>
    <div class="col-4">
        <button id="searchbutton" class="btn btn-danger">search</button>
    </div>
</div>

<div class="row my-4" id="searchResult">



</div>


</div>
<!-- Modal -->
<div class="modal fade" id="moreDetail" tabindex="-1" aria-labelledby="moreDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="moreDetailLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Ingredients</h3>
        <p id="ingredientLines"></p>
        <table class="table">
        <thead>
            <tr><th>Nutrient Type</th><th>Quantity</th></tr>
        </thead>
        <tbody id="foodNutrient">
            
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>





@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
<script>
    $(function() {
        $('#btn-save').hide();
        $('#btn-cal').on('click', function(e) {
            // prevent submitting form
            e.preventDefault()
            var height = $('#height').val();
            var weight = $('#weight').val();

            var val = weight / (height * height)
            var bmi = val.toFixed(2);
            if (!isNaN(bmi)) {
                $('#btn-save').show();
            }
            $('#bmi-value').val(bmi)

        });
        $('#btn-clear').on('click', function(e) {
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

    // passes js document object and executes "ready" method/function to check whether a document is fully loaded
    // In ready function we execute a function (anonymous function -> no name) 
    // querySelctor method will search through document for the given id name 

    $(document).ready(function() {
        let searchbutton = document.querySelector('#searchbutton');

        // searchbutton.addEventListener("click",()=>{
        //     // console.log('button click');
        //     let searchText = searchInput.value;
        //     searchApiRequest(searchText);
        // });
        $('#searchbutton').on('click', function() {
            let searchText = searchInput.value;
            searchApiRequest(searchText);
        })
    });

    async function searchApiRequest(searchText) {
        let APP_ID = '216b45d0';
        let APP_KEY = '4c729314227659979dd773cf626a099b';
        let responce = await fetch(`https://api.edamam.com/search?app_id=${APP_ID}&app_key=${APP_KEY}&q=${searchText}`);
        console.log(responce);
        let data = await responce.json();
        // console.log(data);
        useApiData(data);
    }

    function useApiData(data) {
        // console.log(data.hits);
        let list = '';
        for (let item of data.hits) {
            console.log(JSON.stringify(item.recipe.totalNutrients));
            // item.recipe.totalNutrients.map(nutrients=>nutrients).join("|")
            list += `
            <div class="col-3 mb-4">
            <div class="card">
            <img src="${item.recipe.image}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">${item.recipe.label}</h5>
  


                
                <p class="card-text"> <p>Health Label</p>  ${item.recipe.healthLabels.map(food => `<span class="mx-1 my-1 badge badge-success">${food}</span>`).join("")}
                    
                </p><form action="foodmenu/save" method="POST">
                @csrf
                <input type="hidden" name="label" value="${item.recipe.label}">
                <input type="hidden" name="image_path" value="${item.recipe.image}">
                <input type="hidden" name="healthLabels" value="${item.recipe.healthLabels}">
                
                <input type="submit" class="btn btn-primary" name="save" value="Save"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#moreDetail" data-foodinfo= \'${JSON.stringify(item.recipe.totalNutrients)}\' data-foodtitle="${item.recipe.label}" data-ingredient="${item.recipe.ingredientLines}">More</button></form>
                
               
            </div>
        </div>
        </div>`;
        }
        searchResult.innerHTML = list;
    }


    $(document).on('show.bs.modal','#moreDetail', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  let title = button.data('foodtitle');
  let foodNutrients = button.data('foodinfo');
  let nutrients = button.data('totalNutrients');
  let ingredients = button.data('ingredient'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

let properties = Object.keys(foodNutrients);
let nutrientList=null;
for(let property of properties){
    // console.log(property);
    nutrientList += '<tr><td>'+ foodNutrients[property].label +'</td><td>'+foodNutrients[property].quantity + ' ' + foodNutrients[property].unit  +'</td></tr>';
}

// let nutrients = totalNutrients.split(',');

// for(nutrient of nutrients){
//     console.log(nutrient);
// }
  var modal = $(this)
   modal.find('.modal-title').text(title);
  modal.find('.modal-body #ingredientLines').text(ingredients);
  modal.find('.modal-body #foodNutrient').append(nutrientList);
})
</script>