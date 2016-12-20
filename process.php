<?php

CONST FILE_NAME = "db.txt";
CONST FILE_BLACK = "blacklist.txt";

$comments = unserialize(file_get_contents(FILE_NAME));
$blacklist = fopen(FILE_BLACK, "r");
$block = [];


if (isset($_POST['action']) && $_POST['action'] == "save"){

    // достаем разрешение
    list($file_name, $ext) = explode(".", $_FILES['avatar']['name']);

    // копирование файлика
    //copy($_FILES['avatar']['tmp_name'], "images/".md5(microtime()).".".$ext);
    copy($_FILES['avatar']['tmp_name'], "images/".$_FILES['avatar']['name']);
    print_r($_FILES);
    // удаление файла временного
    @($_FILES['avatar']['tmp_name']);

    if (!is_array($comments)){
        $comments = [];
    }

    $name = $_POST['name'];
    $dates = date("d.m.Y G:i");
    $comment = $_POST['comment'];
    $email = $_POST['email'];
    $avatar = $_FILES['avatar']['name'];

    while(!feof($blacklist)){
        $res = fgets($blacklist);
        array_push($block, trim($res));
    }

    foreach ($block as $item){
        $comment = str_replace($item, "[МАТ]", $comment);
    }

    $email = str_replace("@", "[at]", $email); // Замена адреса почты
    $comment = preg_replace('/\[(\/?)(b|i|u|s)\s*\]/', "<$1$2>", $comment);
    $comment = preg_replace("/\[img\s*\]([^\]\[]+)\[\/img\]/", "<img src=\"$1\" alt=\"\" />", $comment); // Регулярка на BBCODE тега [img]адрес_картинки[/img]

    array_push($comments, ["name"=>$name, "dates"=>$dates, "email"=>$email, "avatar"=>$avatar, "comment"=>$comment]);
    file_put_contents(FILE_NAME, serialize($comments));

}

?>