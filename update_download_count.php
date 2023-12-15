<?php
// Ваш код для установления соединения с базой данных
require_once ("config.php");
$connect = mysqli_connect($host, $user, $pass, $db);
    if(!$connect) {
    die();
 }

if (isset($_POST['id_photo'])) {
    $photoId = $_POST['id_photo'];
    
    // Запрос на обновление значения download_count
    $query = "UPDATE photos SET download_count = download_count + 1 WHERE id_photo = $photoId";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        // Ответ сервера в случае успешного обновления значения download_count
        echo "Success";
    } else {
        // Ответ сервера в случае ошибки при обновлении значения download_count
        echo "Error";
    }
}
