<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donors data | admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/layout.css')}}">
  </head>
  <body>

  <div class="header">
  <h2 class="title-table">Admin's Donors Data</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
    <a href="/logout" style="text-align: center">Logout</a> 
    <div style="margin: 0 10px"> | </div>
    <a href="/" style="text-align: center">Home</a>
    <div style="margin: 0 10px"> | </div>
    <a href="{{ route('export.pdf') }}">Export to PDF</a>
    <div style="margin: 0 10px"> | </div>
    <a href="{{ route('export.excel') }}">Export to Excel</a>
    <div style="margin: 0 10px"> | </div>
    <div style="display: flex; padding: 0 30px;">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="search by name...">
        <button type="submit" class="btn-login">cari</button>
    </form>
    <div style="margin: 0 10px"> | </div>
    </div>
    <ul class="pagination">
    {!!$donors->links() !!}
    </ul>
    </div>
    </div>
    </div>

    @if (Session('successDelete'))
        <div style="width: 100%; padding: 10px">
        <ul class="alert alert-danger" role="alert">{{ session('successDelete') }}</ul>
        </div>
        <!-- bisa pake Session::get('successAdd') kalo pake :: itu class, jadi harus kapital awalnya-->
    @endif

    <table class="table table-bordered bg-secondary p-2 text-dark bg-opacity-50 mx-auto">
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
        <th scope="col">Action</th>
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

            @php
            $no = substr_replace($data->phone, "62",0,1 );
            @endphp
            @php
            if ($data->response){
                $message = 'Hello '. $data->name . '! you are '. $data->response['status'] . ' for being a donor! ' . $data->response['dates'];
                }else{
                    $message = 'no response yet.';
                }
            @endphp
            <td><a href="https://wa.me/{{$no}}/?text=%20{{$message}}%20" target="__blank">{{$no}}</a></td>
            <td>{{$data->age}}</td>
            <td>{{$data->weight}}</td>
            <td>{{$data->type}}</td>
            <td><a href="mailto:{{$data->email}}">{{$data->email}}</a></td>
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
                      Donor Denied
                    @endif
                    @endif
                </td>
            <td>
            <form action="/delete/{{$data->id}}" method="post">
              @csrf
              @method('DELETE')
                    
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                        <form action="{{route('created.pdf', $data->id)}}" method="GET">
                           
                            <button class="btn btn-info" type="submit">Print</button>
                        </form>
            </td>
    </tr>
    @endforeach
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>