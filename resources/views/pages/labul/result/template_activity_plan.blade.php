<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">ID</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">NIP</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Nama</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activity_plan as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $key + 1 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
