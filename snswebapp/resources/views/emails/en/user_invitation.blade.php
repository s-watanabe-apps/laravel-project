Mr./Ms. {{$name ?? $email}}<br>
<br>
This is an invitation to the {{$settings['site_name']}}.<br>
Please click the link below to complete your user registration.<br>
<br>
<a href="{{env('APP_URL')}}/hogehoge?token={{$token}}">{{env('APP_URL')}}/hogehoge?token={{$token}}</a><br>
<br>
This link is valid for {{$expire_in}}.<br>
If you don't recognize this email, please discard it.