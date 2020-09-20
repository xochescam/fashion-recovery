<table>
    <thead>
    <tr>
        <th>ALIAS</th>
        <th>GÉNERO</th>
        <th>EDAD</th>
        <th>DEVOLUCIONES</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>{{ $item['age'] }}</td>
            <td>{{ $item['returns'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>