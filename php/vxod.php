<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/css.css?">
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

    // SQL-запрос для проверки существования пользователя с указанным именем и паролем
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $result = mysqli_query($connect, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: ../index2.php");
        exit;
    } else {
        echo "Неверные имя пользователя или пароль.";
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
                        <a  href="../php/register.php" class="btn2">Регистрация</a>
                    </div>
                </div>

            </div>
       </div>
</section>
<form action="../php/vxod.php" method="POST">
    <div class="forma">
        <h1>Вход</h1>
        <p>Для входа введите имя пользователя и пароль</p>
    

    <label for="email">Name</label>
    <input type="text" placeholder="Введите имя" name="name" required>

    <label for="pass">Password</label>
    <input type="password" placeholder="Введите пароль" name="pass" required>

    <button type="submit" class="registerbtn"><p>Войти</p></button>

    </div>

    <div class="signin">
        <p>Еще не зарегистрированы? <a href="../php/register.php">Регистрация</a></p>
    </div>
    <div class="container">
        <a href="../index.php" class="btn4">Назад</a>
    </div>
   </form>
</body>
</html>