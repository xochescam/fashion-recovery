<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th scope="col">Usuario</th>
            <th scope="col">Compras</th>
            <th scope="col">Ventas</th>
            <th scope="col">Cartera</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th> <a href="{{ url('user',$user['alias']) }}" class="green-link">{{ $user['alias'] }}</a> </th>
                <td> {{ $user['buys'] }} </td>
                <td> {{ $user['sells'] }} </td>
                <td> {{ $user['cartera'] }} </td>
                <td>
                    @if($user['IsTransfer'])
                        <a class="btn btn-outline-green btn-sm" data-toggle="modal" data-target="#transferModal-{{ $user['id'] }}">
                            Transferir 
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>