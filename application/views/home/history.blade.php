<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>History</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
	<p>Some random info</p>

	@foreach($years as $year)
		<h3>{{$year->year}}: {{$year->name}}</h3>
		Directors:{{$year->directors()}}<br>
		Producers:{{$year->producers()}}
	@endforeach
</body>
</html>