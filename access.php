<?php
/**
 * Доступы для подключения к api Сбербанка.
 */
// Запрос к шлюзу для тестовой среды.
$register_do_t 	= 'https://3dsec.sberbank.ru/payment/rest/register.do';

// Запрос к шлюзу для боевой среды.
$register_do 	= 'https://securepayments.sberbank.ru/payment/rest/register.do';

// Доступы для тестовой среды.
$api_name_t    	= 'sfu-kras-api';
$api_pass_t		= 'sfu-kras';

//Доступы для боевой среды.
$api_name	    = 'sfu-kras-api';
$api_pass		= 'sfuapi273076';

//Остановка сервиса.
$api_name_d	    = 'none';
$api_pass_d		= 'none';

// Страницы редиректа.
$returnUrl 		= 'https://pay.sfu-kras.ru/success';
$failUrl 		= 'https://pay.sfu-kras.ru/error';