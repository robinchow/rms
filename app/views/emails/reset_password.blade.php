<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
        Hello,<br/>You have requested a password reset click on the link to continue with the reset
            <a href="{{ $user->reset_url() }}">Link</a> or copy and paste the url below in your browser<br/> {{ $user->reset_url() }}
        <br/>
        <br/>
        CSE Revue Webmin
		</div>
	</body>
</html>
