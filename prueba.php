<?php
    require 'database.php';

    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email',$_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = $results;

    echo $user['email'];


?>