<?php
$db = mysqli_connect('sql302.epizy.com', 'epiz_24784727', '18Mis0027vit', 'epiz_24784727_cart');


if (isset($_POST['username_check'])) {
    $username = $_POST['username'];
    $sql      = "SELECT * FROM users WHERE username='$username'";
    $results  = mysqli_query($db, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo "taken";
    } else {
        echo 'not_taken';
    }
    exit();
}
if (isset($_POST['email_check'])) {
    $email   = $_POST['email'];
    $sql     = "SELECT * FROM users WHERE email='$email'";
    $results = mysqli_query($db, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo "taken";
    } else {
        echo 'not_taken';
    }
    exit();
}
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $sql      = "SELECT * FROM users WHERE username='$username'";
    $results  = mysqli_query($db, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo "exists";
        exit();
    } else {
        $query   = "INSERT INTO users (username, email, password) 
  	       	VALUES ('$username', '$email', '" . md5($password) . "')";
        $results = mysqli_query($db, $query);
        echo 'Saved!';
        exit();
    }
}

?>
