<?php
// Подключение к базе данных
$host = 'localhost';
$db   = 'catalog';
$user = 'root';
$pass = 'root';

// Попытка подключения
$conn = new mysqli($host, $user, $pass, $db);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение поискового запроса
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Подготовка запроса к базе данных
$stmt = $conn->prepare("SELECT * FROM product WHERE name LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $query);
$stmt->execute();
$result = $stmt->get_result();

// Показ результатов поиска
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        ?>
        <div class="item">
            <div class="image-container">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
            </div>
            <div class="name"><?php echo $product['name']; ?></div>
            <div class="price"><?php echo $product['price']; ?> ₽</div>
            <div class="child-sizes">
                <span><?php echo $product['sizes']; ?></span>
            </div>
        </div>
        <?php
    }
} else {
    echo "<h1>Товары не найдены.</h1>";
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
