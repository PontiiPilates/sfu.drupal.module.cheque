<?php

/**
 * Доступы для подключения к api Сбербанка.
 */
// Запрос к шлюзу для тестовой среды.
// $register_do     = 'https://3dsec.sberbank.ru/payment/rest/register.do';

// Запросы к шлюзу для боевой среды.
$register_do         = 'https://securepayments.sberbank.ru/payment/rest/register.do';
$order_status_do     = 'https://securepayments.sberbank.ru/payment/rest/getOrderStatusExtended.do';

// Доступы для тестовой среды.
// $api_name        = 'sfu-kras-api';
// $api_pass        = 'sfu-kras';

//Доступы для боевой среды.
$api_name        = 'sfu-kras-api';
$api_pass        = 'sfuapi273076';

//Остановка сервиса.
// $api_name        = 'none';
// $api_pass        = 'none';

// Страницы редиректа.
// $returnUrl         = 'https://pay.sfu-kras.ru/success';
// $failUrl           = 'https://pay.sfu-kras.ru/error';
$returnUrl         = 'https://pay.sfu-kras.ru/transaction-success';
$failUrl           = 'https://pay.sfu-kras.ru/transaction-failure';

// Подключение к базе данных на локальном сервере.
$connect = mysqli_connect("localhost", "root", "", "db_pay");
// $connect = mysqli_connect("localhost", "root", "", "db_pay");

// Установка кодировки.
$connect->set_charset("utf8");

/**
 * Проверка: выводит количество строк, в которых обнаружены совпадения.
 * Возвращает: целое число, обозначающее количество найденных строк, в которых зафиксировано совпадение.
 */
function _db_query_check($connect, $query)
{
    $res = mysqli_query($connect, $query);
    $res = mysqli_num_rows($res);
    return $res;
}

/**
 * Добавление записи в базу данных.
 * Возвращает 1 или "true" в случае успеха.
 */
function _db_query_add($connect, $query)
{
    $res = mysqli_query($connect, $query);
    return $res;
}

/**
 * Обновление значений в базе данных
 * Возвращает 1 или "true" в случае успеха.
 */
function _db_query_update($connect, $query)
{
    $res = mysqli_query($connect, $query);
    return $res;
}

/**
 * Вывод информации из базы данных.
 */
function _db_query_output($connect, $query)
{
    $res = mysqli_query($connect, $query);
	$res = mysqli_fetch_assoc($res);
    return $res;
}

/**
 * Генерация слуяайного буквенно-цифрового набора.
 */
function _password_generate()
{
    $hash = '0123456789qwertyuiopasdfghjklzxcvbnm';
    $password = str_shuffle($hash);
    // Установка длинны буквенно-цифрового набора.
    $password = substr($password, 0, 10);
    return $password;
}
