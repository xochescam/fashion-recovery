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
    <link rel="stylesheet" href="{{ url('css/index.css?1.30') }}" />
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

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


    <!--Ion.RangeSlider Plugin JavaScript file-->
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="{{ url('js/app.js?1.4') }} "></script>

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

        function changeFilter(e) {

          return;

          const filters           = document.querySelector('#filters');
          const filtersContainer  = document.querySelector('#container-filters');
          const departments       = document.querySelectorAll('.departments-filters');
          const clothingTypes     = document.querySelectorAll('.clothingTypes-filters');
          const brands            = document.querySelectorAll('.brands-filters');
          const colors            = document.querySelectorAll('.colors-filters');
          const itemOptions       = document.querySelectorAll('.item-option');
          const departmentsArr    = [];
          const clothingTypesArr  = [];
          const brandsArr         = []; 
          const colorsArr         = [];
          const result            = [];

          //var val                 = e.currentTarget.getAttribute('id').split('-')[0];
          //var value               = e.currentTarget.value;
          var filtersObj          = JSON.parse(filters.value);

          var types = {
            'DepartmentID': 'departments',
            'ClothingTypeID':'clothingTypes',
            'BrandID':'brands',
            'ColorID':'colors'

          };

          Array.prototype.forEach.call(itemOptions, (itemOption) => {
            itemOption.classList.add('hidden');
          });

          Array.prototype.forEach.call(departments, (department) => {
            if(department.checked) {
              $("#container-filters div").filter(function( index ) {
                return $(this).attr("data-department") === department.value;
              }).css( "display", "block" );
            }
          });

          Array.prototype.forEach.call(clothingTypes, (clothingType) => {
            if(clothingType.checked) {

              //const peopleArray = Object.keys(filtersObj).map(i => filtersObj[i])

              console.log(filtersObj['clothingTypes']['Camisa']);
                          
              

              //console.log(filtersObj['departments'].filter(word => word == 'Chamarra'));
              
/*               $("#container-filters div").filter(function( index ) {
                return $(this).attr("data-clothingType") === clothingType.value;
              }).css( "display", "block" ); */
              //clothingTypesArr.push(clothingType.value);
            }
          });

          
          

          Array.prototype.forEach.call(brands, (brand) => {
            if(brand.checked) {
              $("#container-filters div").filter(function( index ) {
                return $(this).attr("data-brand") === brand.value;
              }).css( "display", "block" );
            }
          });

          Array.prototype.forEach.call(colors, (color) => {
            if(color.checked) {
              $("#container-filters div").filter(function( index ) {
                return $(this).attr("data-color") === color.value;
              }).css( "display", "block" );
            }
          });



          console.log(filtersObj);
          

          /* const results = filtersObj[types[val]];

          if(results) {

            filtersContainer.innerHTML = "";

            //showFiltered(results, filtersContainer, value);
          } */
        }

        function showFiltered(results, filtersContainer, value) {

          for (const el in results[value]) {
              
              var item = `<div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
                  <a href="{{ url('login/0') }}"><i class="far fa-heart heart-wishlist"></i></a>
                  <a href="{{ url('items/`+results[value][el].ItemID+`/public') }}" class="link-card">
                    <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
                  
                        <img class="card-img-top" src="{{ url('/storage/`+results[value][el].ThumbPath+`') }}" alt="Card image cap" height="200px;">

              <!--         <img class="card-img-top" src="storage/'`+results[value][el].brand+`" alt="Card image cap" height="200px;">
              -->          <div class="card-body px-0 p-lg-3">

                          <h4 class="card-title mb-0">`+results[value][el].brand+`</h4>

                          <div class="float-right">
                            <span class="mr-2 text-black-50">
                              <del>`+results[value][el].OriginalPrice+`</del>
                            </span>

                            <p class="badge alert-success badge-price">
                              `+results[value][el].ActualPrice+`
                            </p>
                          </div>
                                
                          <div class="container-fade">
                            <p>`+results[value][el].ItemDescription+`</p>
                          </div>
                        <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                          Talla: `+results[value][el].size+` <br />Color: `+results[value][el].color+`</p>
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
