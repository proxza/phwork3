<?php

session_start();

print_r($dbusers);



foreach ($users as $user) {
    if ($dbusers[1] == $_POST['login'] && $dbusers[2] == $_POST['password']) {
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
    <input type="hidden" name="on">
</form>

</body>
</html>

