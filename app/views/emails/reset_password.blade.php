<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
        Hi {{{$user->profile->full_name}}},<br/><br/>

        You have requested a password reset. 
        Click <a href="{{ $user->reset_url() }}">here</a> to continue to reset your password
        or copy and paste the url below in your browser:<br/> 
        {{ $user->reset_url() }}
        <br/>
        <br/>
        CSE Revue Webmin
        </div>
    </body>
</html>
