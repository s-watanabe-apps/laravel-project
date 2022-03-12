Mr./Ms. {{$name}}<br>
<br>
Reset your password.<br>
Click the link below to reset your password.<br>
<br>
<a href="{{env('APP_URL')}}/password/reset?token={{$token}}">{{env('APP_URL')}}/password/reset?token={{$token}}</a><br>
<br>
If you don't recognize this email, please discard it.