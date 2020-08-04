<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th scope="col">Alias</th>
            <th scope="col">Compras</th>
            <th scope="col">Cartera</th>
            <th scope="col">Transferencia</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users[1] as $user)
            <tr>
                <th> <a href="{{ url('user',$user->Alias) }}" class="green-link">{{ $user->Alias }}</a> </th>
                <td> {{ $user->Buy }} </td>
                <td> {{ $user->Wallet }} </td>
                <td> 
                    @if(isset($user->IsTransfer) && !$user->IsTransfer)
                        <a class="btn btn-info btn-sm" href="{{ url('transfer-wallet',$user->id) }}" role="button">
                            Transferir
                        </a>
                    @endif
                </td>
                <td>
                    @if($user->IsBlocked)
                        <a class="btn btn-danger btn-sm" href="{{ url('unblock',$user->Alias) }}" role="button">
                            Desloquear
                        </a>
                    @else
                        <a class="btn btn-outline-danger btn-sm" href="{{ url('block',$user->Alias) }}" role="button">
                            Bloquear
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>