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


-- 2020-07-16 08:03:39
