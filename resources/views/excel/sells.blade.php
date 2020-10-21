<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Vendedor</th>
        <th>Nivel vendedor</th>
        <th>Género</th>
        <th>Edad</th>
        <th>Ciudad</th>
        <th>Tipo de prenda</th>
        <th>Departamento</th>
        <th>Importe venta</th>
        <th>Comisión FR</th>
        <th>Ganancia vendedor</th>
        <th>Costo envio FR</th>
        <th>Costo por transacción</th>
        <th>Ganancia total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['level'] }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>{{ $item['age'] }}</td>
            <td>{{ $item['livein'] }}</td>
            <td>{{ $item['type'] }}</td>
            <td>{{ $item['department'] }}</td>
            <td>{{ $item['import'] }}</td>
            <td>${{ $item['comission'] }}</td>
            <td>${{ $item['gainSeller'] }}</td>
            <td>{{ $item['transaction'] }}</td>
            <td>${{ $item['shipping'] }}</td>
            <td>${{ $item['gainFR'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>