<?php
    // Подключение файла с доступами.
    require('access.php');

    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $service = $_POST['service'];
    $data_payer = $_POST['data_payer'];
    $contract_number = $_POST['contract_number'];
?>

<form action="" method="POST">
    <div class="form-item">
        <label for="date_start">Выбериете начало периода <span class="form-required" title="Обязательное поле">*</span></label>
        <div class="container-inline">
            <input type="date" name="date_start" id="date_start" required value="<?php if($date_start) {print $date_start; } ?>">
        </div>
    </div>
    <div class="form-item">
        <label for="date_end">Выберите окончание периода <span class="form-required" title="Обязательное поле">*</span></label>
        <div class="container-inline">
            <input type="date" name="date_end" id="date_end" required value="<?php if($date_end) {print $date_end;} ?>">
        </div>
    </div>
    <div class="form-item">
        <label for="service">Выберите услугу <span class="form-required" title="Обязательное поле">*</span></label>
        <div class="container-inline">
            <select name="service" class="form-select" id="service" required>

                <?php
                    $services = _db_query_output_all($connect, "SELECT DISTINCT `service` FROM `transaction`");
                    $options = array();
                    foreach ($services as $v) {
                        foreach ($v as $mv) {
                ?>
                <option value="<?php print $options[] = $mv; ?>"><?php print $options[] = $mv; ?></option>
                <?php
                        }
                    }
                ?>

            </select>
        </div>
    </div>
    <div class="form-item">
        <label for="data_payer">Поиск по ФИО плательщика</label>
        <div class="container-inline">
            <input type="text" name="data_payer" id="data_payer" value="<?php if($data_payer) {print $data_payer;} ?>">
        </div>
    </div>
    <div class="form-item">
        <label for="contract_number">Поиск по номеру договора</label>
        <div class="container-inline">
            <input type="text" name="contract_number" id="contract_number" value="<?php if($contract_number) {print $contract_number;} ?>">
        </div>
    </div>
    <div class="form-item">
        <input type="submit" value="Найти">
    </div>
    <!-- <div class="form-item">
        <div class="description">Поиск осуществляется по вхождению подстроки в строку</div>
        <div class="description">Например поиск по "<b>Иван</b>" вернет записи:</div>
        <div class="description">&emsp;&middot; Куликов Андрей <b>Иван</b>ович</div>
        <div class="description">&emsp;&middot; Мирошниченко <b>Иван</b> Александрович</div>
    </div> -->
</form>

<?php
$date_start = strtotime($_POST['date_start']);
$date_end = strtotime($_POST['date_end']);

if (!$data_payer && !$contract_number) {
    $output = _db_query_output_all($connect, "SELECT * FROM `transaction` WHERE `order_number` BETWEEN '$date_start' AND '$date_end' AND `service` = '$service'");
}
if ($data_payer && !$contract_number) {
    $output = _db_query_output_all($connect, "SELECT * FROM `transaction` WHERE `order_number` BETWEEN '$date_start' AND '$date_end' AND `service` = '$service' AND `payer` LIKE '%$data_payer%'");
}
if (!$data_payer && $contract_number) {
    $output = _db_query_output_all($connect, "SELECT * FROM `transaction` WHERE `order_number` BETWEEN '$date_start' AND '$date_end' AND `service` = '$service' AND `dogovor` LIKE '%$contract_number%'");
}
if ($data_payer && $contract_number) {
    $output = _db_query_output_all($connect, "SELECT * FROM `transaction` WHERE `order_number` BETWEEN '$date_start' AND '$date_end' AND `service` = '$service' AND `dogovor` LIKE '%$contract_number%' AND `payer` LIKE '%$data_payer%'");
}
?>


<table class="no-sticky table stickey-enabled sticky-table">
    
    <thead class="tableHeader-processed">
        <tr class="heading">
            <th>Ссылка на чек</th>
            <th>Дата и время совершения транзакции</th>
            <th>Услуга</th>
            <th>Сумма транзакции</th>
            <th>Подробности платежа</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            $num = 1;
            $zebra = 'even';
            foreach($output as $k){
                if(($num % 2) == 0) {
                    $zebra = 'odd';
                } else {
                    $zebra = 'even';
                }
                $num++;
        ?>
            <tr class="<?php print $zebra; ?>">
                <td class="active">
                    <a href="<?php print $k['cheque_link']; ?>">Перейти</a>
                </td>
                <td>
                    <?php print date('d-m-Y', $k['order_number']); ?>
                    <br>
                    <?php print date('H:i', $k['order_number']); ?>
                </td>
                <td>
                    <?php print $k['service']; ?>
                </td>
                <td>
                    <?php print $k['cost'] . ' руб.'; ?>
                </td>
                <td>
                    <?php
                        if($k['payer']){print 'ФИО плательщика: ' . $k['payer'] . '<br>';};
                        if($k['phone']){print 'Телефон: ' . $k['phone'] . '<br>';};
                        if($k['email']){print 'E-mail: ' . $k['email'] . '<br>';};
                        if($k['dogovor']){print 'Номер договора: ' . $k['dogovor'] . '<br>';};
                        if($k['address']){print 'Адрес: ' . $k['address'] . '<br>';};
                    ?>
                </td>
            </tr>
            
        <?php
            }
        ?>
    </tbody>

</table>






<?php
    // ! Было полезно:
    // ?выбор уникальных значений колонки
    // "SELECT DISTINCT `service` FROM `transaction`"
    // ?осуществляет поиск в диапазоне
    // "SELECT * FROM transaction WHERE order_number BETWEEN 1594022000 AND 1594022080"
    // ?осуществляет поиск по вхождению подстроки
    // "SELECT * FROM transaction WHERE payer LIKE '%Тес%'"
    // ?возвращает дату в формате метки времени
    // strtotime()
    // ?возвращает все найденные записи в виде ассоциативного массива
    // mysqli_fetch_all($res, MYSQLI_ASSOC)
?>