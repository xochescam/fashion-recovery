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

    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="{{ url('css/index.css?1.34') }}" />
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <script  type="text/javascript" src="{{ url('js/exif.js') }} "></script>

    <script  type="text/javascript" src="{{ url('js/app.js?1.8') }} "></script>

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
        const otherBrandSelect    = document.querySelector('.js-other-brand');
        const clothingTypesSelect = document.querySelector('.js-clothing-type-select');
        const sizesSelect         = document.querySelector('.js-sizes-select');
        const currencyInputs      = document.querySelectorAll('.js-currency-input');
        const itemFiles1          = document.querySelector('.js-item-file-opt1');
        const itemFiles2          = document.querySelector('.js-item-file-opt2');
        const acceptPrice         = document.querySelector('.js-accept-price');
        const discount            = document.querySelector('.js-discount');

        $('.carousel').carousel('pause');

        if(discount) {
            discount.addEventListener('keyup', function(e) {

                var invalidPrice     = document.querySelector('.js-invalid-feedback');
                var invalidDiscount  = document.querySelector('.js-invalid-discount');
                var discount         = e.currentTarget;                           
                var actual           = Number(acceptPrice.value.replace(/[^0-9.-]+/g,""));

                //checkDiscount(invalidPrice, invalidDiscount, discount, actual);

            });
        }

        function checkDiscount(invalidPrice, invalidDiscount, discount, actual) {
             if(actual < 180) {
                invalidPrice.classList.add('d-block');
                invalidPrice.innerHTML = "El precio mínimo de la prenda debe ser $180";

            } else if(actual < 180 && discount.value !== ''){

                invalidDiscount.classList.add('d-block');
                invalidDiscount.innerHTML = "No tienes permitido asignar un descuento a la prenda.";

            } else {

                invalidPrice.classList.remove('d-block');
                invalidPrice.innerHTML = "El campo precio original es obligatorio.";
            } 


            if(discount.value !== '') {

                var discountVal   =  Number(discount.value);
                var discountPrice = actual - (actual * discountVal) / 100;
                var isValid       = discountPrice < 180 ? false : true;

                 if(!isValid) {

                    for (let index = 1; index < discountVal; index++) {

                        var value = Number(discountVal - index);
                        isValid   = (actual - (actual * value) / 100) < 180 ? false : true;
                        
                        if(isValid) {

                            discount = value;

                            invalidDiscount.classList.add('d-block');
                            invalidDiscount.innerHTML = "El descuento máx. que puedes agregar a tu prenda es "+discount+"%";

                            return;


                        } else {

                            invalidDiscount.classList.add('d-block');
                            invalidDiscount.innerHTML = "No tienes permitido asignar un descuento.";

                        } 
                    }
                        
                } else {

                    invalidDiscount.classList.remove('d-block');
                    invalidDiscount.innerHTML = "El campo descuento es obligatorio.";

                    return;
                }
            }
        }

        if(acceptPrice) {
           acceptPrice.addEventListener('keyup', function(e) {

                var invalidPrice     = document.querySelector('.js-invalid-feedback');
                var invalidDiscount  = document.querySelector('.js-invalid-discount');
                var discount         = document.querySelector('.js-discount');                           
                var actual           = Number(acceptPrice.value.replace(/[^0-9.-]+/g,""));

                if(actual < 180) {
                    invalidPrice.classList.add('d-block');
                    invalidPrice.innerHTML = "El precio mínimo de la prenda debe ser $180";

                } else {
                    invalidPrice.classList.remove('d-block');
                    invalidPrice.innerHTML = "El campo precio original es obligatorio.";
                }
                
                //checkDiscount(invalidPrice, invalidDiscount, discount, actual);
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

        // Function to check orientation of image from EXIF metadatas and draw canvas
        function orientation(img) {

            // Set variables
            var exifOrientation = '';
            var width = img.width,
                height = img.height;

            // Check orientation in EXIF metadatas
            EXIF.getData(img, function() {
                exifOrientation = EXIF.getTag(this, "Orientation");
                console.log('Exif orientation: ' + exifOrientation);
            });

            // transform context before drawing image
            switch (exifOrientation) {
                case 2:
                    img.classList.add('flip'); break;
                case 3:
                    img.classList.add('rotate-180'); break;
                case 4:
                    img.classList.add('flip-and-rotate-180'); break;
                case 5:
                    img.classList.add('flip-and-rotate-270'); break;
                case 6:
                    img.classList.add('rotate-90'); break;
                case 7:
                    img.classList.add('flip-and-rotate-90'); break;
                case 8:
                    img.classList.add('rotate-270'); break;
                // default:
                //     ctx.transform(1, 0, 0, 1, 0, 0);
            }
        }



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

                    // Use EXIF library to handle the loaded image exif orientation
                    EXIF.getData(file[0], function() {
                        // run orientation on img in canvas
                        orientation(img);
                    });

                    container.insertAdjacentHTML('beforeend', '<i class="far fa-edit" id="edit_icon"></i>');
                }

                reader.readAsDataURL(file[0]);
            });
        }

        if(departmentsSelect) {

            if(departmentsSelect.selectedIndex !== 0){
                changeDepartament(departmentsSelect);
            }            
                        
            departmentsSelect.addEventListener('change', changeDepartament);
        }

        if(categoriesSelect) {

            if(categoriesSelect.selectedIndex !== 0){
                changeCategory(categoriesSelect);
            } 

            categoriesSelect.addEventListener('change', changeCategory);
        }

        if(brandsSelect) {
            brandsSelect.addEventListener('change', changeBrand);
        }

        function changeDepartament(e) {              
            const el            = e.currentTarget ? e.currentTarget : e;       
            const departmentId  = el.options[el.selectedIndex].value;     
                
            const categoryId    = categoriesSelect.getAttribute('data-category');
            const categories    = JSON.parse(categoriesSelect.getAttribute('data-categories'));
/*             const brands        = JSON.parse(brandsSelect.getAttribute('data-brands'));
 */         const otherInput    = otherBrandSelect.querySelector('.form-control');
            let contentCategories = `<option value="">- Seleccionar -</option>`;
            let contentBrands     = `<option value="">- Seleccionar -</option>`;
            otherBrandSelect.classList.add('hidden');
            otherInput.removeAttribute('required');

            
            if(categories[departmentId] === undefined){
                contentCategories = `<option value="">- Sin categorías -</option>`;

            } else {

                categories[departmentId].forEach(category => {
                    contentCategories += `<option value="`+ category.CategoryID +`" `+(categoryId && categoryId == category.CategoryID ? 'selected' : '')+`>`+ category.CategoryName +`</option>`;
                });
            }

            categoriesSelect.innerHTML = contentCategories;

/*             if(brands[departmentId] === undefined){
                contentBrands = `<option value="">- Sin marcas -</option>`;

            } else {

                brands[departmentId].forEach(brand => {
                    contentBrands += `<option value="`+ brand.BrandID +`">`+ brand.BrandName +`</option>`;
                });

                contentBrands += `<option value="other">Otra marca</option>`;
            }

            brandsSelect.innerHTML = contentBrands; */

            departmentsSelect.addEventListener('change', changeDepartament);
            categoriesSelect.addEventListener('change', changeCategory);
        }

        function changeCategory(e) {
            const el            = e.currentTarget ? e.currentTarget : e;  
            const categoryId    = el.options[el.selectedIndex].value;
            const category      = el.options[el.selectedIndex].innerText;
            const clothingTypes = JSON.parse(clothingTypesSelect.getAttribute('data-clothing-types'));
            const sizes         = JSON.parse(sizesSelect.getAttribute('data-sizes'));
            const clothingTypeId = clothingTypesSelect.getAttribute('data-clothing-type');
            const sizeId        = sizesSelect.getAttribute('data-size');
            let contentSizes    = `<option value="">- Seleccionar -</option>`;
            let contentTypes    = `<option value="">- Seleccionar -</option>`;
       
            if(clothingTypes[categoryId] === undefined){
                contentTypes = `<option value="">- Sin tipos de prendas -</option>`;

            } else {

                clothingTypes[categoryId].forEach(type => {
                    contentTypes += `<option value="`+ type.ClothingTypeID +`" `+(clothingTypeId && clothingTypeId == type.ClothingTypeID ? 'selected' : '')+`>`+ type.ClothingTypeName +`</option>`;
                });
            }

            clothingTypesSelect.innerHTML = contentTypes;
            
            if(sizes[categoryId] === undefined){
                contentSizes = `<option value="">- Sin tallas -</option>`;

            } else {

                sizes[categoryId].forEach(size => {
                    contentSizes += `<option value="`+ size.SizeID +`" `+(sizeId && sizeId == size.SizeID ? 'selected' : '')+`>`+ size.SizeName +`</option>`;
                });
            }

            sizesSelect.innerHTML = contentSizes;

            categoriesSelect.addEventListener('change', changeCategory);
        }

        function changeBrand(e){
            const el       = e.currentTarget;
            const brand    = el.options[el.selectedIndex].value;
            var otherInput = otherBrandSelect.querySelector('.form-control');

            if(brand == 'other') {

                otherBrandSelect.classList.remove('hidden');
                otherInput.setAttribute('required',true);
            } else {

                otherBrandSelect.classList.add('hidden');
                otherInput.removeAttribute('required');
            }
        }


        if(addItems) {

            const container    = document.querySelector('.js-items-container');
            const realPictures = document.querySelector('.js-input-real-pictures');
            const btn          = document.querySelector('.js-add-items-btn');
            //const isNewItem    = container.getAttribute('data-item');

            var arr = [];

            addItems.addEventListener('change', function(e) {

                btn ? btn.classList.remove('hidden') : '';

                const items = document.querySelectorAll('.js-new-item');


                if(items.length > 0) {

                    for (var i = items.length - 1; i >= 0; i--) {
                        container.removeChild(items[i]);
                    }
                }

                /* if(isNewItem == true) {
                    container.innerHTML = "";
                }
 */
                const files = e.currentTarget.files;

                for (var i = 0; i < files.length; i++) {

                    var file = files[i];

                    const content = `<div class="mb-3 thumb-size mr-3 js-new-item" data-name="`+file.name+`">
                                        <div class="card">
                                        </div>
                                    </div>`;
                
                    const prev = container.querySelector('.thumb-size');

                    prev.insertAdjacentHTML('afterend', content);

                    const newContainer = document.querySelector('.js-new-item .card');

                    // Create a FileReader
                    var reader = new FileReader();
                    // Set onloadend function on reader
                    reader.onloadend = function (e) {

                        var imagen         = new Image();
                        imagen.style.width = "200px";
                        imagen.style.height = "200px";

                        // Use EXIF library to handle the loaded image exif orientation
                        EXIF.getData(file, function() {
                            // run orientation on img in canvas
                            orientation(imagen);
                        });                        

                        imagen.setAttribute('src', e.currentTarget.result);
                        imagen.classList.add('card-img-top');

                        newContainer.appendChild(imagen);

                        const button = `<a class="close delete-item js-delete-img" aria-label="Close" >
                        <i class="far fa-trash-alt"></i>
                        </a>`;

                        newContainer.insertAdjacentHTML('afterbegin', button);

                        const deleteImg = document.querySelector('.js-delete-img');

                    
                        deleteImg.addEventListener('click', function(e) {

                            arr = [];

                            container.removeChild(e.currentTarget.parentNode.parentNode);

                            const deleteImgAll = document.querySelectorAll('.js-delete-img');

                            if(deleteImgAll.length === 0) {
                                btn.classList.add('hidden');
                            }

                            const newItem = document.querySelectorAll('.js-new-item');

                            for (var i = newItem.length - 1; i >= 0; i--) {
                                arr.push(newItem[i].getAttribute('data-name'));
                            }

                            realPictures.value = arr;

                        });
                    };

                    // Trigger reader to read the file input
                    reader.readAsDataURL(file);
                }

                const newItem = document.querySelectorAll('.js-new-item');

                for (var i = newItem.length - 1; i >= 0; i--) {
                    arr.push(newItem[i].getAttribute('data-name'));
                }

                realPictures.value = arr;
            });
        }


        function insertAfter(e,i){ 

            if(e.nextElementSibling){                 
                e.parentNode.insertBefore(i,e.nextElementSibling); 
            } else { 
                e.parentNode.appendChild(i); 
            }
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
            container.innerHTML = "";

            // Create a FileReader
            var reader = new FileReader();
            // Set onloadend function on reader
            reader.onloadend = function (e) {

                var imagen         = new Image();
                imagen.style.width = "200px";

                // Use EXIF library to handle the loaded image exif orientation
                EXIF.getData(file[0], function() {
                    // run orientation on img in canvas
                    orientation(imagen);
                });                

                imagen.setAttribute('src', e.currentTarget.result);
                container.classList.add('card');
                container.appendChild(imagen);

                const isRequired = name === 'front' ? 'checked' : '';

                const button = `<a class="close delete-item js-delete-item" aria-label="Close"  data-type="`+type+`" data-name="`+name+`">
                <i class="far fa-trash-alt"></i>
                </a>`;

                const cover = `<div class="form-check cover-item">
                            <input class="form-check-input" type="radio" name="cover" id="cover_`+name+`" value="`+name+`" `+isRequired+`>
                            <label class="form-check-label" for="cover_`+name+`">
                                Portada
                            </label>
                            </div>`;

                container.insertAdjacentHTML('afterbegin', button);
                container.insertAdjacentHTML('beforeend', cover);

                const deleteButtons = document.querySelectorAll('.js-delete-item');

                Array.prototype.forEach.call(deleteButtons, (btn) => {
                    btn.addEventListener('click', deleteItem);
                });
            };

            // Trigger reader to read the file input
            reader.readAsDataURL(file[0]);
            
            console.log(el.files);
            
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

            const content = `<input type="file" name="`+name+`_item_file" id="`+name+`_item_file" class="no-file js-item-file custom-file-input" data-type="`+type+`" data-name="`+name+`" `+isRequired+`><label for="`+name+`_item_file" class="card card--file-item custom-file-label m-auto">
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

        if(textLimit) {
            Array.prototype.forEach.call(textLimit, (input) => {

                input.addEventListener('keydown', function(e) {
                    const limit = input.getAttribute('data-limit');
                    const lenght = e.currentTarget.value.length;

                    e.currentTarget.nextElementSibling.innerHTML = limit -  lenght + ' caracteres.';
                })
            });
        }  

    $('.js-currency-input').on({
        keyup: function() {
            formatCurrency($(this));
        }
    });


    function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.
    
    // get input value
    var input_val = input.val();
    
    // don't validate empty input
    if (input_val === "") { return; }
    
    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");
        
    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
        right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$" + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "$" + input_val;
        
        // final formatting
        if (blur === "blur") {
        input_val += ".00";
        }
    }
    
    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
    }

    </script>
  </body>
</html>
