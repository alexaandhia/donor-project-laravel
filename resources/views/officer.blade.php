<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donors data | officer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/layout.css')}}">
  </head>
  <body>

  <div class="header">
  <h2 class="title-table">Officer's Donors Response</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
    <a href="/logout" style="text-align: center">Logout</a> 
    <div style="margin: 0 10px"> | </div>
    <a href="/" style="text-align: center">Home</a>
    <div style="margin: 0 10px"> | </div>
    <a href="/officer" style="text-align: center">refresh</a>
    <div style="margin: 0 10px"> | </div>
    <div style="display: flex; padding: 0 10px;">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="search by name...">
        <button type="submit" class="btn-login">find</button>
    </form>
    <div style="margin: 0 10px"> | </div>
    </div>
    <div style="display: flex; padding: 0 10px;">

    <form action="{{route('sort.type')}}" method="GET">
      <select name="sort" id="sort">
        <option selected hidden disable>sort by type</option>
        <option value="accepted">accepted</option>
        <option value="denied">denied</option>
      </select>
        <button type="submit" class="btn-login">sort</button>
    </form>

    <div style="margin: 0 10px"> | </div>
    </div>
    </div>
    <table class="table table-bordered bg-secondary p-2 text-dark bg-opacity-50">
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
        <th scope="col">Response</th>
    </tr>
  </thead>
  <tbody>
    
    @php
        $i = 1;
        @endphp

        @foreach ($donors as $data)
    <tr>
            <td>{{$i++}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->phone}}</td>
            <td>{{$data->age}}</td>
            <td>{{$data->weight}}</td>
            <td>{{$data->type}}</td>
            <td>{{$data->email}}</td>
            <td>
            <a href="../assets/image/{{$data->foto}}" target="_blank">
            <img src="{{asset('assets/image/' . $data->foto)}}" width="120">               
           </a>
            </td>
            <td>
                    @if ($data->response)
                    {{$data->response['status']}}
                    @else 
                    - 
                    @endif
                </td>
                <td>
                    @if ($data->response)
                      @if ($data->response->status == "accepted")
                      {{date('d M, Y (h:m)', strtotime($data->response->date))}}
                      @else 
                      DONOR DENIED
                    @endif
                    @endif

                </td>
            <td>
            <a href="/response/edit/{{$data->id}}" class="btn btn-outline-success">Send Response</a>
            </td>
    </tr>
    @endforeach
  </tbody>
</table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>