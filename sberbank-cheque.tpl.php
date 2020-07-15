<?php
	$current_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<p>
	<?php 
		if ($res['service']) {print '<h3>' . $res['service'] . '</h3>';};
		if ($res['order_status']) {print 'Статус транзакции: ' . '<b>' . $res['order_status'] . '</b>' . '<br>';};
		if ($res['dogovor']) {print 'Номер договора: ' . $res['dogovor'] . '<br>';};
		if ($res['cost']) {print 'Сумма оплаты: ' . $res['cost'] . ' руб.<br>';};
		if ($res['order_number']) {print 'Номер транзакции, присвоенный сервисом: ' . $res['order_number'] . '<br>';};
		if ($res['datetime']) {print 'Дата и время совершения транзакции: ' . date('d-m-Y г. — H:i', $res['order_number']) . '<br>';};
	?>

</p>

<h3>Сведения о плательщике</h3>
<p>
	<?php
		// Personal.
		if ($res['payer']) {print 'Плательщик: ' . $res['payer'] . '<br>';};
		if ($res['fio']) {print 'ФИО: ' . $res['fio'] . '<br>';};
		if ($res['phone']) {print 'Номер телефона: ' . $res['phone'] . '<br>';};
		if ($res['email']) {print 'Электронная почта: ' . $res['email'] . '<br>';};
		// Hostel.
		if ($res['address']) {print 'Адрес: ' . $res['address'] . '<br>';};
		if ($res['hostel']) {print 'Номер общежития: ' . $res['hostel'] . '<br>';};
		if ($res['room']) {print 'Комната: ' . $res['room'] . '<br>';};
		// Librarie.
		if ($res['url']) {print 'Ссылка на документ: ' . $res['url'] . '<br>';};
		if ($res['surname']) {print 'Фамилия читателя: ' . $res['surname'] . '<br>';};
		if ($res['libnumber']) {print 'Читательский билет: ' . $res['libnumber'] . '<br>';};
		if ($res['package']) {print 'Количество проверок: ' . $res['package'] . '<br>';};
		// Education.
		if ($res['org']) {print 'Институт / подразделение: ' . $res['org'] . '<br>';};
		if ($res['status']) {print 'Статус обучающегося: ' . $res['status'] . '<br>';};
		// Other.
		if ($res['event']) {print 'Название мероприятия: ' . $res['event'] . '<br>';};
		if ($res['description']) {print 'Назначение платежа: ' . $res['description'] . '<br>';};
		// Help.
		//if ($res['order_id']) {print 'Идентификатор транзакции в системе Сбербанка: ' . $res['order_id'] . '<br>';};
		//if ($res['password']) {print 'Пароль для доступа к чеку: ' . $res['password'] . '<br>';};
	?>
</p>

<h3>Получатель платежа</h3>
<p>
	ФГАОУ ВО «Сибирский федеральный университет»<br/>
	Юридический адрес: Российская Федерация, 660041, г.&nbsp;Красноярск, пр.&nbsp;Свободный,&nbsp;79<br/>
	ИНН: 2463011853, КПП: 246301001<br/>
	Расчётный счёт: 40503810000340000002, Ф-л банка ГПБ (АО) «Восточно-Сибирский» г. Красноярск (БИК 040407877, кор. счёт 30101810100000000877)
</p>


<div>
	<img src="http://chart.apis.google.com/chart?choe=UTF-8&chld=H&cht=qr&chs=200x200&chl=<?php print $current_url; ?>">
</div>

<p>Ссылка на эту квитанцию: <a href="<?php print $current_url; ?>"><?php print $current_url; ?></a>