<table>
    <thead>
    <tr>
        <th>...</th>
        <th>...</th>
        <th>...</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['alias'] }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>{{ $item['age'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>