!function(e){var t={};function n(r){if(t[r])return t[r].exports;var a=t[r]={i:r,l:!1,exports:{}};return e[r].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(r,a,function(t){return e[t]}.bind(null,a));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=84)}({84:function(e,t,n){e.exports=n(85)},85:function(e,t,n){"use strict";n.r(t);var r=n(9),a=n.n(r),i=document.querySelectorAll(".date_input"),o=document.querySelector(".js-check-offer"),s=document.querySelector(".js-selfie-input"),l=document.querySelector(".js-departments-select"),c=document.querySelector(".js-items-input"),u=document.querySelectorAll(".js-item-file"),d=document.querySelector(".js-add-items"),f=document.querySelectorAll(".js-text-limit"),m=document.querySelector(".js-categories-select"),p=document.querySelector(".js-brands-select"),g=document.querySelector(".js-other-brand"),h=document.querySelector(".js-clothing-type-select"),y=document.querySelector(".js-sizes-select"),v=(document.querySelector(".js-item-file-opt1"),document.querySelector(".js-item-file-opt2"),document.querySelector(".js-accept-price")),S=document.querySelector(".js-discount"),b=document.querySelector(".js-payment-btn"),x=document.querySelector("#uploadItem");$(".carousel").carousel("pause"),S&&S.addEventListener("keyup",(function(e){document.querySelector(".js-invalid-feedback"),document.querySelector(".js-invalid-discount"),e.currentTarget,Number(v.value.replace(/[^0-9.-]+/g,""))})),v&&v.addEventListener("keyup",(function(e){var t=document.querySelector(".js-invalid-feedback");document.querySelector(".js-invalid-discount"),document.querySelector(".js-discount");Number(v.value.replace(/[^0-9.-]+/g,""))<180?(t.classList.add("d-block"),t.innerHTML="El precio mínimo de la prenda debe ser $180"):(t.classList.remove("d-block"),t.innerHTML="El campo precio original es obligatorio.")}));for(var P=document.querySelectorAll(".container-fade p"),T=0;T<P.length;T++)P[T].innerText.length>=22?P[T].parentNode.classList.add("txt-fade"):P[T].parentNode.classList.remove("txt-fade");function C(e){var t="";e.width,e.height;switch(a.a.getData(e,(function(){t=a.a.getTag(this,"Orientation")})),t){case 2:e.classList.add("flip");break;case 3:e.classList.add("rotate-180");break;case 4:e.classList.add("flip-and-rotate-180");break;case 5:e.classList.add("flip-and-rotate-270");break;case 6:e.classList.add("rotate-90");break;case 7:e.classList.add("flip-and-rotate-90");break;case 8:e.classList.add("rotate-270")}}if(i[0]&&"date"!=i[0].type&&$(".date_input").datepicker({format:"dd/mm/yyyy",language:"es",orientation:"bottom auto",autoclose:!0}),window.addEventListener("load",(function(){var e=document.getElementsByClassName("needs-validation");Array.prototype.filter.call(e,(function(e){e.addEventListener("submit",(function(t){if(!1===e.checkValidity())t.preventDefault(),t.stopPropagation();else{var n=e.querySelector(".btn-fr"),r=n.querySelector("span");n.setAttribute("disabled","true"),r.classList.remove("hidden"),r.classList.add("spinner-border-block")}e.classList.add("was-validated")}),!1)}))}),!1),o){var L=document.querySelector(".js-check-container"),w=L.querySelectorAll("input");o.addEventListener("change",(function(e){if(e.currentTarget.checked){L.classList.remove("hidden");for(var t=w.length-1;t>=0;t--)w[t].setAttribute("required",!0)}else{L.classList.add("hidden");for(t=w.length-1;t>=0;t--)w[t].setAttribute("required",!1)}}))}if(s){var I=document.querySelector(".js-selfie-btn");s.addEventListener("change",(function(e){I.classList.remove("hidden");var t=document.querySelector(".js-selfie-img"),n=e.currentTarget.files,r=t.parentNode,i=new FileReader;i.onload=function(e){r.innerHTML="";var t=new Image;t.src=i.result,r.appendChild(t),t.style.width="100%",t.classList.add("card-img-top"),t.classList.add("js-selfie-img"),a.a.getData(n[0],(function(){C(t)})),r.insertAdjacentHTML("beforeend",'<i class="far fa-edit" id="edit_icon"></i>')},i.readAsDataURL(n[0])}))}function A(e){var t=e.currentTarget?e.currentTarget:e,n=t.options[t.selectedIndex].value,r=m.getAttribute("data-category"),a=JSON.parse(m.getAttribute("data-categories")),i=g.querySelector(".form-control"),o='<option value="">- Seleccionar -</option>';g.classList.add("hidden"),i.removeAttribute("required"),void 0===a[n]?o='<option value="">- Sin categorías -</option>':a[n].forEach((function(e){o+='<option value="'+e.CategoryID+'" '+(r&&r==e.CategoryID?"selected":"")+">"+e.CategoryName+"</option>"})),m.innerHTML=o,l.addEventListener("change",A),m.addEventListener("change",j)}function j(e){var t=e.currentTarget?e.currentTarget:e,n=t.options[t.selectedIndex].value,r=(t.options[t.selectedIndex].innerText,JSON.parse(h.getAttribute("data-clothing-types"))),a=JSON.parse(y.getAttribute("data-sizes")),i=h.getAttribute("data-clothing-type"),o=y.getAttribute("data-size"),s='<option value="">- Seleccionar -</option>',l='<option value="">- Seleccionar -</option>';void 0===r[n]?l='<option value="">- Sin tipos de prendas -</option>':r[n].forEach((function(e){l+='<option value="'+e.ClothingTypeID+'" '+(i&&i==e.ClothingTypeID?"selected":"")+">"+e.ClothingTypeName+"</option>"})),h.innerHTML=l,void 0===a[n]?s='<option value="">- Sin tallas -</option>':a[n].forEach((function(e){s+='<option value="'+e.SizeID+'" '+(o&&o==e.SizeID?"selected":"")+">"+e.SizeName+"</option>"})),y.innerHTML=s,m.addEventListener("change",j)}if(l&&(0!==l.selectedIndex&&A(l),l.addEventListener("change",A)),m&&(0!==m.selectedIndex&&j(m),m.addEventListener("change",j)),p&&p.addEventListener("change",(function(e){var t=e.currentTarget,n=t.options[t.selectedIndex].value,r=g.querySelector(".form-control");"other"==n?(g.classList.remove("hidden"),r.setAttribute("required",!0)):(g.classList.add("hidden"),r.removeAttribute("required"))})),d){var D=document.querySelector(".js-items-container"),E=document.querySelector(".js-input-real-pictures"),F=document.querySelector(".js-add-items-btn"),q=[];d.addEventListener("change",(function(e){F&&F.classList.remove("hidden");var t=document.querySelectorAll(".js-new-item");if(t.length>0)for(var n=t.length-1;n>=0;n--)D.removeChild(t[n]);var r=e.currentTarget.files,i=function(){var e='<div class="mb-3 thumb-size mr-3 js-new-item" data-name="'+(o=r[n]).name+'">\n                                <div class="card">\n                                </div>\n                            </div>';D.querySelector(".thumb-size").insertAdjacentHTML("afterend",e);var t=document.querySelector(".js-new-item .card");(s=new FileReader).onloadend=function(e){var n=new Image;n.style.width="200px",n.style.height="200px",a.a.getData(o,(function(){C(n)})),n.setAttribute("src",e.currentTarget.result),n.classList.add("card-img-top"),t.appendChild(n);t.insertAdjacentHTML("afterbegin",'<a class="close delete-item js-delete-img" aria-label="Close" >\n                <i class="far fa-trash-alt"></i>\n                </a>'),document.querySelector(".js-delete-img").addEventListener("click",(function(e){q=[],D.removeChild(e.currentTarget.parentNode.parentNode),0===document.querySelectorAll(".js-delete-img").length&&F.classList.add("hidden");for(var t=document.querySelectorAll(".js-new-item"),n=t.length-1;n>=0;n--)q.push(t[n].getAttribute("data-name"));E.value=q}))},s.readAsDataURL(o)};for(n=0;n<r.length;n++){var o,s;i()}var l=document.querySelectorAll(".js-new-item");for(n=l.length-1;n>=0;n--)q.push(l[n].getAttribute("data-name"));E.value=q}))}function k(e){var t=e.currentTarget?e.currentTarget:e,n=t.files,r=t.parentNode.querySelector(".container-item-img"),i=t.getAttribute("data-type"),o=t.getAttribute("data-name"),s=t.getAttribute("data-item");t.nextElementSibling.parentNode,t.nextElementSibling,t.nextElementSibling.previousElementSibling;r.previousElementSibling.style.display="none",r.innerHTML="";var l=new FileReader;l.onloadend=function(e){var t=new Image;t.style.width="200px",a.a.getData(n[0],(function(){C(t)})),t.setAttribute("src",e.currentTarget.result),r.classList.add("card"),r.appendChild(t);var l='<a class="close delete-item js-delete-item" aria-label="Close"  data-type="'+i+'" data-name="'+o+'" data-item="'+s+'">\n        <i class="far fa-trash-alt"></i>\n        </a>',c='<div class="form-check cover-item">\n                    <input class="form-check-input" type="radio" name="cover" id="cover_'+o+'" data-item="'+s+'" value="'+o+'" '+("front"===o?"checked":"")+'>\n                    <label class="form-check-label" for="cover_'+o+'">\n                    <span>\n                    Portada\n                    </span>\n                    </label>\n                    </div>';r.insertAdjacentHTML("afterbegin",l),"true"==s&&r.insertAdjacentHTML("beforeend",c);var u=document.querySelectorAll(".js-delete-item");Array.prototype.forEach.call(u,(function(e){e.addEventListener("click",U)}))},l.readAsDataURL(n[0]);for(var c=0,u={0:"front",1:"label",2:"back",3:"selfie",4:"in",5:"extra"},d=0;d<Object.keys(u).length;d++){var f=document.querySelector("#"+u[d]+"_item_file");(null===f||f.files.length>0)&&c++}for(var m=0;m<Object.keys(u).length;m++){var p=document.querySelector("#"+u[m]+"_item_file");null!==p&&c>=3&&p.removeAttribute("required")}}function U(e){var t=e.currentTarget.getAttribute("data-type"),n=e.currentTarget.getAttribute("data-name"),r=e.currentTarget.getAttribute("data-item"),a=e.currentTarget.parentNode.parentNode,i=e.currentTarget.parentNode.previousElementSibling,o=e.currentTarget.parentNode.previousElementSibling.previousElementSibling;e.currentTarget.parentNode.innerHTML="",a.removeChild(i),a.removeChild(o);var s='<input type="file" name="'+n+'_item_file" id="'+n+'_item_file" data-item="'+r+'" class="no-file js-item-file custom-file-input" data-type="'+t+'" data-name="'+n+'" '+("in"!==n||"selfie"!==n?'required="true"':"")+'><label for="'+n+'_item_file" class="card card--file-item custom-file-label m-auto">\n          <span><i class="far fa-image"></i> <br>'+t+"</span>\n        </label>";a.insertAdjacentHTML("afterbegin",s);for(var l=document.querySelectorAll(".js-item-file"),c=0,u={0:"front",1:"label",2:"back",3:"selfie",4:"in",5:"extra"},d=0;d<Object.keys(u).length;d++){var f=document.querySelector("#"+u[d]+"_item_file");null!==f&&f.files.length>0&&c++}for(var m=0;m<Object.keys(u).length;m++){var p=document.querySelector("#"+u[m]+"_item_file");null!==p&&c>=3&&p.removeAttribute("required")}Array.prototype.forEach.call(l,(function(e){e.addEventListener("change",k)}))}if(u&&Array.prototype.forEach.call(u,(function(e){e.files.length>0&&k(e),e.addEventListener("change",k)})),c){var R=document.querySelector("#itemsList"),N=document.querySelector(".js-input-real-pictures");q=[];c.addEventListener("change",(function(e){for(var t=e.currentTarget.files,n=t.length-1;n>=0;n--){var r='<span class="badge badge-pill green-color w-100 text-left">'+t[n].name+'\n                <i class="fas fa-times green-color float-right cursor-pointer js-delete-item" data-key="'+n+'" data-name="'+t[n].name+'"></i>\n                </span>';R.insertAdjacentHTML("beforeend",r),q.push(t[n].name)}N.value=q;var a=document.querySelectorAll(".js-delete-item");Array.prototype.forEach.call(a,(function(e){e.addEventListener("click",(function(e){q=[],R.removeChild(e.currentTarget.parentNode);for(var t=document.querySelectorAll("#itemsList span"),n=t.length-1;n>=0;n--)q.push(t[n].innerText);N.value=q}))}))}))}function M(e){return e.replace(/\D/g,"").replace(/\B(?=(\d{3})+(?!\d))/g,",")}function O(e,t,n){return fetch("https://pp-users-integrations-api-prod.herokuapp.com/keys/"+e.key._id+"/verify",{method:"GET",redirect:"follow"}).then((function(e){return e.text()})).then((function(e){var r=JSON.parse(e);if(r.success){var a=function(e,t,n){var r=e.data.key,a=JSON.stringify(n)+t+r;return sha256(a)}(r,t,n);localStorage.setItem("token",a)}})).catch((function(e){return console.log("error",e)})),localStorage.getItem("token")}f&&Array.prototype.forEach.call(f,(function(e){e.addEventListener("keydown",(function(t){var n=e.getAttribute("data-limit"),r=t.currentTarget.value.length;t.currentTarget.nextElementSibling.innerHTML=n-r+" caracteres."}))})),$(".js-currency-input").on({keyup:function(){!function(e,t){var n=e.val();if(""===n)return;var r=n.length,a=e.prop("selectionStart");if(n.indexOf(".")>=0){var i=n.indexOf("."),o=n.substring(0,i),s=n.substring(i);o=M(o),s=M(s),"blur"===t&&(s+="00"),s=s.substring(0,2),n="$"+o+"."+s}else n="$"+(n=M(n)),"blur"===t&&(n+=".00");e.val(n);var l=n.length;a=l-r+a,e[0].setSelectionRange(a,a)}($(this))}}),b&&b.addEventListener("click",(function(e){(new Date).getTime();for(var t=function(e){null,(r=new Headers).append("Content-Type","application/json"),a=JSON.stringify({email:"heavyjra@gmail.com",password:"F12345678R"}),fetch("https://pp-users-integrations-api-prod.herokuapp.com/signin/email",{method:"POST",headers:r,body:a,redirect:"follow"}).then((function(e){return e.text()})).then((function(e){!function(e,t){var n=e.user._id,r="/shipments/native",a={address_delivery:{send_email:!1,address1:"Cholula",address2:"La Paz",zip_code:"72160",state:"Puebla",city:"Heroica Puebla de Zaragoza",ext:"35",int:null,customer:{first_name:"Cliente",last_name:"Cliente",phone:2222222222,email:"ejemplo@ejemplo.com"}},address_pickup:{collect:!0,address1:"Calle 16 Sur",address2:"Residencial Puebla",zip_code:"72530",state:"Puebla",city:"Heroica Puebla de Zaragoza",ext:"3307",int:null,municipality:"",customer:{first_name:"Usuario",last_name:"Usuario",phone:2222222222,email:"ejemplo@ejemplo.com"}},insurance:{amount:0,declared:!1},shipping_information:{coverage_entry:"5b2ae7556e2cabc183dcc9ea",end_time:"1020",quote_from:"packandpack",service_type:"5b2acaf5b5de20bb7f53a654",start_time:"720"},size:{weight:12,width:10,height:10,deep:10}},i=O(e,r,a);console.log("ENVIAR"),console.log("USER_ID: "+n),console.log("token: "+i);var o=new Headers;o.append("Content-Type","application/json"),o.append("user_id",n),o.append("token",i);var s=JSON.stringify(a);fetch("https://pp-users-integrations-api-prod.herokuapp.com"+r,{method:"POST",headers:o,body:s,redirect:"follow"}).then((function(e){return e.text()})).then((function(e){return console.log(e)})).catch((function(e){return console.log("error",e)}))}(JSON.parse(e))})).catch((function(e){return console.log("error",e)}))},n=0;n<25;n++){var r,a;t()}})),x&&x.addEventListener("click",(function(e){window.scrollTo(0,0)}))},9:function(e,t,n){var r;function a(e){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}(function(){var n=function e(t){return t instanceof e?t:this instanceof e?void(this.EXIFwrapped=t):new e(t)};e.exports&&(t=e.exports=n),t.EXIF=n;var i=n.Tags={36864:"ExifVersion",40960:"FlashpixVersion",40961:"ColorSpace",40962:"PixelXDimension",40963:"PixelYDimension",37121:"ComponentsConfiguration",37122:"CompressedBitsPerPixel",37500:"MakerNote",37510:"UserComment",40964:"RelatedSoundFile",36867:"DateTimeOriginal",36868:"DateTimeDigitized",37520:"SubsecTime",37521:"SubsecTimeOriginal",37522:"SubsecTimeDigitized",33434:"ExposureTime",33437:"FNumber",34850:"ExposureProgram",34852:"SpectralSensitivity",34855:"ISOSpeedRatings",34856:"OECF",37377:"ShutterSpeedValue",37378:"ApertureValue",37379:"BrightnessValue",37380:"ExposureBias",37381:"MaxApertureValue",37382:"SubjectDistance",37383:"MeteringMode",37384:"LightSource",37385:"Flash",37396:"SubjectArea",37386:"FocalLength",41483:"FlashEnergy",41484:"SpatialFrequencyResponse",41486:"FocalPlaneXResolution",41487:"FocalPlaneYResolution",41488:"FocalPlaneResolutionUnit",41492:"SubjectLocation",41493:"ExposureIndex",41495:"SensingMethod",41728:"FileSource",41729:"SceneType",41730:"CFAPattern",41985:"CustomRendered",41986:"ExposureMode",41987:"WhiteBalance",41988:"DigitalZoomRation",41989:"FocalLengthIn35mmFilm",41990:"SceneCaptureType",41991:"GainControl",41992:"Contrast",41993:"Saturation",41994:"Sharpness",41995:"DeviceSettingDescription",41996:"SubjectDistanceRange",40965:"InteroperabilityIFDPointer",42016:"ImageUniqueID"},o=n.TiffTags={256:"ImageWidth",257:"ImageHeight",34665:"ExifIFDPointer",34853:"GPSInfoIFDPointer",40965:"InteroperabilityIFDPointer",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",274:"Orientation",277:"SamplesPerPixel",284:"PlanarConfiguration",530:"YCbCrSubSampling",531:"YCbCrPositioning",282:"XResolution",283:"YResolution",296:"ResolutionUnit",273:"StripOffsets",278:"RowsPerStrip",279:"StripByteCounts",513:"JPEGInterchangeFormat",514:"JPEGInterchangeFormatLength",301:"TransferFunction",318:"WhitePoint",319:"PrimaryChromaticities",529:"YCbCrCoefficients",532:"ReferenceBlackWhite",306:"DateTime",270:"ImageDescription",271:"Make",272:"Model",305:"Software",315:"Artist",33432:"Copyright"},s=n.GPSTags={0:"GPSVersionID",1:"GPSLatitudeRef",2:"GPSLatitude",3:"GPSLongitudeRef",4:"GPSLongitude",5:"GPSAltitudeRef",6:"GPSAltitude",7:"GPSTimeStamp",8:"GPSSatellites",9:"GPSStatus",10:"GPSMeasureMode",11:"GPSDOP",12:"GPSSpeedRef",13:"GPSSpeed",14:"GPSTrackRef",15:"GPSTrack",16:"GPSImgDirectionRef",17:"GPSImgDirection",18:"GPSMapDatum",19:"GPSDestLatitudeRef",20:"GPSDestLatitude",21:"GPSDestLongitudeRef",22:"GPSDestLongitude",23:"GPSDestBearingRef",24:"GPSDestBearing",25:"GPSDestDistanceRef",26:"GPSDestDistance",27:"GPSProcessingMethod",28:"GPSAreaInformation",29:"GPSDateStamp",30:"GPSDifferential"},l=n.IFD1Tags={256:"ImageWidth",257:"ImageHeight",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",273:"StripOffsets",274:"Orientation",277:"SamplesPerPixel",278:"RowsPerStrip",279:"StripByteCounts",282:"XResolution",283:"YResolution",284:"PlanarConfiguration",296:"ResolutionUnit",513:"JpegIFOffset",514:"JpegIFByteCount",529:"YCbCrCoefficients",530:"YCbCrSubSampling",531:"YCbCrPositioning",532:"ReferenceBlackWhite"},c=n.StringValues={ExposureProgram:{0:"Not defined",1:"Manual",2:"Normal program",3:"Aperture priority",4:"Shutter priority",5:"Creative program",6:"Action program",7:"Portrait mode",8:"Landscape mode"},MeteringMode:{0:"Unknown",1:"Average",2:"CenterWeightedAverage",3:"Spot",4:"MultiSpot",5:"Pattern",6:"Partial",255:"Other"},LightSource:{0:"Unknown",1:"Daylight",2:"Fluorescent",3:"Tungsten (incandescent light)",4:"Flash",9:"Fine weather",10:"Cloudy weather",11:"Shade",12:"Daylight fluorescent (D 5700 - 7100K)",13:"Day white fluorescent (N 4600 - 5400K)",14:"Cool white fluorescent (W 3900 - 4500K)",15:"White fluorescent (WW 3200 - 3700K)",17:"Standard light A",18:"Standard light B",19:"Standard light C",20:"D55",21:"D65",22:"D75",23:"D50",24:"ISO studio tungsten",255:"Other"},Flash:{0:"Flash did not fire",1:"Flash fired",5:"Strobe return light not detected",7:"Strobe return light detected",9:"Flash fired, compulsory flash mode",13:"Flash fired, compulsory flash mode, return light not detected",15:"Flash fired, compulsory flash mode, return light detected",16:"Flash did not fire, compulsory flash mode",24:"Flash did not fire, auto mode",25:"Flash fired, auto mode",29:"Flash fired, auto mode, return light not detected",31:"Flash fired, auto mode, return light detected",32:"No flash function",65:"Flash fired, red-eye reduction mode",69:"Flash fired, red-eye reduction mode, return light not detected",71:"Flash fired, red-eye reduction mode, return light detected",73:"Flash fired, compulsory flash mode, red-eye reduction mode",77:"Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",79:"Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",89:"Flash fired, auto mode, red-eye reduction mode",93:"Flash fired, auto mode, return light not detected, red-eye reduction mode",95:"Flash fired, auto mode, return light detected, red-eye reduction mode"},SensingMethod:{1:"Not defined",2:"One-chip color area sensor",3:"Two-chip color area sensor",4:"Three-chip color area sensor",5:"Color sequential area sensor",7:"Trilinear sensor",8:"Color sequential linear sensor"},SceneCaptureType:{0:"Standard",1:"Landscape",2:"Portrait",3:"Night scene"},SceneType:{1:"Directly photographed"},CustomRendered:{0:"Normal process",1:"Custom process"},WhiteBalance:{0:"Auto white balance",1:"Manual white balance"},GainControl:{0:"None",1:"Low gain up",2:"High gain up",3:"Low gain down",4:"High gain down"},Contrast:{0:"Normal",1:"Soft",2:"Hard"},Saturation:{0:"Normal",1:"Low saturation",2:"High saturation"},Sharpness:{0:"Normal",1:"Soft",2:"Hard"},SubjectDistanceRange:{0:"Unknown",1:"Macro",2:"Close view",3:"Distant view"},FileSource:{3:"DSC"},Components:{0:"",1:"Y",2:"Cb",3:"Cr",4:"R",5:"G",6:"B"}};function u(e){return!!e.exifdata}function d(e,t){function r(r){var a=f(r);e.exifdata=a||{};var i=function(e){var t=new DataView(e);0;if(255!=t.getUint8(0)||216!=t.getUint8(1))return!1;var n=2,r=e.byteLength,a=function(e,t){return 56===e.getUint8(t)&&66===e.getUint8(t+1)&&73===e.getUint8(t+2)&&77===e.getUint8(t+3)&&4===e.getUint8(t+4)&&4===e.getUint8(t+5)};for(;n<r;){if(a(t,n)){var i=t.getUint8(n+7);i%2!=0&&(i+=1),0===i&&(i=4);var o=n+8+i,s=t.getUint16(n+6+i);return p(e,o,s)}n++}}(r);if(e.iptcdata=i||{},n.isXmpEnabled){var o=function(e){if(!("DOMParser"in self))return;var t=new DataView(e);0;if(255!=t.getUint8(0)||216!=t.getUint8(1))return!1;var n=2,r=e.byteLength,a=new DOMParser;for(;n<r-4;){if("http"==y(t,n,4)){var i=n-1,o=t.getUint16(n-2)-1,s=y(t,i,o),l=s.indexOf("xmpmeta>")+8,c=(s=s.substring(s.indexOf("<x:xmpmeta"),l)).indexOf("x:xmpmeta")+10;return s=s.slice(0,c)+'xmlns:Iptc4xmpCore="http://iptc.org/std/Iptc4xmpCore/1.0/xmlns/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:tiff="http://ns.adobe.com/tiff/1.0/" xmlns:plus="http://schemas.android.com/apk/lib/com.google.android.gms.plus" xmlns:ext="http://www.gettyimages.com/xsltExtension/1.0" xmlns:exif="http://ns.adobe.com/exif/1.0/" xmlns:stEvt="http://ns.adobe.com/xap/1.0/sType/ResourceEvent#" xmlns:stRef="http://ns.adobe.com/xap/1.0/sType/ResourceRef#" xmlns:crs="http://ns.adobe.com/camera-raw-settings/1.0/" xmlns:xapGImg="http://ns.adobe.com/xap/1.0/g/img/" xmlns:Iptc4xmpExt="http://iptc.org/std/Iptc4xmpExt/2008-02-29/" '+s.slice(c),b(a.parseFromString(s,"text/xml"))}n++}}(r);e.xmpdata=o||{}}t&&t.call(e)}if(e.src)if(/^data\:/i.test(e.src))r(function(e,t){t=t||e.match(/^data\:([^\;]+)\;base64,/im)[1]||"",e=e.replace(/^data\:([^\;]+)\;base64,/gim,"");for(var n=atob(e),r=n.length,a=new ArrayBuffer(r),i=new Uint8Array(a),o=0;o<r;o++)i[o]=n.charCodeAt(o);return a}(e.src));else if(/^blob\:/i.test(e.src)){(i=new FileReader).onload=function(e){r(e.target.result)},function(e,t){var n=new XMLHttpRequest;n.open("GET",e,!0),n.responseType="blob",n.onload=function(e){200!=this.status&&0!==this.status||t(this.response)},n.send()}(e.src,(function(e){i.readAsArrayBuffer(e)}))}else{var a=new XMLHttpRequest;a.onload=function(){if(200!=this.status&&0!==this.status)throw"Could not load image";r(a.response),a=null},a.open("GET",e.src,!0),a.responseType="arraybuffer",a.send(null)}else if(self.FileReader&&(e instanceof self.Blob||e instanceof self.File)){var i;(i=new FileReader).onload=function(e){r(e.target.result)},i.readAsArrayBuffer(e)}}function f(e){var t=new DataView(e);if(255!=t.getUint8(0)||216!=t.getUint8(1))return!1;for(var n=2,r=e.byteLength;n<r;){if(255!=t.getUint8(n))return!1;if(225==t.getUint8(n+1))return v(t,n+4,t.getUint16(n+2));n+=2+t.getUint16(n+2)}}var m={120:"caption",110:"credit",25:"keywords",55:"dateCreated",80:"byline",85:"bylineTitle",122:"captionWriter",105:"headline",116:"copyright",15:"category"};function p(e,t,n){for(var r,a,i,o,s=new DataView(e),l={},c=t;c<t+n;)28===s.getUint8(c)&&2===s.getUint8(c+1)&&(o=s.getUint8(c+2))in m&&((i=s.getInt16(c+3))+5,a=m[o],r=y(s,c+5,i),l.hasOwnProperty(a)?l[a]instanceof Array?l[a].push(r):l[a]=[l[a],r]:l[a]=r),c++;return l}function g(e,t,n,r,a){var i,o,s=e.getUint16(n,!a),l={};for(o=0;o<s;o++)i=n+12*o+2,l[r[e.getUint16(i,!a)]]=h(e,i,t,n,a);return l}function h(e,t,n,r,a){var i,o,s,l,c,u,d=e.getUint16(t+2,!a),f=e.getUint32(t+4,!a),m=e.getUint32(t+8,!a)+n;switch(d){case 1:case 7:if(1==f)return e.getUint8(t+8,!a);for(i=f>4?m:t+8,o=[],l=0;l<f;l++)o[l]=e.getUint8(i+l);return o;case 2:return y(e,i=f>4?m:t+8,f-1);case 3:if(1==f)return e.getUint16(t+8,!a);for(i=f>2?m:t+8,o=[],l=0;l<f;l++)o[l]=e.getUint16(i+2*l,!a);return o;case 4:if(1==f)return e.getUint32(t+8,!a);for(o=[],l=0;l<f;l++)o[l]=e.getUint32(m+4*l,!a);return o;case 5:if(1==f)return c=e.getUint32(m,!a),u=e.getUint32(m+4,!a),(s=new Number(c/u)).numerator=c,s.denominator=u,s;for(o=[],l=0;l<f;l++)c=e.getUint32(m+8*l,!a),u=e.getUint32(m+4+8*l,!a),o[l]=new Number(c/u),o[l].numerator=c,o[l].denominator=u;return o;case 9:if(1==f)return e.getInt32(t+8,!a);for(o=[],l=0;l<f;l++)o[l]=e.getInt32(m+4*l,!a);return o;case 10:if(1==f)return e.getInt32(m,!a)/e.getInt32(m+4,!a);for(o=[],l=0;l<f;l++)o[l]=e.getInt32(m+8*l,!a)/e.getInt32(m+4+8*l,!a);return o}}function y(e,t,n){for(var r="",a=t;a<t+n;a++)r+=String.fromCharCode(e.getUint8(a));return r}function v(e,t){if("Exif"!=y(e,t,4))return!1;var n,r,a,u,d,f=t+6;if(18761==e.getUint16(f))n=!1;else{if(19789!=e.getUint16(f))return!1;n=!0}if(42!=e.getUint16(f+2,!n))return!1;var m=e.getUint32(f+4,!n);if(m<8)return!1;if((r=g(e,f,f+m,o,n)).ExifIFDPointer)for(a in u=g(e,f,f+r.ExifIFDPointer,i,n)){switch(a){case"LightSource":case"Flash":case"MeteringMode":case"ExposureProgram":case"SensingMethod":case"SceneCaptureType":case"SceneType":case"CustomRendered":case"WhiteBalance":case"GainControl":case"Contrast":case"Saturation":case"Sharpness":case"SubjectDistanceRange":case"FileSource":u[a]=c[a][u[a]];break;case"ExifVersion":case"FlashpixVersion":u[a]=String.fromCharCode(u[a][0],u[a][1],u[a][2],u[a][3]);break;case"ComponentsConfiguration":u[a]=c.Components[u[a][0]]+c.Components[u[a][1]]+c.Components[u[a][2]]+c.Components[u[a][3]]}r[a]=u[a]}if(r.GPSInfoIFDPointer)for(a in d=g(e,f,f+r.GPSInfoIFDPointer,s,n)){switch(a){case"GPSVersionID":d[a]=d[a][0]+"."+d[a][1]+"."+d[a][2]+"."+d[a][3]}r[a]=d[a]}return r.thumbnail=function(e,t,n,r){var a=function(e,t,n){var r=e.getUint16(t,!n);return e.getUint32(t+2+12*r,!n)}(e,t+n,r);if(!a)return{};if(a>e.byteLength)return{};var i=g(e,t,t+a,l,r);if(i.Compression)switch(i.Compression){case 6:if(i.JpegIFOffset&&i.JpegIFByteCount){var o=t+i.JpegIFOffset,s=i.JpegIFByteCount;i.blob=new Blob([new Uint8Array(e.buffer,o,s)],{type:"image/jpeg"})}break;case 1:console.log("Thumbnail image format is TIFF, which is not implemented.");break;default:console.log("Unknown thumbnail image format '%s'",i.Compression)}else 2==i.PhotometricInterpretation&&console.log("Thumbnail image format is RGB, which is not implemented.");return i}(e,f,m,n),r}function S(e){var t={};if(1==e.nodeType){if(e.attributes.length>0){t["@attributes"]={};for(var n=0;n<e.attributes.length;n++){var r=e.attributes.item(n);t["@attributes"][r.nodeName]=r.nodeValue}}}else if(3==e.nodeType)return e.nodeValue;if(e.hasChildNodes())for(var a=0;a<e.childNodes.length;a++){var i=e.childNodes.item(a),o=i.nodeName;if(null==t[o])t[o]=S(i);else{if(null==t[o].push){var s=t[o];t[o]=[],t[o].push(s)}t[o].push(S(i))}}return t}function b(e){try{var t={};if(e.children.length>0)for(var n=0;n<e.children.length;n++){var r=e.children.item(n),a=r.attributes;for(var i in a){var o=a[i],s=o.nodeName,l=o.nodeValue;void 0!==s&&(t[s]=l)}var c=r.nodeName;if(void 0===t[c])t[c]=S(r);else{if(void 0===t[c].push){var u=t[c];t[c]=[],t[c].push(u)}t[c].push(S(r))}}else t=e.textContent;return t}catch(e){console.log(e.message)}}n.enableXmp=function(){n.isXmpEnabled=!0},n.disableXmp=function(){n.isXmpEnabled=!1},n.getData=function(e,t){return!((self.Image&&e instanceof self.Image||self.HTMLImageElement&&e instanceof self.HTMLImageElement)&&!e.complete)&&(u(e)?t&&t.call(e):d(e,t),!0)},n.getTag=function(e,t){if(u(e))return e.exifdata[t]},n.getIptcTag=function(e,t){if(u(e))return e.iptcdata[t]},n.getAllTags=function(e){if(!u(e))return{};var t,n=e.exifdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},n.getAllIptcTags=function(e){if(!u(e))return{};var t,n=e.iptcdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},n.pretty=function(e){if(!u(e))return"";var t,n=e.exifdata,r="";for(t in n)n.hasOwnProperty(t)&&("object"==a(n[t])?n[t]instanceof Number?r+=t+" : "+n[t]+" ["+n[t].numerator+"/"+n[t].denominator+"]\r\n":r+=t+" : ["+n[t].length+" values]\r\n":r+=t+" : "+n[t]+"\r\n");return r},n.readFromBinaryFile=function(e){return f(e)},void 0===(r=function(){return n}.apply(t,[]))||(e.exports=r)}).call(this)}});