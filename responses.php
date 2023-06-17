<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $response = $_POST['response'];
    $token = "5910801981:AAF1awL84ElfovtqYsa96s7dnIRcL-x-Kg0";
    $chat_id = "1114286054";
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    $text = "Имя: $name\nОтвет: $response";
    $params = array(
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'html'
    );

    $query = http_build_query($params);
    $url .= '?' . $query;

    $result = file_get_contents($url);

    if ($result) {
        // Запись данных в файл
        $file = fopen("responses.txt", "a"); // Открываем файл для записи (если он не существует, будет создан)
        fwrite($file, $text . "\n"); // Записываем данные в файл
        fclose($file); // Закрываем файл

        header("Location: index.html");
        exit();
    } else {
        $error = error_get_last();
        echo 'Произошла ошибка при отправке сообщения в Telegram: ' . $error['message'];
    }
}
?>
