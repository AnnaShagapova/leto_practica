<?php
    session_start();
    
    // Уничтожаем все данные сессии
    session_unset();
    session_destroy();
    
    // Перенаправляем пользователя на страницу входа или другую страницу по вашему выбору
    header("Location: index.php"); // Замените "login.php" на URL страницы входа
    
    exit(); // Обязательно вызывайте exit() после использования header()
?>