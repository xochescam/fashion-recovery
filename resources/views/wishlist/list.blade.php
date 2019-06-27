@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row mb-1">
	        	<div class="col-sm-10 col-8">
                    <h2 class="left-center TituloFR">Wishlist</h2>
                </div>
                <div class="col-sm-2 col-4">
                    <button type="button" class="btn btn-fr float-right" data-toggle="modal" data-target="#exampleModalCenter">
                        Crear nueva lista
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card d-sm-block d-none">
                        <div class="card-header">
                            Todas mis wishlist
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Tecnología</a></li>
                            <li class="list-group-item"><a href="#">Ropa deportiva</a></li>
                            <li class="list-group-item"><a href="#">Chucherías para la casa</a></li>
                        </ul>
                    </div>
                    <div class="card d-sm-none d-block">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Todas mis wishlist
                                    </button>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="#">Tecnología</a></li>
                                            <li class="list-group-item"><a href="#">Ropa deportiva</a></li>
                                            <li class="list-group-item"><a href="#">Chucherías para la casa</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <table class="">
                        <tr>
                            <td>
                                <div class="media">
                                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Audifonos Skullcandy</h5>
                                        Nulla vel metus scelerisque ante sollicitudin.
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button  type="button" class="btn btn-danger float-right">Eliminar</button>
                            </td>
                        </tr>
                    </table>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Audifonos Skullcandy</h5>
                                    Nulla vel metus scelerisque ante sollicitudin.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Mouse inalámbrico</h5>
                                    Donec lacinia congue felis in faucibus.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Pantalla UHD 50"</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Playstation5</h5>
                                    Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Lenovo Ultrabook 15"</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
			</div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear nueva lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre de la lista:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="¿Cómo deseas nombrar tu nueva lista?">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-fr">Guardar</button>
                </div>
            </div>
            </div>
        </div>
	</main>
@endsection
