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
                        <a class="btn btn-info btn-sm" href="{{ url('transfer',$user['alias']) }}" role="button">
                            Transferir
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>