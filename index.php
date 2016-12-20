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
            margin: 0 auto;
            font-size: 12px;
            border: 1px solid;
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
            <td>Ваш комментарий:</td><td><input type="text" name="comment"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Отправить"></td>
            <input type="hidden" value="save" name="action">
        </tr>
    </table>

</form>

<table border="1">

    <?php
    foreach ($comments as $comment) {
        echo "<tr><td rowspan='2' width='80px'><img src=\"images/" .$comment['avatar']. "\" width='80px' height='80px'></td><td>Имя: " .$comment['name']. "</td></tr>";
        echo "<tr><td colspan='2'>Почта: " .$comment['email']. "</td></tr>";
        echo "<tr><td width='300px' colspan='2'>" .$comment['comment']. "</td></tr>";
        echo "<tr><td height='5px' bgcolor='black' colspan='2'></td></tr>";
    }
    }
    ?>

</table>

</body>
</html>