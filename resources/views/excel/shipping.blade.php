<table>
    <thead>
    <tr>
        <th>MONTO</th>
        <th>ENVIOS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['ShippingAmount'] }}</td>
            <td>{{ $item['count'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>