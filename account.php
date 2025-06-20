<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}

// Отображение информации о пользователе
echo "<h1>Добро пожаловать, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
echo "<p>Это ваша страница аккаунта.</p>";
?>
