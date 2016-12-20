<?php

session_start();

CONST FILE_USERS = "users.txt";

$dbusers = fopen(FILE_USERS, "r");
$users = [];

while(!feof($dbusers)){
    $res = fgets($dbusers);
    $res = explode(":", $res);
    array_push($users, $res);
}

foreach ($users as $user) {
    if ($user[1] == $_POST['login'] && $user[2] == $_POST['password']) {
        $_SESSION['name'] = $_POST['login'];
        header("Location: http://php1.local/phwork3/");
    }
}

?>
<html>

<body>

<form action="" method="post">
    <input type="text" name="login">
    <input type="password" name="password">
    <input type="submit">
</form>

</body>
</html>

