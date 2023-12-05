<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datebase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];
$time = $_POST['time'];

// Вставка данных в базу данных
$sql = "INSERT INTO reservations (name, email, date, time) VALUES ('$name', '$email', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    echo "Бронирование успешно добавлено";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>