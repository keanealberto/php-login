<?php
  session_start();

  if (isset($_SESSION['user_id'])) {
    // code...
    header('Location: /php-login');
  }

  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    ///code
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email',$_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);//array asociativo

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'],$results['password'])) {
    //if (!empty($results) && password_verify($_POST['password'],$results['password']))
      $_SESSION['user_id'] = $results['id'];
      header('Location: /php-login');
    } else{
      $message = 'Sorry, This credentials do not match';
    }
  }



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php'?>
    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <?php if (!empty($message)) :?>

      <p><?= $message?></p>
    <?php endif; ?>


    <form action="login.php" method="post">
      <input type="text" name="email" placeholder="Enter your email">
      <input type="password" name="password" placeholder="Enter your password">
      <input type="submit" value="Send">
    </form>
  </body>
</html>
