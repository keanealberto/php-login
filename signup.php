<?php
  require 'database.php';

  $message= '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {

    if ($_POST['password'] == $_POST['confirm_password']) {
      $sql = "INSERT INTO users(email,password) VALUES (:email,:password)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email',$_POST['email']);
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $stmt->bindParam(':password',$password);

      if ($stmt->execute()) {
        $message = 'Successfully created a new user';
      }else{
        $message = 'Sorry there must been an issue creating your account';
      }
    }else{
      $message ='Passwords do not match, try again ';
    }

  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php'?>

    <?php  if (!empty($message)): ?>
      <p><?=$message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form  action="signup.php" method="post">
      <input type="text" name="email" placeholder="Enter your email">
      <input type="password" name="password" placeholder="Enter your password">
      <input type="password" name="confirm_password" placeholder="Confirm your password">
      <input type="submit" value="Send">
    </form>
  </body>
</html>
