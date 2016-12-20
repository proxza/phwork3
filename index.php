<?php

session_start();
include "process.php";

if (!isset($_SESSION['name'])){
 header("Location: http://php1.local/phwork3/login.php");
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

        .img-avatar {
            border-radius: 5px;
            width: 100px;
            height: 100px;
        }

        h2 {
            text-align: center;
        }

    </style>
</head>

<body>

<?php

if (is_array($comments) OR empty($comments)) {

?>
<h2>Комментарии</h2>

<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Ваше имя:</td><td><input type="text" name="name" class="input" placeholder="Введите ваше имя"></td>
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
            <input type="hidden" value="save" name="action">
        </tr>
    </table>

</form>

<table>

    <?php
    $comment_col = 0; // Счетчик комментариев
    foreach ($comments as $comment) {
        $comment_col++;
        echo "<tr><td colspan='2'>Комментарий №<b>" .$comment_col. "</b> (" .$comment['dates']. ")</td></tr>";
        echo "<tr><td width='80px'><img src=\"img/" .$comment['avatar']. "\" class='img-avatar'></td><td valign='top'>Имя: <b>" .$comment['name']. "</b> <br /> Почта: <b>" .$comment['email']. "</b> </td></tr>";
        echo "<tr><td valign='top' width='400px' colspan='2' height='120px' class='td-borders'>" .nl2br($comment['comment']). "</td></tr>";
        echo "<tr><td>&nbsp;</td></tr>";
        echo "<tr><td height='2px' bgcolor='black' colspan='2'></td></tr>";
    }
    }
    ?>

</table>

</body>
</html>