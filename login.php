<?php

session_start();

CONST FILE_USERS = "users.txt";

$dbusers = file_get_contents(FILE_USERS);
$dbusers = explode(":", $dbusers);

$suser = array_search($_POST['login'], $dbusers);
$spass = array_search($_POST['password'], $dbusers);

if (isset($_POST['on'])) {
    if ($dbusers[$suser] == $_POST['login'] && $dbusers[$spass] == $_POST['password']) {
        $_SESSION['name'] = $_POST['login'];
        $_SESSION['uid'] = $dbusers[$suser - 1];
        header("Location: index.php");
    }
}

?>
<html>

<body>

<form action="" method="post">
    <table align="center">
        <tr>
            <td><input type="text" name="login" placeholder="Ваш логин"></td>
        </tr>
        <tr>
            <td><input type="password" name="password" placeholder="Ваш пароль"></td>
        </tr>
        <tr>
            <td align="center"><input type="submit" value="Войти"><input type="hidden" name="on"></td>
        </tr>

    </table>
</form>

</body>
</html>

