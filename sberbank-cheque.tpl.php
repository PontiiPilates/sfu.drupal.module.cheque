<?php
	// Подключение файла с доступами.
	require('access.php');
	
	// Таймшамп, присвоенный транзакции.
	$order_number = $_GET['orderNumber'];
	// Пароль, писвоенный транзакции.
	$password = $_GET['password'];
	// Ссылка на чек для занесения в базу данных.
	$link_cheque = $url_prefix . $_SERVER['REQUEST_URI'];
	
	// Вывод информации из базы данных.
	$output = _db_query_output($connect, "SELECT * FROM $table_name WHERE `order_number` = '$order_number' AND `password` = '$password'");
	$order_id = $output['order_id'];
	?>

<p>
	<?php
		if ($output['service']) {print '<h3>' . $output['service'] . '</h3>';};
		if ($output['order_status']) {print 'Статус транзакции: ' . '<b>' . $output['order_status'] . '</b>' . '<br>';};
		if ($output['dogovor']) {print 'Номер договора: ' . $output['dogovor'] . '<br>';};
		if ($output['cost']) {print 'Сумма оплаты: ' . $output['cost'] . ' руб.<br>';};
		if ($output['order_number']) {print 'Номер транзакции, присвоенный сервисом: ' . $output['order_number'] . '<br>';};
		if ($output['datetime']) {print 'Дата и время совершения транзакции: ' . date('d-m-Y г. — H:i', $output['order_number']) . '<br>';};
		if ($output['mail_send']) {print 'Сообщение со ссылкой отправлено на почту: ' . date('d-m-Y г. — H:i', $output['mail_send']) . '<br>';};
	?>
</p>

<h3>Сведения о плательщике</h3>
<p>
	<?php
	// Personal.
	if ($output['payer']) {print 'Плательщик: ' . $output['payer'] . '<br>';};
	if ($output['fio']) {print 'ФИО: ' . $output['fio'] . '<br>';};
	if ($output['phone']) {print 'Номер телефона: ' . $output['phone'] . '<br>';};
	if ($output['email']) {print 'Электронная почта: ' . $output['email'] . '<br>';};
	// Hostel.
	if ($output['address']) {print 'Адрес: ' . $output['address'] . '<br>';};
	if ($output['hostel']) {print 'Номер общежития: ' . $output['hostel'] . '<br>';};
	if ($output['room']) {print 'Комната: ' . $output['room'] . '<br>';};
	// Librarie.
	if ($output['url']) {print 'Ссылка на документ: ' . $output['url'] . '<br>';};
	if ($output['surname']) {print 'Фамилия читателя: ' . $output['surname'] . '<br>';};
	if ($output['libnumber']) {print 'Читательский билет: ' . $output['libnumber'] . '<br>';};
	if ($output['package']) {print 'Количество проверок: ' . $output['package'] . '<br>';};
	// Education.
	if ($output['org']) {print 'Институт / подразделение: ' . $output['org'] . '<br>';};
	if ($output['status']) {print 'Статус обучающегося: ' . $output['status'] . '<br>';};
	// Other.
	if ($output['event']) {print 'Название мероприятия: ' . $output['event'] . '<br>';};
	if ($output['description']) {print 'Назначение платежа: ' . $output['description'] . '<br>';};
	// Help.
	//if ($output['order_id']) {print 'Идентификатор транзакции в системе Сбербанка: ' . $output['order_id'] . '<br>';};
	//if ($output['password']) {print 'Пароль для доступа к чеку: ' . $output['password'] . '<br>';};
	?>
</p>

<h3>Получатель платежа</h3>
<p>
	ФГАОУ ВО «Сибирский федеральный университет»<br />
	Юридический адрес: Российская Федерация, 660041, г.&nbsp;Красноярск, пр.&nbsp;Свободный,&nbsp;79<br />
	ИНН: 2463011853, КПП: 246301001<br />
	Расчётный счёт: 40503810000340000002, Ф-л банка ГПБ (АО) «Восточно-Сибирский» г. Красноярск (БИК 040407877, кор. счёт 30101810100000000877)
</p>

<div>
	<img src='http://chart.apis.google.com/chart?choe=UTF-8&chld=H&cht=qr&chs=200x200&chl=<?php print "$url_prefix/transaction-success?orderId=$order_id"; ?>'>
</div>

<p>Ссылка на эту квитанцию: <a href="<?php print $link_cheque; ?>"><?php print $link_cheque; ?></a>