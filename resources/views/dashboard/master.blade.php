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
    <link rel="stylesheet" href="{{ url('css/index.css?1.10') }}" />
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
        const brandsSelect = document.querySelector('.js-brands-select');
        const itemsInput = document.querySelector('.js-items-input');

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

        if(brandsSelect) {

            brandsSelect.addEventListener('change', function(e) {
                
                //console.log(this.value);
                // const request = new XMLHttpRequest();
                // //const data    = new FormData(form);
                // const url     = window.location.origin;

                // request.open('GET', url+'/departments-by-brand/'+this.value, true);
                // //request.setRequestHeader('X-CSRF-Token', token);
                // //request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                // request.onload = function() {
                //   if (request.status >= 200 && request.status < 400) {
                            
                //     console.log('yes');

                //   } else {
                //     // We reached our target server, but it returned an error

                //    console.log('no');

                //   }
                // };

                // request.onerror = function() {
                //     // There was a connection error of some sort
                //     console.log('Ocurrió un error de conexión, por favor intente de nuevo.');

                // };
            });     
        }

        if(itemsInput) {

            const list = document.querySelector('#itemsList');
            const realPictures = document.querySelector('.js-input-real-pictures');
            var arr1 = [];
        
            itemsInput.addEventListener('change', function(e) {
                const files = e.currentTarget.files;

                for (var i = files.length - 1; i >= 0; i--) {
                    //var node = document.createElement("li");
                    
                    var item = `<span class="badge badge-pill green-color w-100 text-left">`+files[i].name+`                                            
                        <i class="fas fa-times green-color float-right cursor-pointer js-delete-item" data-key="`+i+`" data-name="`+files[i].name+`"></i>
                        </span>`;

                    list.insertAdjacentHTML('beforeend', item);

                    arr1.push(files[i].name);
                }

                realPictures.value = arr1;

                const deleteItem = document.querySelectorAll('.js-delete-item');

                Array.prototype.forEach.call(deleteItem, (btn) => {

                  btn.addEventListener('click', function(e) {
                    arr1 = [];
                    list.removeChild(e.currentTarget.parentNode);

                    const newList = document.querySelectorAll('#itemsList span');

                    for (var i = newList.length - 1; i >= 0; i--) {
                        arr1.push(newList[i].innerText);
                    }

                    realPictures.value = arr1;

                  });

                });

            });

             
        }



    </script>
  </body>
</html>
