<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" />


    <!-- Fontawesome ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.css" />

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="{{ url('css/index.css?1.11') }}" />
    <link rel="stylesheet" href="{{ url('css/fonts.css') }}" />

    <link rel="shortcut icon" href="{{ url('img/favicon.jpg') }}">

    <title>FASHION RECOVERY</title>
  </head>
  <body>

    @include('dashboard.header')

    @yield('content')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>

    <script>
        const dateTime = document.querySelectorAll('.date_time_input');
        const offerCheck = document.querySelector('.js-check-offer');
        const selfieInput = document.querySelector('.js-selfie-input');
        const departmentsSelect = document.querySelector('.js-departments-select');
        const itemsInput = document.querySelector('.js-items-input');
        const addItems = document.querySelector('.js-add-items');

        if (dateTime[0] && dateTime[0].type != 'date' ) {

            $(".date_time_input").datepicker({
                format: "yyyy-mm-dd",
                language: "es",
                orientation: "bottom auto",
                autoclose: true,
            })
        }

        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();

        const date = document.querySelector('.date_input');

        if (date && date.type != 'date' )
            $('.date_input').datepicker({
                format: "yyyy-mm-dd",
                language: "es",
                orientation: "bottom auto",
                autoclose: true
            })

        if(offerCheck) {

            const container = document.querySelector('.js-check-container');
            const inputs = container.querySelectorAll('input');

            offerCheck.addEventListener('change', function(e) {
                if(e.currentTarget.checked) {
                    container.classList.remove('hidden');

                    for (var i = inputs.length - 1; i >= 0; i--) {
                        inputs[i].setAttribute('required',true);
                    }

                } else {
                    container.classList.add('hidden');

                    for (var i = inputs.length - 1; i >= 0; i--) {
                        inputs[i].setAttribute('required',false);
                    }
                }
            });
        }

        if(selfieInput) {    
            const btn = document.querySelector('.js-selfie-btn');
            const img = document.querySelector('.js-selfie-img');

            selfieInput.addEventListener('change', function(e) {
                
                btn.classList.remove('hidden');

                $('.js-selfie-img').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
                img.style.width = "200px";
            });
        }

        if(departmentsSelect) {

            departmentsSelect.addEventListener('change', function(e) {

                const brandsSelect = document.querySelector('.js-brands-select');
                const sizesSelect = document.querySelector('.js-sizes-select');
                const request = new XMLHttpRequest();
                const url     = window.location.origin;
                brandsSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;
                sizesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;
                brandsSelect.setAttribute('disabled',true);
                sizesSelect.setAttribute('disabled',true);


                request.open('GET', url+'/brands-by-department/'+this.value, true);
                request.send(null);
                request.onload = function() {

                   if (request.status >= 200 && request.status < 400) {
                       
                       const response = JSON.parse(request.response);

                     if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            brandsSelect.setAttribute('data-department',response[i].DepartmentID);

                            var brand = `<option value="`+response[i].BrandID+`" data-department=`+response[i].DepartmentID+`>`+response[i].BrandName+`</option>`;

                            brandsSelect.insertAdjacentHTML('beforeend', brand);

                            brandsSelect.removeAttribute('disabled');

                        }

                        brandsSelect.addEventListener('change', sizesByBrand);
                        

                     } else {
                        brandsSelect.setAttribute('disabled',true);
                        sizesSelect.setAttribute('disabled',true);

                        brandsSelect.innerHTML = `<option value="" selected>- No se encontraron marcas -</option>`;
                     }

                   } else {
                        brandsSelect.setAttribute('disabled',true);
                        sizesSelect.setAttribute('disabled',true);

                        // We reached our target server, but it returned an error
                        console.log('Ocurrio un error, inténtalo de nuevo.');
                   }
                };

                request.onerror = function() {
                    brandsSelect.setAttribute('disabled',true);
                    sizesSelect.setAttribute('disabled',true);

                    //There was a connection error of some sort
                    console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

                };
            });     
        }

        function sizesByBrand(e) {

            const sizesSelect = document.querySelector('.js-sizes-select');
            const request = new XMLHttpRequest();
            const url     = window.location.origin;
            const department = e.currentTarget.getAttribute('data-department');
            sizesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;
            sizesSelect.setAttribute('disabled',true);

            request.open('GET', url+'/sizes-by-brand/'+department+'/'+this.value, true);
            request.send(null);
            request.onload = function() {

               if (request.status >= 200 && request.status < 400) {
                   
                    const response = JSON.parse(request.response);

                    if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            var size = `<option value="`+response[i].SizeID+`">`+response[i].SizeName+`</option>`;

                            sizesSelect.insertAdjacentHTML('beforeend', size);
                        }

                        sizesSelect.removeAttribute('disabled');                   

                    } else {
                        sizesSelect.setAttribute('disabled',true);

                        sizesSelect.innerHTML = `<option value="" selected>- No se encontraron tallas -</option>`;
                    }

               } else {
                    sizesSelect.setAttribute('disabled',true);

                    // We reached our target server, but it returned an error
                    console.log('Ocurrio un error, inténtalo de nuevo.');
               }
            };

            request.onerror = function() {
                sizesSelect.setAttribute('disabled',true);


                //There was a connection error of some sort
                console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

            };
        }

        if(itemsInput) {

            const list = document.querySelector('#itemsList');
            const realPictures = document.querySelector('.js-input-real-pictures');
            var arr = [];
        
            itemsInput.addEventListener('change', function(e) {
                const files = e.currentTarget.files;

                for (var i = files.length - 1; i >= 0; i--) {
                    //var node = document.createElement("li");
                    
                    var item = `<span class="badge badge-pill green-color w-100 text-left">`+files[i].name+`                                            
                        <i class="fas fa-times green-color float-right cursor-pointer js-delete-item" data-key="`+i+`" data-name="`+files[i].name+`"></i>
                        </span>`;

                    list.insertAdjacentHTML('beforeend', item);

                    arr.push(files[i].name);
                }

                realPictures.value = arr;

                const deleteItem = document.querySelectorAll('.js-delete-item');

                Array.prototype.forEach.call(deleteItem, (btn) => {

                  btn.addEventListener('click', function(e) {
                    arr = [];
                    list.removeChild(e.currentTarget.parentNode);

                    const newList = document.querySelectorAll('#itemsList span');

                    for (var i = newList.length - 1; i >= 0; i--) {
                        arr.push(newList[i].innerText);
                    }

                    realPictures.value = arr;

                  });

                });

            });  
        }

        if(addItems) {

            const container = document.querySelector('.js-items-container');
            const realPictures = document.querySelector('.js-input-real-pictures');
            const btn = document.querySelector('.js-add-items-btn');
            const isNewItem = container.getAttribute('data-item');

            var arr = [];

            addItems.addEventListener('change', function(e) {

                btn ? btn.classList.remove('hidden') : '';

                const items = document.querySelectorAll('.js-new-item');
                
                
                if(items.length > 0) {

                    for (var i = items.length - 1; i >= 0; i--) {
                        container.removeChild(items[i]);
                    }
                }

                if(isNewItem == true) {
                    container.innerHTML = "";
                }

                const files = e.currentTarget.files;

                for (var i = files.length - 1; i >= 0; i--) {

                    const content = `<div class="col-sm-4 mb-5 thumb-size js-new-item" data-name="`+files[i].name+`">
                            <div class="card">
                              <img src="`+URL.createObjectURL(files[i])+`" class="card-img-top" alt="..." height="200px" width="200px">
                              <button class="btn btn-danger btn-sm js-delete-img">Eliminar</button>
                            </div></div>`;

                    container.insertAdjacentHTML('beforeend', content);

                    arr.push(files[i].name);
                }

                realPictures.value = arr;

                const deleteImg = document.querySelectorAll('.js-delete-img');

                Array.prototype.forEach.call(deleteImg, (btn) => {

                    btn.addEventListener('click', function(e) {
                        arr = [];

                        container.removeChild(e.currentTarget.parentNode.parentNode);

                        const newItem = document.querySelectorAll('.js-new-item');


                        for (var i = newItem.length - 1; i >= 0; i--) {
                            arr.push(newItem[i].getAttribute('data-name'));
                        }

                        realPictures.value = arr;
                    });

                });

            });

        } 


    </script>
  </body>
</html>
