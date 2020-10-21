<table>
    <thead>
    <tr>
        <th>FECHA</th>
        <th>ORIGEN</th>
        <th>DESTINO</th>
        <th>PAQUETERÍA</th>
        <th>MONTO</th>
        <th>ESTADO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['origen'] }}</td>
            <td>{{ $item['destino'] }}</td>
            <td>{{ $item['packaging'] }}</td>
            <td>${{ $item['ShippingAmount'] }}</td>
            <td>{{ $item['status'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>