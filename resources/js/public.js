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