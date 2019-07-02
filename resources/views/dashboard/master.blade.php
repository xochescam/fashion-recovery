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
    <link rel="stylesheet" href="{{ url('css/index.css?1.18') }}" />
    <link rel="stylesheet" href="{{ url('css/fonts.css') }}" />

    <link rel="shortcut icon" href="{{ url('img/favicon.jpg') }}">

    <title>FASHION RECOVERY</title>
  </head>
  <body>

    @include('dashboard.header')

    @yield('content')

    @include('layout.footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>

    <script src="{{ url('js/load-image.all.min.js') }} "></script>

    <script>
        const dateTime            = document.querySelectorAll('.date_input');
        const offerCheck          = document.querySelector('.js-check-offer');
        const selfieInput         = document.querySelector('.js-selfie-input');
        const departmentsSelect   = document.querySelector('.js-departments-select');
        const itemsInput          = document.querySelector('.js-items-input');
        const itemFiles           = document.querySelectorAll('.js-item-file');
        const addItems            = document.querySelector('.js-add-items');
        const textLimit           = document.querySelectorAll('.js-text-limit');
        const categoriesSelect    = document.querySelector('.js-categories-select');
        const brandsSelect        = document.querySelector('.js-brands-select');
        const clothingTypesSelect = document.querySelector('.js-clothing-type-select');
        const sizesSelect         = document.querySelector('.js-sizes-select');


        if (dateTime[0] && dateTime[0].type != 'date' ) {

            $(".date_input").datepicker({
                format: "dd/mm/yyyy",
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
                } else {

                    const button = form.querySelector('.btn-fr');
                    const spin = button.querySelector('span');

                    button.setAttribute('disabled','true');
                    spin.classList.remove('hidden');
                    spin.classList.add('spinner-border-block');
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);

        })();

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

            selfieInput.addEventListener('change', function(e) {

                btn.classList.remove('hidden');
                const currentImg = document.querySelector('.js-selfie-img');
                const file = e.currentTarget.files;
                const container = currentImg.parentNode;

                var reader = new FileReader();

                reader.onload = function(e) {

                    container.innerHTML = "";

                    var img = new Image();
                    img.src = reader.result;
                    container.appendChild(img);

                    img.style.width = "100%";
                    img.classList.add('card-img-top');
                    img.classList.add('js-selfie-img');

                    container.insertAdjacentHTML('beforeend', '<i class="far fa-edit" id="edit_icon"></i>');
                }

                reader.readAsDataURL(file[0]);
            });
        }

        if(categoriesSelect) {
            categoriesSelect.addEventListener('change', function(e) {
                const brandsSelect            = document.querySelector('.js-brands-select');
                const sizeSelect              = document.querySelector('.js-sizes-select');

                if((brandsSelect.value == 'other') || (brandsSelect.value == '') || (departmentsSelect.value == '')) {
                    return;
                }

                clothingTypesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;
                sizeSelect.innerHTML          = `<option value="" selected>- Seleccionar -</option>`;
                const request                 = new XMLHttpRequest();
                const url                     = window.location.origin;

                request.open('GET', url+'/clothing-type-by-brand/'+departmentsSelect.value+'/'+brandsSelect.value+'/'+e.currentTarget.value, true);
                request.send(null);
                request.onload = function() {

                   if (request.status >= 200 && request.status < 400) {

                        const response = JSON.parse(request.response);

                        if(response.length > 0){

                            for (var i = response.length - 1; i >= 0; i--) {

                                clothingTypesSelect.setAttribute('data-department',response[i].DepartmentID);
                                clothingTypesSelect.setAttribute('data-brand',response[i].BrandID);

                                var size = `<option value="`+response[i].ClothingTypeID+`" data-department=`+response[i].DepartmentID+` data-brand=`+response[i].BrandID+`>`+response[i].ClothingTypeName+`</option>`;

                                clothingTypesSelect.insertAdjacentHTML('beforeend', size);
                            }

                        } else {

                        }

                   } else {
                        // We reached our target server, but it returned an error
                        console.log('Ocurrio un error, inténtalo de nuevo.');
                   }

                    clothingTypesSelect.insertAdjacentHTML('beforeend', `<option value="other"> Otro tipo de prenda </option>`);
                };

                request.onerror = function() {
                    //There was a connection error of some sort
                    console.log('Ocurrió un error de conexión, por favor intente de nuevo.');
                };

                clothingTypesSelect.addEventListener('change', sizesByClothingType);

            });
        }

        if(departmentsSelect) {

            departmentsSelect.addEventListener('change', changeDepartament);
        }

        function changeDepartament(e) {

            const clothingTypesSelect      = document.querySelector('.js-clothing-type-select');
            const brandsSelect             = document.querySelector('.js-brands-select');
            const sizesSelect              = document.querySelector('.js-sizes-select');
            const categoriesSelect         = document.querySelector('.js-categories-select');
            const otherInputs              = document.querySelectorAll('.js-other');
            const inputs                   = document.querySelectorAll('.js-mean');
            const request                  = new XMLHttpRequest();
            const url                      = window.location.origin;
            const size                     = e.currentTarget.getAttribute('data-size');

            brandsSelect.innerHTML         = `<option value="" selected>- Seleccionar -</option>`;
        
            if(clothingTypesSelect) {
               clothingTypesSelect.innerHTML  = `<option value="" selected>- Seleccionar -</option><option value="">Otro tipo de prenda</option>`; 
            }

            if(sizesSelect) {
                sizesSelect.innerHTML          = `<option value="" selected>- Seleccionar -</option>`;                
            }
            
            if(categoriesSelect) {
                categoriesSelect.selectedIndex = 0;
            }
            

            for (var i = otherInputs.length - 1; i >= 0; i--) {
                otherInputs[i].classList.add('hidden');
                otherInputs[i].querySelector('.form-control').removeAttribute('required');
            }

            for (var i = inputs.length - 1; i >= 0; i--) {
                inputs[i].classList.remove('hidden');
            }

            if(this.value == '') {
                return;
            }

            request.open('GET', url+'/brands-by-department/'+e.currentTarget.value, true);
            request.send(null);
            request.onload = function() {

                if (request.status >= 200 && request.status < 400) {

                   const response = JSON.parse(request.response);

                    if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            brandsSelect.setAttribute('data-department',response[i].DepartmentID);

                            var brand = `<option value="`+response[i].BrandID+`" data-department=`+response[i].DepartmentID+`>`+response[i].BrandName+`</option>`;

                            brandsSelect.insertAdjacentHTML('beforeend', brand);
                        }

                    } else {

                    }

                } else {
                    // We reached our target server, but it returned an error
                    console.log('Ocurrio un error, inténtalo de nuevo.');
                }

                if(sizesSelect) {
                    sizesSelect.insertAdjacentHTML('beforeend', `<option value="other"> Otra talla </option>`);
                    brandsSelect.insertAdjacentHTML('beforeend', `<option value="other">Otra marca</option>`);
                }

                
                
            };

            request.onerror = function() {
                //There was a connection error of some sort
                console.log('Ocurrió un error de conexión, por favor intente de nuevo.');
            };

            brandsSelect.addEventListener('change', clothingTypesByBrand);
        }

        function clothingTypesOnlyByBrand(e) {

            const clothingTypesSelect     = document.querySelector('.js-clothing-type-select');
            const request                 = new XMLHttpRequest();
            const url                     = window.location.origin;
            const department              = e.currentTarget.getAttribute('data-department');
            clothingTypesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;

            request.open('GET', url+'/clothing-type-only-by-brand/'+department+'/'+e.currentTarget.value, true);
            request.send(null);
            request.onload = function() {

               if (request.status >= 200 && request.status < 400) {

                    const response = JSON.parse(request.response);

                    if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            clothingTypesSelect.setAttribute('data-department',response[i].DepartmentID);
                            clothingTypesSelect.setAttribute('data-brand',response[i].BrandID);


                            var size = `<option value="`+response[i].ClothingTypeID+`" data-department=`+response[i].DepartmentID+` data-brand=`+response[i].BrandID+`>`+response[i].ClothingTypeName+`</option>`;

                            clothingTypesSelect.insertAdjacentHTML('beforeend', size);
                        }

                        //clothingTypesSelect.addEventListener('change', sizesByClothingType);

                    } else {
                        //clothingTypesSelect.setAttribute('disabled',true);
                        //clothingTypesSelect.setAttribute('required',false);

                        //clothingTypesSelect.innerHTML = `<option value="" selected>- No se encontraron tipos de prendas -</option>`;
                    }

               } else {

                    // We reached our target server, but it returned an error
                    console.log('Ocurrio un error, inténtalo de nuevo.');
               }
            };

            request.onerror = function() {
                //There was a connection error of some sort
                console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

            };
        }

        function clothingTypesByBrand(e) {

            const departmentsSelect   = document.querySelector('.js-departments-select');
            const clothingTypesSelect = document.querySelector('.js-clothing-type-select');
            const sizesSelect         = document.querySelector('.js-sizes-select');
            const categoriesSelect    = document.querySelector('.js-categories-select');
            const size                = e.currentTarget.getAttribute('data-size');
            const otherInputs         = document.querySelectorAll('.js-other');
            const inputs              = document.querySelectorAll('.js-mean');

            if(e.currentTarget.value == "other") {

                for (var i = otherInputs.length - 1; i >= 0; i--) {
                    otherInputs[i].classList.remove('hidden');
                    otherInputs[i].querySelector('.form-control').setAttribute('required','required');
                }

                for (var i = inputs.length - 1; i >= 0; i--) {
                    inputs[i].classList.add('hidden');
                    inputs[i].querySelector('.form-control').removeAttribute('required');
                }
                return;

            } else {

                for (var i = otherInputs.length - 1; i >= 0; i--) {
                    otherInputs[i].classList.add('hidden');
                    otherInputs[i].querySelector('.form-control').removeAttribute('required');
                }

                for (var i = inputs.length - 1; i >= 0; i--) {
                    inputs[i].classList.remove('hidden');
                    inputs[i].querySelector('.form-control').setAttribute('required','required');
                }
            }


            if(size == 'true') {
                clothingTypesOnlyByBrand(e);
                return;

            } else if(size == 'false' && (!clothingTypesSelect || categoriesSelect.value == '')) {
                return;

            } else if(size == 'false' && (!clothingTypesSelect || categoriesSelect.value == '')) {
                return;
            }

            const request                 = new XMLHttpRequest();
            const url                     = window.location.origin;
            const department              = document.querySelector('.js-departments-select');
            clothingTypesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;
            sizesSelect.innerHTML         = `<option value="" selected>- Seleccionar -</option>`;

            request.open('GET', url+'/clothing-type-by-brand/'+department.value+'/'+this.value+'/'+categoriesSelect.value, true);
            request.send(null);
            request.onload = function() {

               if (request.status >= 200 && request.status < 400) {

                    const response = JSON.parse(request.response);

                    if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            clothingTypesSelect.setAttribute('data-department',response[i].DepartmentID);
                            clothingTypesSelect.setAttribute('data-brand',response[i].BrandID);


                            var size = `<option value="`+response[i].ClothingTypeID+`" data-department=`+response[i].DepartmentID+` data-brand=`+response[i].BrandID+`>`+response[i].ClothingTypeName+`</option>`;

                            clothingTypesSelect.insertAdjacentHTML('beforeend', size);
                        }

                    } else {

                    }

               } else {
                    // We reached our target server, but it returned an error
                    console.log('Ocurrio un error, inténtalo de nuevo.');
               }

               sizesSelect.insertAdjacentHTML('beforeend', `<option value="other"> Otra talla </option>`);
               clothingTypesSelect.insertAdjacentHTML('beforeend', `<option value="other"> Otro tipo de prenda</option>`);
            };

            request.onerror = function() {
                //There was a connection error of some sort
                console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

            };

            departmentsSelect.addEventListener('change', changeDepartament);
            clothingTypesSelect.addEventListener('change', sizesByClothingType);
        }

        function sizesByClothingType(e) {

            const inputSize          = document.querySelector('.js-other-size');
            const inputClothingType  = document.querySelector('.js-other-clothing-type');
            const selectSize         = document.querySelector('.js-mean-size');

            if(!inputSize) {
                return;
            }

            if(e.currentTarget.value == 'other') {

                inputSize.classList.remove('hidden');
                inputClothingType.classList.remove('hidden');
                selectSize.classList.add('hidden');
                inputSize.querySelector('input').setAttribute('required','required');
                inputClothingType.querySelector('input').setAttribute('required','required');
                selectSize.querySelector('select').removeAttribute('required');
                return;

            } else {

                inputSize.classList.add('hidden');
                inputClothingType.classList.add('hidden');
                selectSize.classList.remove('hidden');
                inputSize.querySelector('input').removeAttribute('required');
                inputClothingType.querySelector('input').removeAttribute('required');
                selectSize.querySelector('select').setAttribute('required','required');

                if(e.currentTarget.value == '') {
                    return;
                }
            }

            const sizesSelect     = document.querySelector('.js-sizes-select');
            const request         = new XMLHttpRequest();
            const url             = window.location.origin;
            const department      = e.currentTarget.getAttribute('data-department');
            const brand           = e.currentTarget.getAttribute('data-brand');
            sizesSelect.innerHTML = `<option value="" selected>- Seleccionar -</option>`;

            request.open('GET', url+'/sizes-by-clothing-type/'+department+'/'+brand+'/'+this.value, true);
            request.send(null);
            request.onload = function() {

               if (request.status >= 200 && request.status < 400) {

                    const response = JSON.parse(request.response);

                    if(response.length > 0){

                        for (var i = response.length - 1; i >= 0; i--) {

                            var size = `<option value="`+response[i].SizeID+`">`+response[i].SizeName+`</option>`;

                            sizesSelect.insertAdjacentHTML('beforeend', size);
                        }

                    } else {

                        //.innerHTML = `<option value="" selected>- No se encontraron tallas -</option>`;
                    }

               } else {

                    // We reached our target server, but it returned an error
                    console.log('Ocurrio un error, inténtalo de nuevo.');
               }

                sizesSelect.addEventListener('change', changeSize);

                sizesSelect.insertAdjacentHTML('beforeend', `<option value="other"> Otra talla </option>`);
            };

            request.onerror = function() {
                //There was a connection error of some sort
                console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

            };
        }

        function changeSize(e){
            const inputSize          = document.querySelector('.js-other-size');
            const selectSize         = document.querySelector('.js-mean-size');

            if(e.currentTarget.value == 'other') {

                inputSize.classList.remove('hidden');
                inputSize.querySelector('input').setAttribute('required','required');
                inputSize.nextElementSibling.classList.remove('col-md-6');
                inputSize.nextElementSibling.classList.add('w-100');
                return;

            } else {
                inputSize.classList.add('hidden');
                inputSize.querySelector('input').removeAttribute('required');
                inputSize.nextElementSibling.classList.add('col-md-6');
                inputSize.nextElementSibling.classList.remove('w-100');
            }
        }

        if(sizesSelect) {
            sizesSelect.addEventListener('change', changeSize);
        }

        if(itemFiles) {
            Array.prototype.forEach.call(itemFiles, (file) => {
                if(file.files.length > 0){
                    showItemPicture(file);

                }
                file.addEventListener('change', showItemPicture);
            });
        }

        function showItemPicture(e) {

            const el        = e.currentTarget ?  e.currentTarget : e;
            const file      = el.files;
            const container = el.parentNode.querySelector('.container-item-img');
            const type      = el.getAttribute('data-type');
            const name      = el.getAttribute('data-name');
            const parent    = el.nextElementSibling.parentNode;
            const label     = el.nextElementSibling;
            const input     = el.nextElementSibling.previousElementSibling;

            container.previousElementSibling.style.display = "none";

            const img = document.querySelector('.js-new-item img');

            var reader = new FileReader();

            reader.onload = function(e) {
                container.innerHTML = "";

                // Create a new image.
                var img = new Image();

                img.src = reader.result;
                container.appendChild(img);
                img.style.width = "100%";

                const button = `<a class="btn btn-danger btn-sm btn-block js-delete-item" data-type="`+type+`" data-name="`+name+`">Eliminar</a>`;

                container.insertAdjacentHTML('beforeend', button);

                const deleteButtons = document.querySelectorAll('.js-delete-item');

                Array.prototype.forEach.call(deleteButtons, (btn) => {
                    btn.addEventListener('click', deleteItem);
                });
            }

            reader.readAsDataURL(file[0]);
        }

        function deleteItem(e) {
            const type = e.currentTarget.getAttribute('data-type');
            const name = e.currentTarget.getAttribute('data-name');
            const container = e.currentTarget.parentNode.parentNode;
            const label = e.currentTarget.parentNode.previousElementSibling;
            const input = e.currentTarget.parentNode.previousElementSibling.previousElementSibling;

            e.currentTarget.parentNode.innerHTML = '';

            container.removeChild(label);
            container.removeChild(input);

            const isRequired = (name !== 'in' || name !== 'selfie') ? 'required="true"' : '';

            const content = `<input type="file" name="`+name+`_item_file" id="`+name+`_item_file" class="no-file js-item-file custom-file-input" data-type="`+type+`" data-name="`+name+`" `+isRequired+`><label for="`+name+`_item_file" class="card card--file-item custom-file-label">
                  <span><i class="far fa-image"></i> <br>`+type+`</span>
                </label>`;

            container.insertAdjacentHTML('afterbegin', content);

            const itemFiles = document.querySelectorAll('.js-item-file');

            Array.prototype.forEach.call(itemFiles, (item) => {
                item.addEventListener('change', showItemPicture);
            });
        }

        if(itemsInput) {

            const list = document.querySelector('#itemsList');
            const realPictures = document.querySelector('.js-input-real-pictures');
            var arr = [];

            itemsInput.addEventListener('change', function(e) {
                const files = e.currentTarget.files;

                for (var i = files.length - 1; i >= 0; i--) {

                    var item = `<span class="badge badge-pill green-color w-100 text-left">`+files[i].name+`
                        <i class="fas fa-times green-color float-right cursor-pointer js-delete-item" data-key="`+i+`" data-name="`+files[i].name+`"></i>
                        </span>`;

                    list.insertAdjacentHTML('beforeend', item);

                    arr.push(files[i].name);
                }

                realPictures.value = arr;

                const deleteIt = document.querySelectorAll('.js-delete-item');

                Array.prototype.forEach.call(deleteIt, (btn) => {

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

            const container    = document.querySelector('.js-items-container');
            const realPictures = document.querySelector('.js-input-real-pictures');
            const btn          = document.querySelector('.js-add-items-btn');
            const isNewItem    = container.getAttribute('data-item');

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

        if(textLimit) {
            Array.prototype.forEach.call(textLimit, (input) => {

                input.addEventListener('keydown', function(e) {
                    const limit = input.getAttribute('data-limit');
                    const lenght = e.currentTarget.value.length;

                    e.currentTarget.nextElementSibling.innerHTML = limit -  lenght + ' caracteres.';
                })
            });
        }

        if(brandsSelect) {
            brandsSelect.addEventListener('change', clothingTypesByBrand);
        }

        if(clothingTypesSelect) {
           clothingTypesSelect.addEventListener('change', sizesByClothingType);
        }

    </script>
  </body>
</html>
