<html>
  <head>
    <title>SQLインジェクション検証</title>
  </head>
  <body>
    <h1>認証</h1>
    <?php
      $pdo = new PDO("mysql:host=mysql;dbname=test", 'user', 'password');

      $email = $_POST["email"];
      $password = $_POST["password"];

      $sql = "
select *
from   users
where  email = :email
and    password = :password";

      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password);

      $stmt->execute();
      $user = $stmt->fetch();

      echo "<h2>認証結果</h2>";
      if ($user) {
        echo "<div style=\"color: #00f;\"><b>認証成功</b></div>";
        echo "Eメール：{$user['email']}<br>";
        echo "名前：{$user['name']}<br>";
      } else {
        echo "<div style=\"color: #f00;\"><b>認証失敗</b></div>";
      }

      echo "<h2>実行したSQL</h2>";
      echo "<pre style=\"border: 1px solid #aaa; padding: 10px;\">{$sql}</pre>";

    ?>
  </body>
</html>
