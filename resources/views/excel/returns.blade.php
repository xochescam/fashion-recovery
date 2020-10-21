<table>
    <thead>
    <tr>
        <th>FECHA</th>
        <th>USUARIO</th>
        <th>MONTO</th>
        <th>MOTIVO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['date'] }}</td>
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['monto'] }}</td>
            <td>{{ $item['rason'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>