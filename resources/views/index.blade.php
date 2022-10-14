<!DOCTYPE>
<html>
<head>
	<title>Quotebiz</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	@if(Auth::user())
	<a href="{{ url('super-admin') }}" class="btn btn-success" style="position: absolute;right: 30;
	top: 15px">Dashboard</a>
	@else
	<a href="{{ url('login') }}" class="btn btn-success" style="position: absolute;right: 30;
	top: 15px">Login</a>
	@endif
<iframe src="https://quotebiz.io" style="width: 100%;height: 760px;border: 0px"></iframe>
</body>
</html>