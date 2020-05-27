<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th scope="col">Alias</th>
            <th scope="col">Nombre</th>
            <th scope="col">Miembro desde</th>
<!--             <th scope="col"></th>
 -->        </tr>
    </thead>
    <tbody>
        @foreach($users[1] as $user)
            <tr>
                <th> <a href="{{ url('user',$user->Alias) }}" class="green-link">{{ $user->Alias }}</a> </th>
                <td> {{ $user->Name }} {{ $user->Lastname }} </td>
                <td> {{ $user->CreationDate }} </td>
                <!-- <td>
                    @if($user->IsBlocked)
                        <a class="btn btn-danger btn-sm" href="{{ url('unblock',$user->Alias) }}" role="button">
                            Desloquear
                        </a>
                    @else
                        <a class="btn btn-outline-danger btn-sm" href="{{ url('block',$user->Alias) }}" role="button">
                            Bloquear
                        </a>
                    @endif
                </td> -->
            </tr>
        @endforeach
    </tbody>
</table>