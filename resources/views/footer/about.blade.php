@extends('layout.master')

@section('content')

  <main id="main">
    <div class="container py-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-left TituloFR my-4">Nosotros</h1>
        </div>
        <div class="col-12 text-justify mx-2">
          <p>En FASHION RECOVERY creemos que la moda con un enfoque sustentable es 
            más que una tendencia, es un estilo de vida. Por ello, promovemos la 
            reutilización de prendas que merecen una segunda oportunidad, con lo 
            cual buscamos contribuir en la mitigación de los impactos negativos que 
            la industria genera en el medio ambiente.</p>

            <img class="img-fluid" src="{{ url('/img/proceso.png') }}">

            <div class="w-full text-center mb-5 mt-5">
              <a href="{{ url('/') }}" class="btn btn-fr">Ir de compras</a>
            </div>

            <h4 class="mb-4">¿Cuáles son nuestros compromisos?</h4>

            <p class="mb-5">Somos una tienda en línea de ropa y accesorios que conecta vendedores y 
              compradores, manteniendo un enfoque sustentable y alternativo en las 
              decisiones de compra, es por eso que trabajamos bajo tres vertientes 
              principales que dan vida a nuestro proyecto:</p>

              <table class="table table-borderless m-auto table-about">
                <tbody>
                  <tr>
                    <td class="green-text text-right"><b>MEDIO AMBIENTE</b></td>
                    <td><p>Alargar la vida de una prenda es una forma de reciclaje que tiene un impacto directo en la reducción de gases de efecto invernadero.</p></td>
                  </tr>
                  <tr>
                    <td class="green-text text-right"> <b>CONSUMO RESPONSABLE</b> </td>
                    <td><p>Informar sobre los beneficios del reciclaje, la reutilización y la reducción en el consumo masivo de prendas tiene un fin: <span class="green-text">reinventarnos</span>.</p></td>
                  </tr>
                  <tr>
                    <td class="green-text text-right"> <b>COMUNIDAD</b> </td>
                    <td><p>Crear espacios para nuestros clientes de manera que no sean solo usuarios, sino parte de una comunidad que asume un <span class="green-text">compromiso</span> con el medio ambiente.</p></td>
                  </tr>
                </tbody>
              </table>

            <div class="w-full text-center mt-3 mb-3">
              <a href="{{ url('/') }}" class="btn btn-fr">Ir de compras</a>
            </div>

            <h4 class="mb-4">¿Quieres vender?</h4>

            <p>Vender tus prendas con nosotros es muy sencillo, solo tienes que crear un perfil y 
              seguir los siguientes consejos:</p>

            <ul>
              <li>Busca en tu clóset aquellas prendas que usaste muy poco y están en buen estado, o bien, esa pieza que compraste un día y jamás utilizaste. </li>
              <li>Haz varias fotos que muestren lo mejor de tu prenda, no olvides una imagen en la que se pueda ver la marca y la talla. Recuerda que de la vista nace el amor. </li>
              <li>Sube tus fotos a nuestra página y comienza a vender…  <span class="green-text">¡Ahora estás contribuyendo a mejorar el medio ambiente a la vez que ganas dinero extra!</span> </li>
            </ul>

            <div class="w-full text-center mt-5">
              <a href="{{ url('/register/1') }}" class="btn btn-fr">Crear perfil</a>
            </div>
        </div>
  </main>

@endsection