<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/css.css?<?php echo time(); ?>">
</head>
<body>
<section class="header_container">
       <div class="container">
            <div class="menu">
                <div class="logo">
                    <img src="img/foto_logo.png" alt="">
                    <div class="btn"> 
                    <?php
                    require_once("config.php");
                    $connect = mysqli_connect($host, $user, $pass, $db);
                        if (!$connect) {
                            die();
                        }
                    session_start();
                        if (isset($_SESSION["username"])) {
                            $username = $_SESSION["username"];
                            $sql = "SELECT id_user FROM users WHERE username='$username'";
                            $result = mysqli_query($connect, $sql);
                            echo "<div class='usname'>
                                  <h1>Вы авторизованы:</h1>
                                  <p>$username</p>
                                  </div>";
                            $row = mysqli_fetch_assoc($result);
                            $author_id = $row['id_user']; // Получаем значение author_id из результата запроса к базе данных
                        }
                    
                    ?>
                    <form action='logout.php' method='POST'>
                        <button type='submit' class='btn2'>Выйти</button>
                    </form>
                    </div>
                </div>
            </div>
       </div>
</section>
<section>
    <div class="container">
            <form action="add_photo.php" method="POST" enctype="multipart/form-data">
                <div class="forma1">
                    <label for="name_photo">Name</label>
                    <input type="text" placeholder="Введите название фотографии" name="name_photo" required>

                    <label for="category">Выберите категорию</label>
                    <?php
                        $result = mysqli_query($connect, "SELECT id_category, name FROM categories");

                        echo "<select name='category' id='category'>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='".$row['id_category']."'>".$row['name']."</option>";
                        }
                        echo "</select>";
                    ?>

                    <label for="file">Загрузите фотографию</label>
                    <input type="file" name="file" required>

                    <input type="hidden" name="id_user" value="<?php echo $author_id; ?>"> <!-- Добавляем скрытое поле для передачи значения author_id -->

                    <input type="submit" value="Добавить фото">
                </div>
            </form>
            <a href="./index2.php" class="btn4">Назад</a>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Получаем значения из формы
                    $name_photo = $_POST["name_photo"];
                    $category = $_POST["category"];
                    $file = $_FILES["file"];
                    $author_id = $_POST["id_user"];

                    // Проверяем, загружен ли файл
                    if ($file["error"] === UPLOAD_ERR_OK) {
                        $tmp_name = $file["tmp_name"];
                        $img_path = "./img/" . $file["name"]; // Замените "path/to/storage/" на путь к хранилищу фотографий

                        // Сохраняем файл в хранилище
                        move_uploaded_file($tmp_name, $img_path);

                        $date_added = date("Y-m-d H:i:s");

                        // Вставляем данные в таблицу photos
                        $query = "INSERT INTO photos (name_photo, category_id, img_path, date_added, author_id, download_count) VALUES ('$name_photo', '$category', '$img_path', '$date_added', '$author_id', '0')";
                        mysqli_query($connect, $query);
                    }
                    header('Location: index2.php');
                    exit;
                }
            ?>
    </div>
</section>
    
</body>
</html>
