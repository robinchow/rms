<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Teams - {{ $team->name }}</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
		<h3>{{ $team->name }}</h3>
		{{$team->description}}
</body>
</html>