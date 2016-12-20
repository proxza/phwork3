<?php

CONST FILE_NAME = "db.txt";
CONST FILE_BLACK = "blacklist.txt";

$comments = unserialize(file_get_contents(FILE_NAME));
$blacklist = fopen(FILE_BLACK, "r");
$block = [];


if (isset($_POST['action']) && $_POST['action'] == "save"){

    // Инициализируем для удобства наши переменные из POST'а
    $id = trim($_SESSION['uid']);
    $name = $_SESSION['name'];
    $dates = date("d.m.Y G:i");
    $comment = $_POST['comment'];
    $email = $_POST['email'];
    $idDir = "img/".$id; // Переменная совмещающая id юзера и путь к его папке для картинок
    //$avatar = microtime();

    // Если папки с номером id юзера нет - создаем
    if (!is_dir($idDir)){
        mkdir($idDir);
    }

    // Проверка на загрузку аватара
    if (!empty($_FILES['avatar']['name'])) {
        // достаем разрешение
        list($file_name, $ext) = explode(".", $_FILES['avatar']['name']);

        // Делаем md5-хеш с названием и разрешением нашей картинки
        $avatar = md5(microtime()).".".$ext;

        // Копирование файла
        @copy($_FILES['avatar']['tmp_name'], $idDir. "/" .$avatar);

        // удаление файла временного
        @($_FILES['avatar']['tmp_name']);

    }else{

        $avatar = "noavatar.png"; // Если пользователь не загрузил аватарку, ставим ему аватарку по умолчанию
        @copy("img/noavatar.png", $idDir. "/" .$avatar);
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
        $comment = str_replace($item, "<span class='danger'>[МАТ]</span>", $comment);
    }

    $email = str_replace("@", "[at]", $email); // Замена адреса почты
    $comment = preg_replace('/\[(\/?)(b|i|u|s)\s*\]/', "<$1$2>", $comment); // Регулярка на BBCOD'ы для тегов <b>, <i>, <s>, <u>
    $comment = preg_replace("/\[img\s*\]([^\]\[]+)\[\/img\]/", "<img src=\"$1\" alt=\"\" />", $comment); // Регулярка на BBCODE тега [img]адрес_картинки[/img]

    array_push($comments, ["id"=>$id, "name"=>$name, "dates"=>$dates, "email"=>$email, "avatar"=>$avatar, "comment"=>$comment]);
    file_put_contents(FILE_NAME, serialize($comments));

}

?>