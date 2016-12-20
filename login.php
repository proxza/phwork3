<?php

session_start();

CONST FILE_USERS = "users.txt";

$dbusers = file_get_contents(FILE_USERS);
$dbusers = explode(":", $dbusers);


//if (isset($_POST['submit'])) {
    if ($dbusers[1] == $_POST['login'] && $dbusers[2] == $_POST['password']){
    $_SESSION['name'] = $_POST['login'];
    $_SESSION['uid'] = $dbusers[0];
    header("Location: index.php");
    }
//}

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

