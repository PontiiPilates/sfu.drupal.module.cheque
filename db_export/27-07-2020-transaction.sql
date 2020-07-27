-- Adminer 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Порядковый номер записи',
  `description` text NOT NULL COMMENT 'Поле: назначение платежа',
  `libnumber` text NOT NULL COMMENT 'Поле: читательский билет',
  `personal` text NOT NULL COMMENT 'Поле: согласие на обработку данных',
  `package` text NOT NULL COMMENT 'Поле: количество проверок',
  `service` text NOT NULL COMMENT 'Услуга',
  `surname` text NOT NULL COMMENT 'Поле: фамилия читателя',
  `address` text NOT NULL COMMENT 'Поле: адрес',
  `dogovor` text NOT NULL COMMENT 'Поле: номер договора',
  `hostel` text NOT NULL COMMENT 'Поле: номер общежития',
  `status` text NOT NULL COMMENT 'Поле: статус обучающегося',
  `payer` text NOT NULL COMMENT 'Поле: плательщик',
  `phone` text NOT NULL COMMENT 'Поле: номер телефона',
  `event` text NOT NULL COMMENT 'Поле: название мероприятия',
  `email` text NOT NULL COMMENT 'Поле: электронная почта',
  `cost` text NOT NULL COMMENT 'Поле: сумма оплаты',
  `room` text NOT NULL COMMENT 'Поле: комната',
  `url` text NOT NULL COMMENT 'Поле: ссылка на документ',
  `fio` text NOT NULL COMMENT 'Поле: ФИО',
  `org` text NOT NULL COMMENT 'Поле: институт/подразделение',
  `order_id` text NOT NULL COMMENT 'Идентификатор транзакции в системе Сбербанка',
  `password` text NOT NULL COMMENT 'Пароль для доступа к чеку',
  `order_number` text NOT NULL COMMENT 'Номер транзакции, присвоенный модулем',
  `order_status` text NOT NULL COMMENT 'Статус транзакции',
  `datetime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата и время совершения транзакции',
  `mail_send` text NOT NULL COMMENT 'Отметка об отправке сообщения',
  `cheque_link` text NOT NULL COMMENT 'Ссылка на квитанцию',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `transaction` (`id`, `description`, `libnumber`, `personal`, `package`, `service`, `surname`, `address`, `dogovor`, `hostel`, `status`, `payer`, `phone`, `event`, `email`, `cost`, `room`, `url`, `fio`, `org`, `order_id`, `password`, `order_number`, `order_status`, `datetime`, `mail_send`, `cheque_link`) VALUES
(60,	'',	'',	'',	'',	'Плата за общежитие',	'',	'Свободный 76 Г',	'418/20/19',	'20',	'',	'Косинова Полина Андреевна',	'89027685661',	'',	'kosinovapolina26@mail.ru',	'1100',	'715',	'',	'Косинова Полина Андреевна',	'',	'b51cfa9a-6875-7306-b63b-bbac0211d19b',	'1amh75rdpk',	'1595408332',	'оплачено',	'2020-07-24 09:36:11',	'1595554571',	'http://hg.pay/sberbank-cheque?orderNumber=1595408332&password=1amh75rdpk'),
(61,	'',	'',	'',	'',	'Плата за общежитие',	'',	'Пр. Сводный, 76И',	'592619',	'26',	'',	'Горковенко Арина Виктоврона',	' 79135281185',	'',	'arinag1999@mail.ru',	'1100',	'506',	'',	'Горковенко Арина Викторовна',	'',	'e1fc2823-b6c0-79b7-b67a-40900211d19b',	'vj9q40b7w1',	'1595512872',	'оплачено',	'2020-07-24 09:36:49',	'1595554609',	'http://hg.pay/sberbank-cheque?orderNumber=1595512872&password=vj9q40b7w1'),
(62,	'',	'',	'',	'',	'hostels',	'',	'Академгородок 8',	'155/1/17',	'1',	'',	'Игорь Алексеевич Скок',	' 79236682884',	'',	'ISkok.141@yandex.ru',	'270',	'240',	'',	'Игорь Алексеевич Скок',	'',	'18bb34be-0bca-783a-b0de-42e90211d19b',	'1faopvlx4m',	'1592078890',	'оплачено',	'2020-07-24 10:54:36',	'1595559276',	'http://hg.pay/sberbank-cheque?orderNumber=1592078890&password=1faopvlx4m'),
(59,	'',	'',	'',	'',	'Плата за общежитие',	'',	'Борисова 6',	'№131/8/18',	'8',	'',	'Бомбоев Дмитрий Игоревич',	' 7 (968) 148-8806',	'',	'ddraktar2000@gmail.com',	'1500',	'502',	'',	'Бомбоев Дмитрий Игоревич',	'',	'c1159a0a-b8c6-7cd8-ae82-982b0211d19b',	'krhfz41gq3',	'1595413462',	'оплачено',	'2020-07-24 09:35:45',	'1595554545',	'http://hg.pay/sberbank-cheque?orderNumber=1595413462&password=krhfz41gq3'),
(56,	'',	'',	'',	'',	'Оплата общежития.',	'',	'пр. Свободный, 76Ж',	'123',	'1',	'',	'Тест Тестович',	'89233341635',	'',	'zloileshii@gmail.com',	'1',	'123',	'',	'Тест Тестович',	'',	'525606fb-cae8-70b7-a1be-05710211d19b',	'hbxrf83e79',	'1594018660',	'оплачено',	'2020-07-21 15:49:25',	'1595317765',	'http://hg.pay/sberbank-cheque?orderNumber=1594018660&password=hbxrf83e79'),
(57,	'',	'',	'',	'',	'Плата за общежитие',	'',	'пер. Вузовский, 6Д',	'17/29/19',	'29',	'',	'Ситникова Анастасия Станиславовна',	'89232767900',	'',	'Sit-anastasij@mail.ru',	'2000',	'19-07',	'',	'Ситникова Анастасия Станиславовна',	'',	'fa19ace6-e6f1-7eee-8502-36cd0211d19b',	'8m27rg0un3',	'1594022079',	'оплачено',	'2020-07-21 15:52:19',	'1595317939',	'http://hg.pay/sberbank-cheque?orderNumber=1594022079&password=8m27rg0un3'),
(58,	'',	'',	'',	'',	'Плата за общежитие',	'',	'Пр.свободный 76и',	'282/26/19',	'26',	'',	'Антошкин Артём Андреевич',	'79960538490',	'',	'vir.artem20011@gmail.com',	'1200',	'1601',	'',	'Антошкин Артём Андреевич',	'',	'ccadee0c-5807-7987-bdc0-97b00211d19b',	'k9trqzg1j6',	'1595511497',	'оплачено',	'2020-07-24 09:33:58',	'1595554438',	'http://hg.pay/sberbank-cheque?orderNumber=1595511497&password=k9trqzg1j6'),
(63,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'0',	'',	'',	'',	'',	'525606fb-cae8-70b7-a1be-05710211d19b -- or 1+1',	'7tjeo56vxf',	'',	'',	'2020-07-27 09:09:22',	'1595812162',	'http://hg.pay/sberbank-cheque?orderNumber=&password=7tjeo56vxf'),
(64,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'0',	'',	'',	'',	'',	'525606fb-cae8-70b7-a1be-05710211d19b--or 1 1',	'34tkun59dw',	'',	'',	'2020-07-27 09:11:05',	'1595812265',	'http://hg.pay/sberbank-cheque?orderNumber=&password=34tkun59dw'),
(65,	'',	'',	'',	'',	'hostels',	'',	'Железнодорожнико, 13',	'782318',	'23',	'',	'Канзычакова Анастасия Александровна',	'89135438785',	'',	'Kanzychakova1999@bk.ru',	'700',	'914',	'',	'Канзычакова Анастасия Александровна',	'',	'ab55c072-0506-7684-9072-1a910211d19b',	'dkemxt6hiq',	'1592240200',	'оплачено',	'2020-07-27 10:04:48',	'1595815488',	'http://hg.pay/sberbank-cheque?orderNumber=1592240200&password=dkemxt6hiq');

-- 2020-07-27 03:15:22
