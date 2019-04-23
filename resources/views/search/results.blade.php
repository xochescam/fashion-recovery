<section id="resultadosBusqueda" class="mt-5">
      <div class="container-fluid">
        <div class="row">
            <div class="col text-center text-uppercase mb-4">
                <small>Resultados de tu</small>
                <h2>Búsqueda</h2>
            </div>
        </div>
        <div class="row justify-content-around shadow-lg p-3 mb-5 bg-white rounded mx-md-5">
            @foreach($products as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                <div class="card card--public card--item shadow p-3 mb-5 bg-white rounded">
                <img class="card-img-top" src="{{ url('storage',$item->first()->ThumbPath) }}" alt="Card image cap" height="200px;">
                <div class="card-body">
                    <div class="badges float-right">
                    <h5><span class="badge badge-pill badge-success">{{ $item->first()->ActualPrice }} </span></h5>
                    </div>
                    <h4 class="card-title">{{ $item->first()->BrandName }}</h4>
                    <h6>Falda</h6>
                    <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                    Talla: 5 <br />Color: {{ $item->first()->ColorName }}</p>
                    <a href="#" class="btn btn-fr">Comprar</a>
                </div>
                </div>
            </div>

          @endforeach

        </div>
    </div>
</section>
