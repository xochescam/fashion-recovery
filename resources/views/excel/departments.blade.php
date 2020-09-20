<table>
    <thead>
    <tr>
        <th>DEPARTAMENTO</th>
        <th>VENTAS</th>
        <th>GANANCIA FR</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['sells'] }}</td>
            <td>${{ $item['gain'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>