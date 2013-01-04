<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Teams</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
	@foreach($teams as $team)
		<li>{{HTML::link('/home/teams/'.$team->id,$team->name)}}

	@endforeach
</body>
</html>