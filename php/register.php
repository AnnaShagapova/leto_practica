<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/css.css?<?echo time();?>">
</head>
<body>
    
<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Установка соединения с базой данных
    $connect = mysqli_connect($host, $user, $pass, $db);
    if (!$connect) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    $username = $_POST["name"];
    $password = $_POST["pass"];

    // Проверка наличия пользователя в таблице
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connect, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='forma'><h1>Пользователь с таким именем уже существует</h1></div>";
        echo "<div class='forma'><a href='../php/register.php' class='btn4'><p>Назад</p></a></div>";
        exit;
    }

    // SQL-запрос для вставки данных в таблицу
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($connect, $sql)) {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: ../index2.php");
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . mysqli_error($connect);
    }

    // Закрытие соединения с базой данных
    mysqli_close($connect);
}
?>


<section class="header_container">
       <div class="container">
            <div class="menu">
                <div class="logo">
                    <img src="../img/foto_logo.png" alt="">
                    <div class="btn"> 
                        <a  href="../php/vxod.php" class="btn2">Вход</a>
                    </div>
                </div>

            </div>
       </div>
</section>
   <form action="../php/register.php" method="POST">
    <div class="forma">
        <h1>Регистрация</h1>
        <p>Для регистрации введите имя пользователя и пароль</p>
    

    <label for="email">Name</label>
    <input type="text" placeholder="Введите имя" name="name" required>

    <label for="pass">Password</label>
    <input type="password" placeholder="Введите пароль" name="pass" required>

    <button type="submit" class="registerbtn"><p>Зарегистрироваться</p></button>

    </div>

    <div class="signin">
        <p>Уже зарегистрированы? <a href="../php/vxod.php">Войти</a></p>
    </div>
    <div class="container">
        <a href="../index.php" class="btn4">Назад</a>
    </div>
   </form>
</body>
</html>