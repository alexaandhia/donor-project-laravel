<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor</title>
</head>
<body>
    <h2 class="title-table"> WikHealth's Donors Data</h2>

<div style="padding: 0 30px">
    <table>
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Age</th>
        <th scope="col">Weight</th>
        <th scope="col">Blood type</th>
        <th scope="col">Email</th>
        <th scope="col">ID Card</th>
        <th scope="col">Status</th>
        <th scope="col">Appointment</th>
        </tr>
        </thead>
        <tbody>
        @php
        $i = 1;
        @endphp

        @foreach ($donor as $data)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$data['name']}}</td>
            <td>{{$data['phone']}}</td>
            <td>{{$data['age']}}</td>
            <td>{{$data['weight']}}</td>
            <td>{{$data['type']}}</td>
            <td>{{$data['email']}}</td>
            <td>
            <img src="assets/image/{{$data['foto']}}" width="120">               
            </td>
            <td>
                    @if ($data['response'])
                    {{$data['response']['status']}}
                    @else 
                    - 
                    @endif
                </td>
                <td>
                    @if ($data['response'])
                      @if ($data['response']['status'] == "accepted")
                      {{date('d, M, Y (h:m)', strtotime($data['response']['date']))}}
                      @else 
                      no date yet
                    @endif
                    @endif
                </td>
            <td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>