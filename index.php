<?php

session_start();
include "process.php";

// Проверка на выход через ссылку (get)
if (isset($_GET['exit'])){
    unset($_SESSION['name']);
    unset($_SESSION['uid']);
}

// Проверка на авторизацию, если в сессии есть имя - значит пользователь прошел верификацию
if (!isset($_SESSION['name'])){
 header("Location: login.php");
}

?>

<html>
<head>
    <title>Страница комментариев</title>
    <style>
        body {
            font-family: Tahoma;
            font-size: 12px;
        }

        table {
            margin: 50px auto;
            font-size: 12px;
            border: 1px solid;
            background-color: gainsboro;
            width: 500px;
        }

        .small-hint {
            font-size: 10px;
            color: cornflowerblue;
        }

        .td-borders {
            border: 1px solid;
            border-radius: 3px;
            background-color: white;
        }

        .input {
            width: 381px;
        }

        .input-name {
            width: 381px;
            background: #a8a8a8;
        }

        .img-avatar {
            border-radius: 5px;
            width: 100px;
            height: 100px;
        }

        h2 {
            text-align: center;
        }

        .a-link {
            text-align: center;
            font-size: 10px;
            text-decoration: none;
        }

    </style>
</head>

<body>

<?php

if (is_array($comments) OR empty($comments)) {

?>
<h2 name="top">Комментарии</h2>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Ваше имя:</td><td><b><?=$_SESSION['name'];?></b></td>
        </tr>
        <tr>
            <td>Ваша почта:</td><td><input type="email" name="email" class="input" placeholder="Введите вашу почту"></td>
        </tr>
        <tr>
            <td>Ваш аватар:</td><td><input type="file" name="avatar"></td>
        </tr>
        <tr>
            <td valign="top">Ваш комментарий:</td>
        </tr>
        <tr>
            <td colspan="2"><textarea rows="7" cols="67" required name="comment" maxlength="1000"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><span class="small-hint">Можно использовать bbcode: [b][i][u][s], и [img][/img]</span></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Отправить"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><a class="a-link" href="index.php?exit">[выход]</a></td>
            <input type="hidden" value="save" name="action">
        </tr>
    </table>

</form>

<table>

    <?php
    $comment_col = 0; // Счетчик комментариев
    krsort($comments);
    foreach ($comments as $comment) {
        $comment_col++;
        echo "<tr><td colspan='2'>Комментарий №<b><a name='" .$comment_col. "'> " .$comment_col. " </a></b> (" .$comment['dates']. ")</td></tr>";
        echo "<tr><td width='80px'><img src=\"img/" .$_SESSION['uid']. "/" .$comment['avatar']. "\" class='img-avatar'></td><td valign='top'>Имя: <b>" .$comment['name']. "</b> <br /> Почта: <b>" .$comment['email']. "</b> </td></tr>";
        echo "<tr><td valign='top' width='400px' colspan='2' height='120px' class='td-borders'>" .nl2br($comment['comment']). "</td></tr>";
        echo "<tr><td colspan='2' align='center'><a class=\"a-link\" href='#top'>наверх</a></td></tr>";
        echo "<tr><td height='2px' bgcolor='black' colspan='2'></td></tr>";
    }
    }
    ?>

</table>

</body>
</html>