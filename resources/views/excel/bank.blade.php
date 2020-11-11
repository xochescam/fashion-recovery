<table>
    <thead>
    <tr>
        <th>FECHA DE TRANSACCIÓN</th>
        <th>FECHA DE SOLICITUD DE PAGO</th>        
        <th>USUARIO</th>
        <th>NOMBRE COMPLETO</th>
        <th>NO. CUENTA CLABE</th>
        <th>INSTITUCIÓN BANCARIA</th>
        <th>MONTO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['paidDate'] }}</td>  
            <td>{{ $item['transDate'] }}</td>         
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['clabe'] }}</td>
            <td>{{ $item['bank'] }}</td>
            <td>{{ $item['amount'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>