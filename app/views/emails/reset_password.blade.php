<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
        Hi {{$user->profile->full_name}},<br/><br/>

        Welcome to CSE Revue. You're receiving this email because you signed up at our O-Week stall.
        You've been given an account on our website. To activate your account, click the link below
        or copy and paste the url into your web browser address bar:
        <a href="{{ $user->reset_url() }}">{{ $user->reset_url() }}</a>
        <br/>
        <br/>
        Regards,
        <br/>
        CSE Revue Webmin
		</div>
	</body>
</html>
