    <?php


    echo '<pre>';
    echo '<p><strong>Получаем параметры из адресной строки</strong></p>';
    print_r($_SERVER['QUERY_STRING']);
    echo '</pre>';
    // $_SERVER['SCRIPT_NAME'] - путь до исполняемого файла.
    // $_SERVER['REQUEST_URI'] - весь запрос от URL.
    // $_SERVER['QUERY_STRING'] - параметры запроса.
    

    // !Получаем orderId.
    $get_params = $_SERVER['QUERY_STRING'];
    $get_params = explode('&', $get_params);
    $get_params = explode('=', $get_params[0]);
    $order_id = $get_params[1];

    echo '<pre>';
    echo '<p><strong>Получаем идентификатор ордера</strong></p>';
    print_r($order_id);
    echo '</pre>';


    // !Формирование запроса проверки статуса.
    $status_do = 'https://securepayments.sberbank.ru/payment/rest/getOrderStatusExtended.do';
    $name = 'sfu-kras-api';
    $password = 'sfuapi273076';
    $get_status__request = "$status_do?userName=$name&password=$password&orderId=$order_id";

    echo '<pre>';
    echo '<p><strong>Отправляем запрос на проверку сведений об ордере с этим идентификатором</strong></p>';
    print_r($get_status__request);
    echo '</pre>';

    // !Отправка запроса.
    $aa = file_get_contents($get_status__request);

    // !Расшифровка полученного ответа.
    $aa = json_decode($aa, TRUE);

    echo '<pre>';
    echo '<p><strong>Принимаем ответ</strong></p>';
    print_r($aa);
    echo '</pre>';

    // Получение статуса
    $s = $aa['orderStatus'];
    // Получение полей, которые пользователь внес в форму.
    $p = $aa['merchantOrderParams'];
    // А это то я просто прошелся по массиву значений.
    // Но мне их нужно вносить в базу в более структурированном виде.
    // Поэтому придется получать конкретные значения.
    
    
    // Получаем ассоциативный массив переданных полей формы.
    $n = array();
    foreach ($p as $k => $v) {
        $n[$v['name']] = $v['value'];
    }
    
    echo '<pre>';
    echo '<p><strong>Преобразуем данные из полей формы из многоуровневого массива в ассоциативный массив</strong></p>';
    print_r($n);
    echo '</pre>';


    $description 	= $n['Описание'];
    $libnumber 		= $n['Читательский билет'];
    $personal 		= $n['personal'];
    $package 		= $n['Количество проверок'];
    $service 		= $aa['orderDescription'];
    $surname 		= $n['Фамилия читателя'];
    $address 		= $n['Адрес'];
    $dogovor 		= $n['Договор'];
    $hostel 		= $n['Общежитие'];
    $status 		= $n['Статус'];
    $payer 			= $n['Плательщик'];
    $phone 			= $n['Телефон'];
    $event 			= $n['Событие'];
    $email 			= $n['Почта'];
    $cost 			= $aa['paymentAmountInfo']['approvedAmount'] / 100;
    $room 			= $n['Комната'];
    $url 			= $n['URL'];
    $fio 			= $n['ФИО'];
    $org 			= $n['Организация'];
    $order_number = $aa['orderNumber'];
    $order_status = $aa['orderStatus'];


    // echo '<pre>';
    // print_r($n['Фамилия читателя']);
    // echo '</pre>';

    // !Генерация временного пароля
    $all_simb = '0123456789qwertyuiopasdfghjklzxcvbnm';
    $pass = str_shuffle($all_simb);
    $pass = substr($pass, 0, 10);

    echo '<pre>';
    echo '<p><strong>Генерация пароля</strong></p>';
    print_r($pass);
    echo '</pre>';



   


    // Заносим информацию в базу данных
    $link = mysqli_connect("localhost", "graduation", "eex3ge3J", "db_graduation");
    // !Устанавливаем кодировку.
    $link->set_charset("utf8");

 
    $query = "INSERT INTO `transaction`
    -- (
    --     `id`,
    --     `description`,
    --     `libnumber`,
    --     `personal`,
    --     `package`,
    --     `service`,
    --     `surname`,
    --     `address`,
    --     `dogovor`,
    --     `hostel`,
    --     `status`,
    --     `payer`,
    --     `phone`,
    --     `event`,
    --     `email`,
    --     `cost`,
    --     `room`,
    --     `url`,
    --     `fio`,
    --     `org`,
    --     `datetime`
    -- )
    VALUES (
        NULL,
        '$description',
        '$libnumber',
        '$personal',
        '$package',
        '$service',
        '$surname',
        '$address',
        '$dogovor',
        '$hostel',
        '$status',
        '$payer',
        '$phone',
        '$event',
        '$email',
        '$cost',
        '$room',
        '$url',
        '$fio',
        '$org',
        '$order_id',
        '$pass',
        '$order_number',
        '$order_status',
        CURRENT_TIMESTAMP
    )";
    $res = mysqli_query($link, $query);
    echo '<p><strong>Получаем идентификатор занесения в базу данных</strong></p>';
    if ($res) {
        print('Запрос удался');
    } else {
        print('Неудача');
    }
    // Проверки подключения.
    // if (!$link) {
    //     echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    //     echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    //     echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    //     exit;
    // }
    // echo "Соединение с MySQL установлено!" . PHP_EOL;
    // echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;
    //mysqli_close($link);


    // !Вывод информации из базы данных.

    $q = "SELECT * FROM transaction WHERE id = 66";
    $r = mysqli_query($link, $q);
    $b = mysqli_fetch_assoc($r);

    // if ($r) {
    //     print('Запрос удался');
    // } else {
    //     print('Неудача');
    // }

    echo '<pre>';
    echo '<p><strong>Вывод данных</strong></p>';
    print_r($b);
    echo '</pre>';

    // !Отправляем информацию на почту в виде чека
    // $message['subject'] = "Платёж #$pay->pay_id за услуги СФУ получен";
    // $message['body'] = "Получено потверждение от банка об успешном платеже за услуги СФУ ($service[title]) на сумму ${cost}\nИнформация о платеже на сайте СФУ по адресу:\n${link}\n\n---\nУведомление отправлено автоматически сервисом pay.sfu-kras.ru";

    mail("sleshukov@sfu-kras.ru", "Загаловок", $b['password']);

    // !Остановка.
    // TODO Теперь осталось сверить пароль и если он совпадает с указанным в базе то, вывести данные о транзакции в виде чека.
    // ? Как важно прописывать логику в виде слов.








    // !СЦЕНАРИЙ:

    // // !Прочитать URL.
    // // !Взять идентификатор.
    // // !С его помощью сформировать запрос на получение статуса.
    // // !Отправить запрос.
    // // !Получить страницу ответа.
    // // !Прочитать страницу ответа.
    // // !Получить информацию из json о данных пользователя.
    // // Подготовить информацию для занесения в базу данных.
    // // Организовать занесение информации в базу данных.
    // !Прочитать информацию из базы данных.
    // !Вывести ее на страницу.
    // !Отправить ее на почту.
    // !Сообщить о статусе платежа и о том, что информация на почту отправлена.
    





    // Запрос register.do
    /*https://3dsec.sberbank.ru/payment/rest/register.do
    ?userName=sfu-kras-api
    &password=sfu-kras
    &amount=100
    &orderNumber=24
    &returnUrl=https://4pda.ru/2020/07/02/372817/
    &failUrl=https://4pda.ru/2020/07/01/372798/
    &jsonParams={"name":"Фёдор","tel":"+79233349999","dogovor":"18/45/15"}*/

    // Ответ
    /*{"orderId":"b43ab099-cbd9-7216-8270-d0af5e369d04","formUrl":"https://3dsec.sberbank.ru/payment/merchants/sbersafe/payment_ru.html?mdOrder=b43ab099-cbd9-7216-8270-d0af5e369d04"}*/

    // Перенаправление после успеха
    /*https://4pda.ru/2020/07/02/372817/?orderId=b43ab099-cbd9-7216-8270-d0af5e369d04&lang=ru*/





    // Зпрос getOrderStatusExtended.do
    /*https://3dsec.sberbank.ru/payment/rest/getOrderStatusExtended.do
    ?userName=sfu-kras-api
    &password=sfu-kras
    &orderId=b43ab099-cbd9-7216-8270-d0af5e369d04*/

    // Ответ
    /*{
        "errorCode":"0",
        "errorMessage":"Успешно",
        "orderNumber":"24",
        "orderStatus":2,
        "actionCode":0,
        "actionCodeDescription":"",
        "amount":100,
        "currency":"643",
        "date":1593657687324,
        "orderDescription":"",
        "ip":"193.218.138.83",
        "merchantOrderParams":[
            {
                "name":"name",
                "value":"Фёдор"
            },
            {
                "name":"tel",
                "value":" 79233349999"
            },
            {
                "name":"dogovor",
                "value":"18/45/15"
            }
        ],
        "transactionAttributes":[],
        "attributes":[
            {
                "name":"mdOrder",
                "value":"b43ab099-cbd9-7216-8270-d0af5e369d04"
            }
        ],
        "cardAuthInfo":{
            "maskedPan":"411111**1111",
            "expiration":"202412",
            "cardholderName":"CARDHOLDER NAME",
            "approvalCode":"123456",
            "pan":"411111**1111"
        },
        "authDateTime":1593657918094,
        "terminalId":"123456",
        "authRefNum":"987438167428",
        "paymentAmountInfo":{
            "paymentState":"DEPOSITED",
            "approvedAmount":100,
            "depositedAmount":100,
            "refundedAmount":0
        },
        "bankInfo":{
            "bankName":"TEST CARD",
            "bankCountryCode":"RU",
            "bankCountryName":"Россия"
        }
    }*/

    // Коды orderStatus
    // 0 - заказ зарегистрирован, но не оплачен;
    // 1 - предавторизованная сумма удержана (для двухстадийных платежей);
    // 2 - проведена полная авторизация суммы заказа;
    // 3 - авторизация отменена;
    // 4 - по транзакции была проведена операция возврата;
    // 5 - инициирована авторизация через сервер контроля доступа банка-эмитента;
    // 6 - авторизация отклонена.

    // Коды ошибок
    // 0	Обработка запроса прошла без системных ошибок.
    // 5 - Доступ запрещён.
    // 5 - Пользователь должен сменить свой пароль.
    // 5 - [orderId] не задан.
    // 6 - Незарегистрированный orderId.
    // 7 - Системная ошибка.



