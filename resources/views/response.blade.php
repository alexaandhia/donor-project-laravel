<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Give Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <h1>Give Response to Donor</h1>
    <form action="{{route('response.update', $donorId)}}" method="POST">
    <div class="mb-3 row">
    @csrf
    @method('PATCH')
    @if ($donor)
    <label for="select" class="col-sm-2 col-form-label">Status</label>
    <select class="form-select" aria-label="Default select example" id="select" name="status">
  <option selected hidden disabled>Choose the status</option>
  <option value="accepted" {{ $donor['status'] == 'accepted' ? 'selected' : '' }}>accepted</option>
  <option value="denied" {{ $donor['status'] == 'denied' ? 'selected' : '' }}>denied</option>
    </select>
    @else
    <select class="form-select" aria-label="Default select example" id="select" name="status">
  <option selected hidden disabled>Choose the status</option>
  <option value="accepted">accepted</option>
  <option value="denied">denied</option>
    </select>
    @endif
    </div>
  </div>
  <div class="mb-3 row">
    <label for="date" class="col-sm-2 col-form-label">Appointment</label>
    <div class="col-sm-10">
    <input type="datetime-local" name="date" class="form-control" placeholder="date" id="date" value="">
    </div>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  <a href="/" class="btn btn-danger">Back</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>