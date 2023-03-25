<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login | admin and officer only</title>

  <link rel="stylesheet" href="{{asset('assets/css/reset.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" media="screen" type="text/css" />

</head>

<body>

@if ($errors->any)
        <ul style="width: 100%; padding: 10px">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    @endif
  @if (Session('errorLogin'))
        <div style="width: 100%; padding: 10px">
        <ul class="alert alert-success" role="alert">{{ session('errorLogin') }}</ul>
        </div>
        <!-- bisa pake Session::get('successAdd') kalo pake :: itu class, jadi harus kapital awalnya-->
        @endif


  <div class="wrap">
  
	<h2>Login For Admin and Officer</h2>
		<div class="avatar">
      <img src="{{asset('assets/img/gallery/logowh.png')}}">
		</div>
		<form action="{{route('auth')}}" method="POST">
		@csrf
		<input type="email" placeholder="email" required name="email">
		<div class="bar">
			<i></i>
		</div>
		<input type="password" placeholder="password" required name="password">
		<button>Sign in</button>
        <a href="/" class="button">Back</a>
		</form>
	</div>

  <script src="js/index.js"></script>

</body>

</html>