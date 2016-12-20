<?php

include "process.php";

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
        }

        .small-hint {
            font-size: 10px;
            color: cornflowerblue;
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
            <td>Ваше имя:</td><td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Ваша почта:</td><td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Ваш аватар:</td><td><input type="file" name="avatar"></td>
        </tr>
        <tr>
            <td valign="top">Ваш комментарий:</td>
        </tr>
        <tr>
            <td colspan="2"><textarea rows="7" cols="45" required name="comment"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><span class="small-hint">Можно использовать bbcode: [b][/b], [img][/img]</span></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Отправить"></td>
            <input type="hidden" value="save" name="action">
        </tr>
    </table>

</form>

<table border="1">

    <?php
    $comment_col = 0; // Счетчик комментариев
    foreach ($comments as $comment) {
        $comment_col++;
        echo "<tr><td colspan='2'>Комментарий №" .$comment_col. " (" .$comment['dates']. ")</td></tr>";
        echo "<tr><td width='80px'><img src=\"images/" .$comment['avatar']. "\" width='80px' height='80px'></td><td valign='top'>Имя: " .$comment['name']. " <br /> Почта: " .$comment['email']. " </td></tr>";
        echo "<tr><td valign='top' width='400px' colspan='2' height='100px'>" .$comment['comment']. "</td></tr>";
        echo "<tr><td height='5px' bgcolor='black' colspan='2'></td></tr>";
    }
    }
    ?>

</table>

</body>
</html>