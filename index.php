<?php

// ! Cтраница: внесение успешной транзакции в базу данных и отправки на почту ссылки на чек.
// ?orderId=525606fb-cae8-70b7-a1be-05710211d19b&lang=ru

// Имя пользователя Api.
$user_name = 'sfu-kras-api';
// Пароль пользователя Api.
$password = 'sfuapi273076';
// Идентификатор транзакции из параметров запроса.
$order_id = $_GET['orderId'];
// Запрос на получение статуса транзакции.
$url_status_transaction = "https://securepayments.sberbank.ru/payment/rest/getOrderStatusExtended.do?userName=$user_name&password=$password&orderId=$order_id";
// Отправка запроса.
$get_transaction_info = file_get_contents($url_status_transaction);
// Преобразование json в ассоциативный массив.
$get_transaction_info = json_decode($get_transaction_info, TRUE);
// Статус транзакции.
$get_status = $get_transaction_info['orderStatus'];
// Поля формы.
$get_fields = $get_transaction_info['merchantOrderParams'];
// Преобразование имен и значений переданных полей формы в ассоциативный массив.
$fields = array();
foreach ($get_fields as $key => $value) {
    $fields[$value['name']] = $value['value'];
}
// Значения для занесения в базу данных.
$description    = $fields['Описание'];
$libnumber      = $fields['Читательский билет'];
$personal       = $fields['personal'];
$package        = $fields['Количество проверок'];
$surname        = $fields['Фамилия читателя'];
$address        = $fields['Адрес'];
$dogovor        = $fields['Договор'];
$hostel         = $fields['Общежитие'];
$status         = $fields['Статус'];
$payer          = $fields['Плательщик'];
$phone          = $fields['Телефон'];
$event          = $fields['Событие'];
$email          = $fields['Почта'];
$room           = $fields['Комната'];
$url            = $fields['URL'];
$fio            = $fields['ФИО'];
$org            = $fields['Организация'];
$order_number   = $get_transaction_info['orderNumber'];
$order_status   = $get_transaction_info['orderStatus'];
$service        = $get_transaction_info['orderDescription'];
$cost           = $get_transaction_info['paymentAmountInfo']['approvedAmount'] / 100;
// Генерация пароля для доступа к чеку.
$hash = '0123456789qwertyuiopasdfghjklzxcvbnm';
$password = str_shuffle($hash);
$password = substr($password, 0, 10);
// Подключение к базе данных.
$connect = mysqli_connect("localhost", "graduation", "eex3ge3J", "db_graduation");
// Установка кодировки.
$connect -> set_charset("utf8");
// Запрос к базе данных.
$sql = "INSERT INTO `transaction` VALUES (NULL, '$description', '$libnumber', '$personal', '$package', '$service', '$surname', '$address', '$dogovor', '$hostel', '$status', '$payer', '$phone', '$event', '$email', '$cost', '$room', '$url', '$fio', '$org', '$order_id', '$password', '$order_number', '$order_status', CURRENT_TIMESTAMP)";
// Реализация запроса.
$res = mysqli_query($connect, $sql);
// Отправка ссылки на чек.
mail("sleshukov@sfu-kras.ru", "Загаловок", "https://pay.sfu-kras.ru/cheque?orderNumber=$order_number&password=$password");

// ! Cтраница проверки чека.
// ?orderNumber=1594018660&password=e8j9ydosbh
// Таймшамп, присвоенный транзакции.
$order_number = $_GET['orderNumber'];
// Пароль, писвоенный транзакции.
$password = $_GET['password'];
// Запрос в базу данных.
$sql = "SELECT * FROM `transaction` WHERE `order_number` = '$order_number' AND `password` = '$password'";
// Реализация запроса.
$res = mysqli_query($connect, $sql);
// Преобразование в ассоциативный массив.
$res = mysqli_fetch_assoc($res);

// ! Для отладки.
echo '<pre>';
print_r($res);
echo '</pre>';

// ! Коды orderStatus
// 0 - заказ зарегистрирован, но не оплачен;
// 1 - предавторизованная сумма удержана (для двухстадийных платежей);
// 2 - проведена полная авторизация суммы заказа;
// 3 - авторизация отменена;
// 4 - по транзакции была проведена операция возврата;
// 5 - инициирована авторизация через сервер контроля доступа банка-эмитента;
// 6 - авторизация отклонена.

// ! Коды ошибок
// 0	Обработка запроса прошла без системных ошибок.
// 5 - Доступ запрещён.
// 5 - Пользователь должен сменить свой пароль.
// 5 - [orderId] не задан.
// 6 - Незарегистрированный orderId.
// 7 - Системная ошибка.

// ! Было полезно:
// $_SERVER - Содержит данные о конфигурации сервера и конфигурации клиента.
// str_shuffle() - Перемешивает символы в передаваемой строке случайным образом.
// substr() - Обрезает строку.