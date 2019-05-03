<section id="resultadosBusqueda" class="mt-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <p><span class="font-weight-bold">{{ $products -> count() }}</span> de resultados para <span class="font-weight-bold">"{{ app('request')->input('criteria') }}"</span></p>
            </div>
            <div class="col d-xs-none">
                <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Filtrar resultados:</a>
            </div>
        </div>
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrar resultados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-4" id="result">
                        <div class="row mb-3">
                            <div class="col-12 col-md-3">
                                <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Damas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Caballeros
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Niñas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Niños
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Bebés y maternidad
                                    </label>
                                </div>
                                <h6 class="font-weight-bold mt-3">MARCA</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Adidas
                                    </label><span class="badge badge-fr">15</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Nike
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Trafaluc
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck2">
                                        Zara
                                    </label>
                                </div>
                            <h6 class="font-weight-bold mt-3">TIPO DE PRENDA</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Casual
                                </label><span class="badge badge-fr">112</span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Formal
                                </label><span class="badge badge-fr">95</span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Deportiva
                                </label><span class="badge badge-fr">27</span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Accesorios
                                </label>
                            </div>

                            <h6 class="font-weight-bold mt-3">COLOR</h6>
                            <a href="{{ url()->current() }}"><span class="dot dot-blue"></span></a>
                            <a href="#"><span class="dot dot-red"></span></a>
                            <a href="#"><span class="dot dot-green"></span></a>
                            <a href="#"><span class="dot dot-yellow"></span></a>

                            <h6 class="font-weight-bold mt-3">PRECIO</h6>
                            <input type="text" class="js-range-slider" id="price" name="my_range" value="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-9">

                @foreach($products as $item)

                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                    <div class="card card--public card--item shadow p-3 mb-5 bg-white rounded">
                    <img class="card-img-top" src="{{ url('storage',$item->first()->ThumbPath) }}" alt="Card image cap" height="200px;">
                    <div class="card-body">
                        <div class="badges float-right">
                        <h5><span class="badge badge-pill badge-success">{{ $item->first()->ActualPrice }} </span></h5>
                        </div>
                        <h4 class="card-title">{{ $item->first()->BrandName }}</h4>
                        <h6>{{ $item -> first() -> ItemDescription }}</h6>
                        <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                        {{ $item -> first() -> SizeName }} <br />Color: {{ $item->first()->ColorName }}</p>
                        <a href="#" class="btn btn-fr">Comprar</a>
                    </div>
                    </div>
                </div>

                @endforeach

            </div>
    </div>
</section>
