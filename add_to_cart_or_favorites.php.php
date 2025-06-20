<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $product = $data['product'];

    if ($action === 'cart') {
        $_SESSION['cart'][] = $product;
        echo "Товар добавлен в корзину";
    } elseif ($action === 'favorites') {
        $_SESSION['favorites'][] = $product;
        echo "Товар добавлен в избранное";
    } else {
        echo "Некорректное действие";
    }
} else {
    echo "Недопустимый метод запроса";
}
?>
