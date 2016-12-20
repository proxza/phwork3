<?php

CONST FILE_NAME = "db.txt";
CONST FILE_BLACK = "blacklist.txt";
CONST FILE_USERS = "users.txt";

$comments = unserialize(file_get_contents(FILE_NAME));
$blacklist = fopen(FILE_BLACK, "r");
$block = [];


if (isset($_POST['action']) && $_POST['action'] == "save"){

    // Инициализируем для удобства наши переменные из POST'а
    $name = $_POST['name'];
    $dates = date("d.m.Y G:i");
    $comment = $_POST['comment'];
    $email = $_POST['email'];
    $avatar = $_FILES['avatar']['name'];

    // Проверка на загрузку аватара
    if (!empty($_FILES['avatar']['name'])) {
        // достаем разрешение
        list($file_name, $ext) = explode(".", $_FILES['avatar']['name']);

        // копирование файлика
        //copy($_FILES['avatar']['tmp_name'], "images/".md5(microtime()).".".$ext);
        copy($_FILES['avatar']['tmp_name'], "img/" . $_FILES['avatar']['name']);
        // удаление файла временного
        @($_FILES['avatar']['tmp_name']);
    }else{
        $avatar = "noavatar.png"; // Если пользователь не загрузил аватарку, ставим ему аватарку по умолчанию
    }

    if (!is_array($comments)){
        $comments = [];
    }

    // Берем наш черный список и добавляем его в массив для будущей проверки слов
    while(!feof($blacklist)){
        $res = fgets($blacklist);
        array_push($block, trim($res));
    }

    // Проверяем наши слова в комментариях на запрещенные
    foreach ($block as $item){
        $comment = str_replace($item, "[МАТ]", $comment);
    }

    $email = str_replace("@", "[at]", $email); // Замена адреса почты
    $comment = preg_replace('/\[(\/?)(b|i|u|s)\s*\]/', "<$1$2>", $comment); // Регулярка на BBCOD'ы для тегов <b>, <i>, <s>, <u>
    $comment = preg_replace("/\[img\s*\]([^\]\[]+)\[\/img\]/", "<img src=\"$1\" alt=\"\" />", $comment); // Регулярка на BBCODE тега [img]адрес_картинки[/img]

    array_push($comments, ["name"=>$name, "dates"=>$dates, "email"=>$email, "avatar"=>$avatar, "comment"=>$comment]);
    file_put_contents(FILE_NAME, serialize($comments));

}

function auth($login, $password){
    $dbusers = file_get_contents(FILE_USERS);
    $dbusers = explode(":", $dbusers);

}


?>