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
	@foreach($faqs as $faq)
		<h3>{{ $faq->question }}</h3>
		<p>{{ nl2br($faq->answer) }}</p>
	@endforeach
</body>
</html>