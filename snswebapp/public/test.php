<html>
  <head>
    <title>SQLインジェクション検証</title>
  </head>
  <body>
    <h1>ログイン画面</h1>
    <form action="/login.php" method="POST">
      ユーザー名：<input type="text" name="email"/><br>
      パスワード：<input type="text" name="password"/><br>
      <input type="submit" value="ログイン"/>
    </form>
  </body>
</html>
