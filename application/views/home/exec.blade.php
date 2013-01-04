<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>FAQ</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
	@foreach($execs as $exec)
		<h3>{{ $exec->position }}</h3>
		@foreach($exec->get_members($year->id) as $member)
			{{$member->profile->full_name}}
		@endforeach
	@endforeach
</body>
</html>