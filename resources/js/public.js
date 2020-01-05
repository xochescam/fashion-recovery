(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {

        if (form.checkValidity() === false) {

            event.preventDefault();
            event.stopPropagation();

        } else if(form.checkValidity() ) {

            const button = form.querySelector('.btn');
            const spin = button.querySelector('span');

            button.setAttribute('disabled','true');
            spin.classList.remove('hidden');
            spin.style.display = 'inline-flex';

        }

        form.classList.add('was-validated');

      }, false);
    });
  }, false);
})();


function checkDep() {
  const departments       = document.querySelectorAll('.departments-filters');

  var checked = document.querySelector('.departments-filters:checked');

  Array.prototype.forEach.call(departments, (dep) => {

    if(!checked) {
      dep.parentNode.classList.remove('hidden');
      return;
    }

    if(dep.checked) {

      dep.parentNode.classList.remove('hidden');

    } else {

      dep.parentNode.classList.add('hidden');
    }
  });
}

function checkTypes() {
  const clothingTypes     = document.querySelectorAll('.clothingTypes-filters');

  var checked = document.querySelector('.clothingTypes-filters:checked');

  Array.prototype.forEach.call(clothingTypes, (types) => {            

    if(!checked) {
      types.parentNode.classList.remove('hidden');
      return;
    }

    if(types.checked) {

      types.parentNode.classList.remove('hidden');

    } else {
      
      types.parentNode.classList.add('hidden');
    }
  });
}



function checkBrands() {
  const brands     = document.querySelectorAll('.brands-filters');

  var checked = document.querySelector('.brands-filters:checked');

  Array.prototype.forEach.call(brands, (brand) => {

    if(!checked) {
      brand.parentNode.classList.remove('hidden');
      return;
    }

    if(brand.checked) {

      brand.parentNode.classList.remove('hidden');

    } else {
      brand.parentNode.classList.add('hidden');
    }
  });
}



const fade = document.querySelectorAll('.container-fade p');     

for (var i = 0; i < fade.length; i++) {

    if(fade[i].innerText.length >= 22){

        fade[i].parentNode.classList.add('txt-fade');
    } else {
        fade[i].parentNode.classList.remove('txt-fade');

    }
}



function validate(form, event) {

    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
        const button = form.querySelector('button');
        const spin = button.querySelector('span');

        button.setAttribute('disabled','true');
        spin.classList.remove('hidden');
    }
}

const cardImg = document.querySelector('.js-card-image');
const thumbsImg = document.querySelectorAll('.js-thumb-image');

function changeCardImg(e) {
    const image = e.currentTarget.getAttribute('data-name');
    cardImg.src = window.location.origin+'/'+image;
}

if(thumbsImg){
    Array.prototype.forEach.call(thumbsImg, (thumb) => {
        thumb.addEventListener('click', changeCardImg);
    });
}

const date = document.querySelector('.date_input');


if (date && date.type != 'date' ) {
    $(".date_input").datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        orientation: "bottom auto",
        autoclose: true,
    })
}

const filterInputs = document.querySelectorAll('.filter-option');   

if(filterInputs){
  

    Array.prototype.forEach.call(filterInputs, (check) => {

      check.addEventListener('change', changeFilter);

    });
}

function filterByProperty(array, prop, value){
  var filtered = [];
  for(var i = 0; i < array.length; i++){

      var obj = array[i];

      for(var key in obj){
          if(typeof(obj[key] == "object")){
              var item = obj[key];
              if(item[prop] == value){
                  filtered.push(item);
              }
          }
      }

  }    

  return filtered;

}

function changeFilter(e) {

  return;

  const filters           = document.querySelector('#filters');
  var items               = document.querySelector('#items').value;
  const filtersContainer  = document.querySelector('#container-filters');
  const departments       = document.querySelectorAll('.departments-filters');
  const clothingTypes     = document.querySelectorAll('.clothingTypes-filters');
  const brands            = document.querySelectorAll('.brands-filters');
  const colors            = document.querySelectorAll('.colors-filters');
  const itemOptions       = document.querySelectorAll('.item-option');
  var result              = [];
  var filtredDep          = [];
  var filtredClothing     = [];
  var filtredBrand        = [];
  var filtersObj          = JSON.parse(filters.value);
  var clothingTypesKeys   = Object.keys(filtersObj.clothingTypes);
  var brandsKeys          = Object.keys(filtersObj.brands);
  var colorsKeys          = Object.keys(filtersObj.colors);
  var deparmentsKeys      = Object.keys(filtersObj.departments);

  //result = result.length > 0 ? result : JSON.parse(items);

  filtersContainer.innerHTML = "";
  

  Array.prototype.forEach.call(departments, (department) => {
    if(departments.checked) { 

      const filter = departmentsKeys.forEach(element => {

        var findDepa = result.find(search => search.DepName === element);
        

        if(element === department.value && !findDepa) {
          result.push(filtersObj.departments[element]);
          result = result.flat();

          

        } 
      });

    } 
    checkDep();
  });

  
  
  Array.prototype.forEach.call(clothingTypes, (clothingType) => {
    
    if(clothingType.checked) {               

      const filter = clothingTypesKeys.forEach(element => {


        var findClothing = result.find(search => search.ClothingTypeName === element);
        
        if(element === clothingType.value && !findClothing) {
          result.push(filtersObj.clothingTypes[element]);
          result = result.flat();
        } 
        
      })
    }
    checkTypes();
  });

  

  Array.prototype.forEach.call(brands, (brand) => {

    if(brand.checked) {

      const filter = brandsKeys.forEach(element => {

        var findBrands = result.find(search => search.brand === element);

        if(element === brand.value && !findBrands) {
          result.push(filtersObj.brands[element]);
          result = result.flat();

          

        }
      });
    } 
    checkBrands();
  });

  Array.prototype.forEach.call(colors, (color) => {

    if(color.checked) {

      const filter = colorsKeys.forEach(element => {

        var findColors = result.find(search => search.ColorName === element);

        if(element === color.value && !findColors) {
          result.push(filtersObj.colors[element]);
          result = result.flat();

        }
      });
    } 
  }); 

  result = result.length < 1 ? JSON.parse(items) : result;


  //showOptions(filtredDep, filtredClothing, filtredBrand);
  showFiltered(result, filtersContainer);
}

function showFiltered(results, filtersContainer) {
  return;
  
  

  for (const el in results) {
      
      var item = `<div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
          <a href="{{ url('login/0') }}"><i class="far fa-heart heart-wishlist"></i></a>
          <a href="{{ url('items/`+results[el].ItemID+`/public') }}" class="link-card">
            <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
          
                <img class="card-img-top" src="{{ url('/storage/`+results[el].ThumbPath+`') }}" alt="Card image cap" height="200px;">

      <!--         <img class="card-img-top" src="storage/'`+results[el].brand+`" alt="Card image cap" height="200px;">
      -->          <div class="card-body px-0 p-lg-3">

                  <h4 class="card-title mb-0">`+results[el].brand+`</h4>

                  <div class="float-right">
                    <span class="mr-2 text-black-50">
                      <del>`+results[el].OriginalPrice+`</del>
                    </span>

                    <p class="badge alert-success badge-price">
                      `+results[el].ActualPrice+`
                    </p>
                  </div>
                        
                  <div class="container-fade">
                    <p>`+results[el].ItemDescription+`</p>
                  </div>
                <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                  Talla: `+results[el].size+` <br />Color: `+results[el].color+`</p>
              </div>
            </div>
          </a>
      </div>`

      filtersContainer.insertAdjacentHTML('beforeend', item);
    }
}