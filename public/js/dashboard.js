!function(e){var t={};function n(r){if(t[r])return t[r].exports;var a=t[r]={i:r,l:!1,exports:{}};return e[r].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(r,a,function(t){return e[t]}.bind(null,a));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=353)}({29:function(e,t,n){var r;function a(e){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}(function(){for(var n=0;n<array.length;n++)array[n];var i=!1,o=function e(t){return t instanceof e?t:this instanceof e?void(this.EXIFwrapped=t):new e(t)};e.exports&&(t=e.exports=o),t.EXIF=o;var s=o.Tags={36864:"ExifVersion",40960:"FlashpixVersion",40961:"ColorSpace",40962:"PixelXDimension",40963:"PixelYDimension",37121:"ComponentsConfiguration",37122:"CompressedBitsPerPixel",37500:"MakerNote",37510:"UserComment",40964:"RelatedSoundFile",36867:"DateTimeOriginal",36868:"DateTimeDigitized",37520:"SubsecTime",37521:"SubsecTimeOriginal",37522:"SubsecTimeDigitized",33434:"ExposureTime",33437:"FNumber",34850:"ExposureProgram",34852:"SpectralSensitivity",34855:"ISOSpeedRatings",34856:"OECF",37377:"ShutterSpeedValue",37378:"ApertureValue",37379:"BrightnessValue",37380:"ExposureBias",37381:"MaxApertureValue",37382:"SubjectDistance",37383:"MeteringMode",37384:"LightSource",37385:"Flash",37396:"SubjectArea",37386:"FocalLength",41483:"FlashEnergy",41484:"SpatialFrequencyResponse",41486:"FocalPlaneXResolution",41487:"FocalPlaneYResolution",41488:"FocalPlaneResolutionUnit",41492:"SubjectLocation",41493:"ExposureIndex",41495:"SensingMethod",41728:"FileSource",41729:"SceneType",41730:"CFAPattern",41985:"CustomRendered",41986:"ExposureMode",41987:"WhiteBalance",41988:"DigitalZoomRation",41989:"FocalLengthIn35mmFilm",41990:"SceneCaptureType",41991:"GainControl",41992:"Contrast",41993:"Saturation",41994:"Sharpness",41995:"DeviceSettingDescription",41996:"SubjectDistanceRange",40965:"InteroperabilityIFDPointer",42016:"ImageUniqueID"},l=o.TiffTags={256:"ImageWidth",257:"ImageHeight",34665:"ExifIFDPointer",34853:"GPSInfoIFDPointer",40965:"InteroperabilityIFDPointer",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",274:"Orientation",277:"SamplesPerPixel",284:"PlanarConfiguration",530:"YCbCrSubSampling",531:"YCbCrPositioning",282:"XResolution",283:"YResolution",296:"ResolutionUnit",273:"StripOffsets",278:"RowsPerStrip",279:"StripByteCounts",513:"JPEGInterchangeFormat",514:"JPEGInterchangeFormatLength",301:"TransferFunction",318:"WhitePoint",319:"PrimaryChromaticities",529:"YCbCrCoefficients",532:"ReferenceBlackWhite",306:"DateTime",270:"ImageDescription",271:"Make",272:"Model",305:"Software",315:"Artist",33432:"Copyright"},c=o.GPSTags={0:"GPSVersionID",1:"GPSLatitudeRef",2:"GPSLatitude",3:"GPSLongitudeRef",4:"GPSLongitude",5:"GPSAltitudeRef",6:"GPSAltitude",7:"GPSTimeStamp",8:"GPSSatellites",9:"GPSStatus",10:"GPSMeasureMode",11:"GPSDOP",12:"GPSSpeedRef",13:"GPSSpeed",14:"GPSTrackRef",15:"GPSTrack",16:"GPSImgDirectionRef",17:"GPSImgDirection",18:"GPSMapDatum",19:"GPSDestLatitudeRef",20:"GPSDestLatitude",21:"GPSDestLongitudeRef",22:"GPSDestLongitude",23:"GPSDestBearingRef",24:"GPSDestBearing",25:"GPSDestDistanceRef",26:"GPSDestDistance",27:"GPSProcessingMethod",28:"GPSAreaInformation",29:"GPSDateStamp",30:"GPSDifferential"},d=o.IFD1Tags={256:"ImageWidth",257:"ImageHeight",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",273:"StripOffsets",274:"Orientation",277:"SamplesPerPixel",278:"RowsPerStrip",279:"StripByteCounts",282:"XResolution",283:"YResolution",284:"PlanarConfiguration",296:"ResolutionUnit",513:"JpegIFOffset",514:"JpegIFByteCount",529:"YCbCrCoefficients",530:"YCbCrSubSampling",531:"YCbCrPositioning",532:"ReferenceBlackWhite"},u=o.StringValues={ExposureProgram:{0:"Not defined",1:"Manual",2:"Normal program",3:"Aperture priority",4:"Shutter priority",5:"Creative program",6:"Action program",7:"Portrait mode",8:"Landscape mode"},MeteringMode:{0:"Unknown",1:"Average",2:"CenterWeightedAverage",3:"Spot",4:"MultiSpot",5:"Pattern",6:"Partial",255:"Other"},LightSource:{0:"Unknown",1:"Daylight",2:"Fluorescent",3:"Tungsten (incandescent light)",4:"Flash",9:"Fine weather",10:"Cloudy weather",11:"Shade",12:"Daylight fluorescent (D 5700 - 7100K)",13:"Day white fluorescent (N 4600 - 5400K)",14:"Cool white fluorescent (W 3900 - 4500K)",15:"White fluorescent (WW 3200 - 3700K)",17:"Standard light A",18:"Standard light B",19:"Standard light C",20:"D55",21:"D65",22:"D75",23:"D50",24:"ISO studio tungsten",255:"Other"},Flash:{0:"Flash did not fire",1:"Flash fired",5:"Strobe return light not detected",7:"Strobe return light detected",9:"Flash fired, compulsory flash mode",13:"Flash fired, compulsory flash mode, return light not detected",15:"Flash fired, compulsory flash mode, return light detected",16:"Flash did not fire, compulsory flash mode",24:"Flash did not fire, auto mode",25:"Flash fired, auto mode",29:"Flash fired, auto mode, return light not detected",31:"Flash fired, auto mode, return light detected",32:"No flash function",65:"Flash fired, red-eye reduction mode",69:"Flash fired, red-eye reduction mode, return light not detected",71:"Flash fired, red-eye reduction mode, return light detected",73:"Flash fired, compulsory flash mode, red-eye reduction mode",77:"Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",79:"Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",89:"Flash fired, auto mode, red-eye reduction mode",93:"Flash fired, auto mode, return light not detected, red-eye reduction mode",95:"Flash fired, auto mode, return light detected, red-eye reduction mode"},SensingMethod:{1:"Not defined",2:"One-chip color area sensor",3:"Two-chip color area sensor",4:"Three-chip color area sensor",5:"Color sequential area sensor",7:"Trilinear sensor",8:"Color sequential linear sensor"},SceneCaptureType:{0:"Standard",1:"Landscape",2:"Portrait",3:"Night scene"},SceneType:{1:"Directly photographed"},CustomRendered:{0:"Normal process",1:"Custom process"},WhiteBalance:{0:"Auto white balance",1:"Manual white balance"},GainControl:{0:"None",1:"Low gain up",2:"High gain up",3:"Low gain down",4:"High gain down"},Contrast:{0:"Normal",1:"Soft",2:"Hard"},Saturation:{0:"Normal",1:"Low saturation",2:"High saturation"},Sharpness:{0:"Normal",1:"Soft",2:"Hard"},SubjectDistanceRange:{0:"Unknown",1:"Macro",2:"Close view",3:"Distant view"},FileSource:{3:"DSC"},Components:{0:"",1:"Y",2:"Cb",3:"Cr",4:"R",5:"G",6:"B"}};function f(e){return!!e.exifdata}function g(e,t){function n(n){var r=p(n);e.exifdata=r||{};var a=function(e){var t=new DataView(e);i&&console.log("Got file of length "+e.byteLength);if(255!=t.getUint8(0)||216!=t.getUint8(1))return i&&console.log("Not a valid JPEG"),!1;var n=2,r=e.byteLength,a=function(e,t){return 56===e.getUint8(t)&&66===e.getUint8(t+1)&&73===e.getUint8(t+2)&&77===e.getUint8(t+3)&&4===e.getUint8(t+4)&&4===e.getUint8(t+5)};for(;n<r;){if(a(t,n)){var o=t.getUint8(n+7);o%2!=0&&(o+=1),0===o&&(o=4);var s=n+8+o,l=t.getUint16(n+6+o);return h(e,s,l)}n++}}(n);if(e.iptcdata=a||{},o.isXmpEnabled){var s=function(e){if(!("DOMParser"in self))return;var t=new DataView(e);i&&console.log("Got file of length "+e.byteLength);if(255!=t.getUint8(0)||216!=t.getUint8(1))return i&&console.log("Not a valid JPEG"),!1;var n=2,r=e.byteLength,a=new DOMParser;for(;n<r-4;){if("http"==S(t,n,4)){var o=n-1,s=t.getUint16(n-2)-1,l=S(t,o,s),c=l.indexOf("xmpmeta>")+8,d=(l=l.substring(l.indexOf("<x:xmpmeta"),c)).indexOf("x:xmpmeta")+10;l=l.slice(0,d)+'xmlns:Iptc4xmpCore="http://iptc.org/std/Iptc4xmpCore/1.0/xmlns/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:tiff="http://ns.adobe.com/tiff/1.0/" xmlns:plus="http://schemas.android.com/apk/lib/com.google.android.gms.plus" xmlns:ext="http://www.gettyimages.com/xsltExtension/1.0" xmlns:exif="http://ns.adobe.com/exif/1.0/" xmlns:stEvt="http://ns.adobe.com/xap/1.0/sType/ResourceEvent#" xmlns:stRef="http://ns.adobe.com/xap/1.0/sType/ResourceRef#" xmlns:crs="http://ns.adobe.com/camera-raw-settings/1.0/" xmlns:xapGImg="http://ns.adobe.com/xap/1.0/g/img/" xmlns:Iptc4xmpExt="http://iptc.org/std/Iptc4xmpExt/2008-02-29/" '+l.slice(d);var u=a.parseFromString(l,"text/xml");return P(u)}n++}}(n);e.xmpdata=s||{}}t&&t.call(e)}if(e.src)if(/^data\:/i.test(e.src))n(function(e,t){t=t||e.match(/^data\:([^\;]+)\;base64,/im)[1]||"",e=e.replace(/^data\:([^\;]+)\;base64,/gim,"");for(var n=atob(e),r=n.length,a=new ArrayBuffer(r),i=new Uint8Array(a),o=0;o<r;o++)i[o]=n.charCodeAt(o);return a}(e.src));else if(/^blob\:/i.test(e.src)){(a=new FileReader).onload=function(e){n(e.target.result)},function(e,t){var n=new XMLHttpRequest;n.open("GET",e,!0),n.responseType="blob",n.onload=function(e){200!=this.status&&0!==this.status||t(this.response)},n.send()}(e.src,function(e){a.readAsArrayBuffer(e)})}else{var r=new XMLHttpRequest;r.onload=function(){if(200!=this.status&&0!==this.status)throw"Could not load image";n(r.response),r=null},r.open("GET",e.src,!0),r.responseType="arraybuffer",r.send(null)}else if(self.FileReader&&(e instanceof self.Blob||e instanceof self.File)){var a;(a=new FileReader).onload=function(e){i&&console.log("Got file of length "+e.target.result.byteLength),n(e.target.result)},a.readAsArrayBuffer(e)}}function p(e){var t=new DataView(e);if(i&&console.log("Got file of length "+e.byteLength),255!=t.getUint8(0)||216!=t.getUint8(1))return i&&console.log("Not a valid JPEG"),!1;for(var n,r=2,a=e.byteLength;r<a;){if(255!=t.getUint8(r))return i&&console.log("Not a valid marker at offset "+r+", found: "+t.getUint8(r)),!1;if(n=t.getUint8(r+1),i&&console.log(n),225==n)return i&&console.log("Found 0xFFE1 marker"),b(t,r+4,t.getUint16(r+2));r+=2+t.getUint16(r+2)}}var m={120:"caption",110:"credit",25:"keywords",55:"dateCreated",80:"byline",85:"bylineTitle",122:"captionWriter",105:"headline",116:"copyright",15:"category"};function h(e,t,n){for(var r,a,i,o,s=new DataView(e),l={},c=t;c<t+n;)28===s.getUint8(c)&&2===s.getUint8(c+1)&&(o=s.getUint8(c+2))in m&&((i=s.getInt16(c+3))+5,a=m[o],r=S(s,c+5,i),l.hasOwnProperty(a)?l[a]instanceof Array?l[a].push(r):l[a]=[l[a],r]:l[a]=r),c++;return l}function y(e,t,n,r,a){var o,s,l,c=e.getUint16(n,!a),d={};for(l=0;l<c;l++)o=n+12*l+2,!(s=r[e.getUint16(o,!a)])&&i&&console.log("Unknown tag: "+e.getUint16(o,!a)),d[s]=v(e,o,t,n,a);return d}function v(e,t,n,r,a){var i,o,s,l,c,d,u=e.getUint16(t+2,!a),f=e.getUint32(t+4,!a),g=e.getUint32(t+8,!a)+n;switch(u){case 1:case 7:if(1==f)return e.getUint8(t+8,!a);for(i=f>4?g:t+8,o=[],l=0;l<f;l++)o[l]=e.getUint8(i+l);return o;case 2:return S(e,i=f>4?g:t+8,f-1);case 3:if(1==f)return e.getUint16(t+8,!a);for(i=f>2?g:t+8,o=[],l=0;l<f;l++)o[l]=e.getUint16(i+2*l,!a);return o;case 4:if(1==f)return e.getUint32(t+8,!a);for(o=[],l=0;l<f;l++)o[l]=e.getUint32(g+4*l,!a);return o;case 5:if(1==f)return c=e.getUint32(g,!a),d=e.getUint32(g+4,!a),(s=new Number(c/d)).numerator=c,s.denominator=d,s;for(o=[],l=0;l<f;l++)c=e.getUint32(g+8*l,!a),d=e.getUint32(g+4+8*l,!a),o[l]=new Number(c/d),o[l].numerator=c,o[l].denominator=d;return o;case 9:if(1==f)return e.getInt32(t+8,!a);for(o=[],l=0;l<f;l++)o[l]=e.getInt32(g+4*l,!a);return o;case 10:if(1==f)return e.getInt32(g,!a)/e.getInt32(g+4,!a);for(o=[],l=0;l<f;l++)o[l]=e.getInt32(g+8*l,!a)/e.getInt32(g+4+8*l,!a);return o}}function S(e,t,n){for(var r="",a=t;a<t+n;a++)r+=String.fromCharCode(e.getUint8(a));return r}function b(e,t){if("Exif"!=S(e,t,4))return i&&console.log("Not valid EXIF data! "+S(e,t,4)),!1;var n,r,a,o,f,g=t+6;if(18761==e.getUint16(g))n=!1;else{if(19789!=e.getUint16(g))return i&&console.log("Not valid TIFF data! (no 0x4949 or 0x4D4D)"),!1;n=!0}if(42!=e.getUint16(g+2,!n))return i&&console.log("Not valid TIFF data! (no 0x002A)"),!1;var p=e.getUint32(g+4,!n);if(p<8)return i&&console.log("Not valid TIFF data! (First offset less than 8)",e.getUint32(g+4,!n)),!1;if((r=y(e,g,g+p,l,n)).ExifIFDPointer)for(a in o=y(e,g,g+r.ExifIFDPointer,s,n)){switch(a){case"LightSource":case"Flash":case"MeteringMode":case"ExposureProgram":case"SensingMethod":case"SceneCaptureType":case"SceneType":case"CustomRendered":case"WhiteBalance":case"GainControl":case"Contrast":case"Saturation":case"Sharpness":case"SubjectDistanceRange":case"FileSource":o[a]=u[a][o[a]];break;case"ExifVersion":case"FlashpixVersion":o[a]=String.fromCharCode(o[a][0],o[a][1],o[a][2],o[a][3]);break;case"ComponentsConfiguration":o[a]=u.Components[o[a][0]]+u.Components[o[a][1]]+u.Components[o[a][2]]+u.Components[o[a][3]]}r[a]=o[a]}if(r.GPSInfoIFDPointer)for(a in f=y(e,g,g+r.GPSInfoIFDPointer,c,n)){switch(a){case"GPSVersionID":f[a]=f[a][0]+"."+f[a][1]+"."+f[a][2]+"."+f[a][3]}r[a]=f[a]}return r.thumbnail=function(e,t,n,r){var a=function(e,t,n){var r=e.getUint16(t,!n);return e.getUint32(t+2+12*r,!n)}(e,t+n,r);if(!a)return{};if(a>e.byteLength)return{};var i=y(e,t,t+a,d,r);if(i.Compression)switch(i.Compression){case 6:if(i.JpegIFOffset&&i.JpegIFByteCount){var o=t+i.JpegIFOffset,s=i.JpegIFByteCount;i.blob=new Blob([new Uint8Array(e.buffer,o,s)],{type:"image/jpeg"})}break;case 1:console.log("Thumbnail image format is TIFF, which is not implemented.");break;default:console.log("Unknown thumbnail image format '%s'",i.Compression)}else 2==i.PhotometricInterpretation&&console.log("Thumbnail image format is RGB, which is not implemented.");return i}(e,g,p,n),r}function x(e){var t={};if(1==e.nodeType){if(e.attributes.length>0){t["@attributes"]={};for(var n=0;n<e.attributes.length;n++){var r=e.attributes.item(n);t["@attributes"][r.nodeName]=r.nodeValue}}}else if(3==e.nodeType)return e.nodeValue;if(e.hasChildNodes())for(var a=0;a<e.childNodes.length;a++){var i=e.childNodes.item(a),o=i.nodeName;if(null==t[o])t[o]=x(i);else{if(null==t[o].push){var s=t[o];t[o]=[],t[o].push(s)}t[o].push(x(i))}}return t}function P(e){try{var t={};if(e.children.length>0)for(var n=0;n<e.children.length;n++){var r=e.children.item(n),a=r.attributes;for(var i in a){var o=a[i],s=o.nodeName,l=o.nodeValue;void 0!==s&&(t[s]=l)}var c=r.nodeName;if(void 0===t[c])t[c]=x(r);else{if(void 0===t[c].push){var d=t[c];t[c]=[],t[c].push(d)}t[c].push(x(r))}}else t=e.textContent;return t}catch(e){console.log(e.message)}}o.enableXmp=function(){o.isXmpEnabled=!0},o.disableXmp=function(){o.isXmpEnabled=!1},o.getData=function(e,t){return!((self.Image&&e instanceof self.Image||self.HTMLImageElement&&e instanceof self.HTMLImageElement)&&!e.complete)&&(f(e)?t&&t.call(e):g(e,t),!0)},o.getTag=function(e,t){if(f(e))return e.exifdata[t]},o.getIptcTag=function(e,t){if(f(e))return e.iptcdata[t]},o.getAllTags=function(e){if(!f(e))return{};var t,n=e.exifdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},o.getAllIptcTags=function(e){if(!f(e))return{};var t,n=e.iptcdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},o.pretty=function(e){if(!f(e))return"";var t,n=e.exifdata,r="";for(t in n)n.hasOwnProperty(t)&&("object"==a(n[t])?n[t]instanceof Number?r+=t+" : "+n[t]+" ["+n[t].numerator+"/"+n[t].denominator+"]\r\n":r+=t+" : ["+n[t].length+" values]\r\n":r+=t+" : "+n[t]+"\r\n");return r},o.readFromBinaryFile=function(e){return p(e)},void 0===(r=function(){return o}.apply(t,[]))||(e.exports=r)}).call(this)},353:function(e,t,n){e.exports=n(354)},354:function(e,t,n){"use strict";n.r(t);var r=n(29),a=n.n(r),i=document.querySelectorAll(".date_input"),o=document.querySelector(".js-check-offer"),s=document.querySelector(".js-selfie-input"),l=document.querySelector(".js-departments-select"),c=document.querySelector(".js-items-input"),d=document.querySelectorAll(".js-item-file"),u=document.querySelector(".js-add-items"),f=document.querySelectorAll(".js-text-limit"),g=document.querySelector(".js-categories-select"),p=document.querySelector(".js-brands-select"),m=document.querySelector(".js-other-brand"),h=document.querySelector(".js-clothing-type-select"),y=document.querySelector(".js-sizes-select"),v=(document.querySelector(".js-item-file-opt1"),document.querySelector(".js-item-file-opt2"),document.querySelector(".js-accept-price")),S=document.querySelector(".js-discount"),b=document.querySelector(".js-payment-btn");$(".carousel").carousel("pause"),S&&S.addEventListener("keyup",function(e){document.querySelector(".js-invalid-feedback"),document.querySelector(".js-invalid-discount"),e.currentTarget,Number(v.value.replace(/[^0-9.-]+/g,""))}),v&&v.addEventListener("keyup",function(e){var t=document.querySelector(".js-invalid-feedback");document.querySelector(".js-invalid-discount"),document.querySelector(".js-discount");Number(v.value.replace(/[^0-9.-]+/g,""))<180?(t.classList.add("d-block"),t.innerHTML="El precio mínimo de la prenda debe ser $180"):(t.classList.remove("d-block"),t.innerHTML="El campo precio original es obligatorio.")});for(var x=document.querySelectorAll(".container-fade p"),P=0;P<x.length;P++)x[P].innerText.length>=22?x[P].parentNode.classList.add("txt-fade"):x[P].parentNode.classList.remove("txt-fade");function T(e){var t="";e.width,e.height;switch(a.a.getData(e,function(){t=a.a.getTag(this,"Orientation"),console.log("Exif orientation: "+t)}),t){case 2:e.classList.add("flip");break;case 3:e.classList.add("rotate-180");break;case 4:e.classList.add("flip-and-rotate-180");break;case 5:e.classList.add("flip-and-rotate-270");break;case 6:e.classList.add("rotate-90");break;case 7:e.classList.add("flip-and-rotate-90");break;case 8:e.classList.add("rotate-270")}}if(i[0]&&"date"!=i[0].type&&$(".date_input").datepicker({format:"dd/mm/yyyy",language:"es",orientation:"bottom auto",autoclose:!0}),window.addEventListener("load",function(){var e=document.getElementsByClassName("needs-validation");Array.prototype.filter.call(e,function(e){e.addEventListener("submit",function(t){if(!1===e.checkValidity())t.preventDefault(),t.stopPropagation();else{var n=e.querySelector(".btn-fr"),r=n.querySelector("span");n.setAttribute("disabled","true"),r.classList.remove("hidden"),r.classList.add("spinner-border-block")}e.classList.add("was-validated")},!1)})},!1),o){var L=document.querySelector(".js-check-container"),C=L.querySelectorAll("input");o.addEventListener("change",function(e){if(e.currentTarget.checked){L.classList.remove("hidden");for(var t=C.length-1;t>=0;t--)C[t].setAttribute("required",!0)}else{L.classList.add("hidden");for(t=C.length-1;t>=0;t--)C[t].setAttribute("required",!1)}})}if(s){var w=document.querySelector(".js-selfie-btn");s.addEventListener("change",function(e){w.classList.remove("hidden");var t=document.querySelector(".js-selfie-img"),n=e.currentTarget.files,r=t.parentNode,i=new FileReader;i.onload=function(e){r.innerHTML="";var t=new Image;t.src=i.result,r.appendChild(t),t.style.width="100%",t.classList.add("card-img-top"),t.classList.add("js-selfie-img"),a.a.getData(n[0],function(){T(t)}),r.insertAdjacentHTML("beforeend",'<i class="far fa-edit" id="edit_icon"></i>')},i.readAsDataURL(n[0])})}function F(e){var t=e.currentTarget?e.currentTarget:e,n=t.options[t.selectedIndex].value,r=g.getAttribute("data-category"),a=JSON.parse(g.getAttribute("data-categories")),i=m.querySelector(".form-control"),o='<option value="">- Seleccionar -</option>';m.classList.add("hidden"),i.removeAttribute("required"),void 0===a[n]?o='<option value="">- Sin categorías -</option>':a[n].forEach(function(e){o+='<option value="'+e.CategoryID+'" '+(r&&r==e.CategoryID?"selected":"")+">"+e.CategoryName+"</option>"}),g.innerHTML=o,l.addEventListener("change",F),g.addEventListener("change",I)}function I(e){var t=e.currentTarget?e.currentTarget:e,n=t.options[t.selectedIndex].value,r=(t.options[t.selectedIndex].innerText,JSON.parse(h.getAttribute("data-clothing-types"))),a=JSON.parse(y.getAttribute("data-sizes")),i=h.getAttribute("data-clothing-type"),o=y.getAttribute("data-size"),s='<option value="">- Seleccionar -</option>',l='<option value="">- Seleccionar -</option>';void 0===r[n]?l='<option value="">- Sin tipos de prendas -</option>':r[n].forEach(function(e){l+='<option value="'+e.ClothingTypeID+'" '+(i&&i==e.ClothingTypeID?"selected":"")+">"+e.ClothingTypeName+"</option>"}),h.innerHTML=l,void 0===a[n]?s='<option value="">- Sin tallas -</option>':a[n].forEach(function(e){s+='<option value="'+e.SizeID+'" '+(o&&o==e.SizeID?"selected":"")+">"+e.SizeName+"</option>"}),y.innerHTML=s,g.addEventListener("change",I)}if(l&&(0!==l.selectedIndex&&F(l),l.addEventListener("change",F)),g&&(0!==g.selectedIndex&&I(g),g.addEventListener("change",I)),p&&p.addEventListener("change",function(e){var t=e.currentTarget,n=t.options[t.selectedIndex].value,r=m.querySelector(".form-control");"other"==n?(m.classList.remove("hidden"),r.setAttribute("required",!0)):(m.classList.add("hidden"),r.removeAttribute("required"))}),u){var E=document.querySelector(".js-items-container"),D=document.querySelector(".js-input-real-pictures"),A=document.querySelector(".js-add-items-btn"),j=[];u.addEventListener("change",function(e){A&&A.classList.remove("hidden");var t=document.querySelectorAll(".js-new-item");if(t.length>0)for(var n=t.length-1;n>=0;n--)E.removeChild(t[n]);var r=e.currentTarget.files,i=function(){var e='<div class="mb-3 thumb-size mr-3 js-new-item" data-name="'+(o=r[n]).name+'">\n                                <div class="card">\n                                </div>\n                            </div>';E.querySelector(".thumb-size").insertAdjacentHTML("afterend",e);var t=document.querySelector(".js-new-item .card");(s=new FileReader).onloadend=function(e){var n=new Image;n.style.width="200px",n.style.height="200px",a.a.getData(o,function(){T(n)}),n.setAttribute("src",e.currentTarget.result),n.classList.add("card-img-top"),t.appendChild(n);t.insertAdjacentHTML("afterbegin",'<a class="close delete-item js-delete-img" aria-label="Close" >\n                <i class="far fa-trash-alt"></i>\n                </a>'),document.querySelector(".js-delete-img").addEventListener("click",function(e){j=[],E.removeChild(e.currentTarget.parentNode.parentNode),0===document.querySelectorAll(".js-delete-img").length&&A.classList.add("hidden");for(var t=document.querySelectorAll(".js-new-item"),n=t.length-1;n>=0;n--)j.push(t[n].getAttribute("data-name"));D.value=j})},s.readAsDataURL(o)};for(n=0;n<r.length;n++){var o,s;i()}var l=document.querySelectorAll(".js-new-item");for(n=l.length-1;n>=0;n--)j.push(l[n].getAttribute("data-name"));D.value=j})}function U(e){var t=e.currentTarget?e.currentTarget:e,n=t.files,r=t.parentNode.querySelector(".container-item-img"),i=t.getAttribute("data-type"),o=t.getAttribute("data-name"),s=t.getAttribute("data-item");t.nextElementSibling.parentNode,t.nextElementSibling,t.nextElementSibling.previousElementSibling;r.previousElementSibling.style.display="none",r.innerHTML="";var l=new FileReader;l.onloadend=function(e){var t=new Image;t.style.width="200px",a.a.getData(n[0],function(){T(t)}),t.setAttribute("src",e.currentTarget.result),r.classList.add("card"),r.appendChild(t);var l='<a class="close delete-item js-delete-item" aria-label="Close"  data-type="'+i+'" data-name="'+o+'" data-item="'+s+'">\n        <i class="far fa-trash-alt"></i>\n        </a>',c='<div class="form-check cover-item">\n                    <input class="form-check-input" type="radio" name="cover" id="cover_'+o+'" data-item="'+s+'" value="'+o+'" '+("front"===o?"checked":"")+'>\n                    <label class="form-check-label" for="cover_'+o+'">\n                        Portada\n                    </label>\n                    </div>';r.insertAdjacentHTML("afterbegin",l),console.log("item"),console.log(s),"true"==s&&r.insertAdjacentHTML("beforeend",c);var d=document.querySelectorAll(".js-delete-item");Array.prototype.forEach.call(d,function(e){e.addEventListener("click",q)})},l.readAsDataURL(n[0]),console.log(t.files)}function q(e){var t=e.currentTarget.getAttribute("data-type"),n=e.currentTarget.getAttribute("data-name"),r=e.currentTarget.getAttribute("data-item"),a=e.currentTarget.parentNode.parentNode,i=e.currentTarget.parentNode.previousElementSibling,o=e.currentTarget.parentNode.previousElementSibling.previousElementSibling;e.currentTarget.parentNode.innerHTML="",a.removeChild(i),a.removeChild(o);var s='<input type="file" name="'+n+'_item_file" id="'+n+'_item_file" data-item="'+r+'" class="no-file js-item-file custom-file-input" data-type="'+t+'" data-name="'+n+'" '+("in"!==n||"selfie"!==n?'required="true"':"")+'><label for="'+n+'_item_file" class="card card--file-item custom-file-label m-auto">\n          <span><i class="far fa-image"></i> <br>'+t+"</span>\n        </label>";a.insertAdjacentHTML("afterbegin",s);var l=document.querySelectorAll(".js-item-file");Array.prototype.forEach.call(l,function(e){e.addEventListener("change",U)})}if(d&&Array.prototype.forEach.call(d,function(e){e.files.length>0&&U(e),e.addEventListener("change",U)}),c){var k=document.querySelector("#itemsList"),N=document.querySelector(".js-input-real-pictures");j=[];c.addEventListener("change",function(e){for(var t=e.currentTarget.files,n=t.length-1;n>=0;n--){var r='<span class="badge badge-pill green-color w-100 text-left">'+t[n].name+'\n                <i class="fas fa-times green-color float-right cursor-pointer js-delete-item" data-key="'+n+'" data-name="'+t[n].name+'"></i>\n                </span>';k.insertAdjacentHTML("beforeend",r),j.push(t[n].name)}N.value=j;var a=document.querySelectorAll(".js-delete-item");Array.prototype.forEach.call(a,function(e){e.addEventListener("click",function(e){j=[],k.removeChild(e.currentTarget.parentNode);for(var t=document.querySelectorAll("#itemsList span"),n=t.length-1;n>=0;n--)j.push(t[n].innerText);N.value=j})})})}function R(e){return e.replace(/\D/g,"").replace(/\B(?=(\d{3})+(?!\d))/g,",")}function G(e,t,n){return fetch("https://pp-users-integrations-api-prod.herokuapp.com/keys/"+e.key._id+"/verify",{method:"GET",redirect:"follow"}).then(function(e){return e.text()}).then(function(e){var r=JSON.parse(e);if(r.success){var a=function(e,t,n){var r=e.data.key,a=JSON.stringify(n)+t+r;return sha256(a)}(r,t,n);localStorage.setItem("token",a)}}).catch(function(e){return console.log("error",e)}),localStorage.getItem("token")}f&&Array.prototype.forEach.call(f,function(e){e.addEventListener("keydown",function(t){var n=e.getAttribute("data-limit"),r=t.currentTarget.value.length;t.currentTarget.nextElementSibling.innerHTML=n-r+" caracteres."})}),$(".js-currency-input").on({keyup:function(){!function(e,t){var n=e.val();if(""===n)return;var r=n.length,a=e.prop("selectionStart");if(n.indexOf(".")>=0){var i=n.indexOf("."),o=n.substring(0,i),s=n.substring(i);o=R(o),s=R(s),"blur"===t&&(s+="00"),s=s.substring(0,2),n="$"+o+"."+s}else n="$"+(n=R(n)),"blur"===t&&(n+=".00");e.val(n);var l=n.length;a=l-r+a,e[0].setSelectionRange(a,a)}($(this))}}),b&&b.addEventListener("click",function(e){(new Date).getTime();console.log();for(var t=function(e){null,(r=new Headers).append("Content-Type","application/json"),a=JSON.stringify({email:"heavyjra@gmail.com",password:"F12345678R"}),fetch("https://pp-users-integrations-api-prod.herokuapp.com/signin/email",{method:"POST",headers:r,body:a,redirect:"follow"}).then(function(e){return e.text()}).then(function(e){!function(e,t){var n=e.user._id,r="/shipments/native",a={address_delivery:{send_email:!1,address1:"Cholula",address2:"La Paz",zip_code:"72160",state:"Puebla",city:"Heroica Puebla de Zaragoza",ext:"35",int:null,customer:{first_name:"Cliente",last_name:"Cliente",phone:2222222222,email:"ejemplo@ejemplo.com"}},address_pickup:{collect:!0,address1:"Calle 16 Sur",address2:"Residencial Puebla",zip_code:"72530",state:"Puebla",city:"Heroica Puebla de Zaragoza",ext:"3307",int:null,municipality:"",customer:{first_name:"Usuario",last_name:"Usuario",phone:2222222222,email:"ejemplo@ejemplo.com"}},insurance:{amount:0,declared:!1},shipping_information:{coverage_entry:"5b2ae7556e2cabc183dcc9ea",end_time:"1020",quote_from:"packandpack",service_type:"5b2acaf5b5de20bb7f53a654",start_time:"720"},size:{weight:12,width:10,height:10,deep:10}},i=G(e,r,a);console.log("ENVIAR"),console.log("USER_ID: "+n),console.log("token: "+i);var o=new Headers;o.append("Content-Type","application/json"),o.append("user_id",n),o.append("token",i);var s=JSON.stringify(a);fetch("https://pp-users-integrations-api-prod.herokuapp.com"+r,{method:"POST",headers:o,body:s,redirect:"follow"}).then(function(e){return e.text()}).then(function(e){return console.log(e)}).catch(function(e){return console.log("error",e)})}(JSON.parse(e))}).catch(function(e){return console.log("error",e)})},n=0;n<25;n++){var r,a;t()}})}});