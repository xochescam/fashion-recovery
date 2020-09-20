<table>
    <thead>
    <tr>
        <th>ALIAS</th>
        <th>GÉNERO</th>
        <th>EDAD</th>
        <th>COMPRAS</th>
        <th>MONTO TOTAL</th>
        <th>GANANCIA FR</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>{{ $item['age'] }}</td>
            <td>{{ $item['buys'] }}</td>
            <td>${{ $item['total'] }}</td>
            <td>${{ $item['gain'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>