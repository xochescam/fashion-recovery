@extends('layout.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
            <div class="col-md-12 info-steps p-0">
              <div class="info-steps__header">
                <img src="{{ url('img/header/transparent_logo.png') }}" class="info-steps__header-logo" alt="">

                <p class="info-steps__header-title">¿CÓMO FUNCIONA?</p>
                <p class="info-steps__header-subtitle">5 PASOS PARA VENDER TU CLÓSET</p>
              </div>

              <div class="info-steps__content">
                <div class="info-steps__item ">
                  <div class="info-steps__item-img order-1 order-md-0 mt-4 mt-md-0">
                    <img src="{{ url('img/info/3.png') }}"  alt="">
                  </div>
                  
                  <span class="info-steps__step order-0 order-md-1 ">1</span>
                  <p class="info-steps__text order-2 order-md-2 mb-5 mb-md-0">CREA TU PERFIL EN FASHION RECOVERY</p>
                </div>

                <div class="info-steps__item">
                <div class="info-steps__item-img order-1 order-md-0 mt-4 mt-md-0">
                    <img src="{{ url('img/info/4.png') }}"  alt="">
                  </div>
                  <span class="info-steps__step order-0 order-md-1">2</span>
                  <p class="info-steps__text order-2 order-md-2 mb-5 mb-md-0">BUSCA EN TU CLÓSET PRENDAS QUE MERECEN UNA SEGUNDA OPORTUNIDAD</p>
                </div>

                <div class="info-steps__item">
                <div class="info-steps__item-img order-1 order-md-0 mt-4 mt-md-0">
                    <img src="{{ url('img/info/5.png') }}"  alt="">
                  </div>
                  <span class="info-steps__step order-0 order-md-1">3</span>
                  <p class="info-steps__text order-2 order-md-2 mb-5 mb-md-0">TOMA FOTOS QUE MUESTREN LO MEJOR DE ESA PRENDA</p>
                </div>

                <div class="info-steps__item">
                <div class="info-steps__item-img order-1 order-md-0 mt-4 mt-md-0">
                    <img src="{{ url('img/info/6.png') }}"  alt="">
                  </div>
                  <span class="info-steps__step order-0 order-md-1">4</span>
                  <p class="info-steps__text order-2 order-md-2 mb-5 mb-md-0">PONLE UN PRECIO JUSTO A TU PRENDA, ESO AUMENTA LA RAPIDEZ DE TUS VENTAS</p>
                </div>

                <div class="info-steps__item">
                <div class="info-steps__item-img order-1 order-md-0 mt-4 mt-md-0">
                    <img src="{{ url('img/info/7.png') }}"  alt="">
                  </div>
                  <span class="info-steps__step order-0 order-md-1">5</span>
                  <p class="info-steps__text order-2 order-md-2 mb-5 mb-md-0">VENDE, GANA DINERO Y LLEVA UNA VIDA MÁS SUSTENTABLE</p>
                </div>
              </div>
              <div class="info-steps__footer">
                <p class="mb-0"><a href="{{ url('/') }}" class="color-white">¡Compra ahora!</a></p>
              </div>
            </div>

            <div class="col-md-12 info-how__container p-0">
              <img src="{{ url('img/info/como.png') }}" class="info-how" alt="">
            </div>
            
            <div class="col-md-12 m-auto info-works">
              <div class="info-works__header">
                <h3 class="text-center title-info">
                  ¿QUIERES SABER MÁS ACERCA DE LA <br>
                  <span class="title-info__strong"> INDUSTRIA DE LA MODA?</span> 
                </h3>
              </div>
              <div class="info-works__container">
                <div class="row info-works__item">
                  <div class="col-md-3 text-center info-works__img-container">
                    <img src="{{ url('img/info/8.png') }}" class="info-works__1" alt="">
                  </div>
                  <div class="col-md-9 text-center p-md-0 d-flex justify-content-center align-items-center">
                    <p class="m-0">
                      Es el <strong>segundo consumidor de agua</strong> a nivel mundial. <br>
                      Genera alrededor de <b>20%</b> de las aguas residuales. <br>
                      Libera <b>medio millón de toneladas</b> de microfibras sintéticas al océano cada año.
                    </p>
                  </div>
                </div>

                <div class="row info-works__item">
                  <div class="col-md-9 text-center p-md-0 d-flex justify-content-center align-items-center order-2 order-md-1">
                    <p class="m-0 ">
                      El consumidor promedio compra 60% más prendas de ropa que hace 15 años y cada artículo se
                      conserva la mitad del tiempo.
                    </p>
                  </div>
                  <div class="col-md-3 text-center info-works__img-container order-1 order-md-2">
                    <img src="{{ url('img/info/9.png') }}" class="info-works__2" alt="">
                  </div>
                </div>

                <div class="row info-works__item">
                  <div class="col-md-3 text-center info-works__img-container">
                    <img src="{{ url('img/info/10.png') }}" class="info-works__1" alt="">
                  </div>
                  <div class="col-md-9 text-center p-md-0 d-flex justify-content-center align-items-center">
                    <p class="m-0">
                      Cada año la industria pierde cerca de US$ 500 mil millones en valor de la ropa de temporada que
                      no se vende y que es arrojada a vertederos en lugar de ser reciclada.
                    </p>
                  </div>
                </div>

                <div class="row info-works__item b-0">
                  <div class="col-md-9 text-center p-md-0 d-flex justify-content-center align-items-center order-2 order-md-1">
                    <p class="m-0">
                    La industria produce de 8% a 10% de las emisiones globales de carbono, más que todo el
  transporte marítimo y los vuelos internacionales combinados.
                    </p>
                  </div>
                  <div class="col-md-3 text-center info-works__img-container order-1 order-md-2">
                    <img src="{{ url('img/info/11.png') }}" class="info-works__2" alt="">
                  </div>
                </div>              
              </div>
            </div>
            <div class="info-what col-md-12 m-auto">
              ¿QUÉ PODEMOS HACER?
            </div>

            <div class="col-md-12 m-auto info-card__container">

              <div class="row">
                <div class="col-md-4 info-card">
                  <span class="info-card__title">
                    REDUCE
                  </span>
                  <p class="info-card__text">El consumo de prendas que no necesitas realmente.</p>
                </div>
                <div class="col-md-4 info-card">
                  <span class="info-card__title">
                    REPARA
                  </span>
                  <p class="info-card__text">La ropa y accesorios que aún tienen una vida útil.</p>
                </div>
                <div class="col-md-4 info-card">
                  <span class="info-card__title">
                    RECICLA 
                  </span>
                  <p class="info-card__text">Lo que ya no se puede utilizar, pero puede darle vida a algo nuevo.</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 info-card">
                  <span class="info-card__title">
                  REUTILIZA
                  </span>
                  <p class="info-card__text">Las prendas a las que has dado poco uso y considéralas antes de comprar.</p>
                </div>
                <div class="col-md-4 info-card order-1 order-md-0">
                  <img src="{{ url('img/info/12.png') }}" alt="" class="info-card__img ">
                </div>
                <div class="col-md-4 info-card">
                  <span class="info-card__title">
                  REINVENTA 
                  </span>
                  <p class="info-card__text">Lo que puede adaptarse a las nuevas tendencias.</p>
                </div>
              </div>

              <p class="info-card__footer mt-4 mt-md-0">
                ¡VISTE VERDE!
              </p>
            </div>
            <div class="col-md-12 m-auto info-footer">
              <img src="{{ url('img/header/transparent_logo.png') }}" class="info-footer__logo" alt="">
              <p class="info-footer__web mb-0">
                <strong>www.fashionrecovery.com.mx</strong>
              </p>
              <p class="info-footer__p">
                Fuente: United Nations Environment Programme. (2019). La Alianza de la ONU para la Moda
                Sostenible abordará el impacto de la &quot;moda rápida&quot;. Nairobi, Kenia.: Comunicado de prensa.
              </p>
            </div>





      </div>
    </main>
@endsection
