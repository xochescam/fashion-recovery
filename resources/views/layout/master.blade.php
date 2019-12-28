<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Ion.RangeSlider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" />

    <!-- Fontawesome ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.css" />


    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="{{ url('css/index.css?1.35') }}" />
    <link rel="stylesheet" href="{{ url('css/fonts.css') }}" />

    <link rel="shortcut icon" href="{{ url('img/favicon.jpg') }}">

    <title>FASHION RECOVERY</title>
  </head>
  <body>

    @include('layout.header')

        @yield('content')


    @include('layout.footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS, then  bootstrap-datepicker JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>


    <!--Ion.RangeSlider Plugin JavaScript file-->
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="{{ url('js/app.js?1.6') }} "></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <script>


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


        //  $("#price").ionRangeSlider({
        //     skin: "round",
        //     type: "double",
        //     grid: true,
        //     min: 0,
        //     max: 1000,
        //     from: 200,
        //     to: 800,
        //     prefix: "$"
        // });


    </script>
  </body>
</html>
