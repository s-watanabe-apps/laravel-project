{{$name}}さん<br>
<br>
パスワードをリセットします。<br>
以下のリンクをクリックし、パスワードを再設定してください。<br>
<br>
<a href="{{env('APP_URL')}}/password/reset?token={{$token}}">{{env('APP_URL')}}/password/reset?token={{$token}}</a><br>
<br>
このリンクは{{$expire_in}}有効です。<br>
このメールに見覚えがない場合、お手数ですがこのメールを破棄してください。