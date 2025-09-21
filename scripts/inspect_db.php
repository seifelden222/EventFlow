<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=event_management_system','root','');
$tables = $pdo->query("SELECT TABLE_NAME, ENGINE, TABLE_COLLATION FROM information_schema.tables WHERE table_schema = DATABASE() AND TABLE_NAME IN ('qizes','questions')")->fetchAll(PDO::FETCH_ASSOC);
print_r($tables);
$cols = $pdo->query("SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA FROM information_schema.columns WHERE table_schema = DATABASE() AND TABLE_NAME = 'qizes'")->fetchAll(PDO::FETCH_ASSOC);
print_r($cols);
$cols2 = $pdo->query("SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA FROM information_schema.columns WHERE table_schema = DATABASE() AND TABLE_NAME = 'questions'")->fetchAll(PDO::FETCH_ASSOC);
print_r($cols2);
$createQizes = $pdo->query("SHOW CREATE TABLE qizes")->fetch(PDO::FETCH_ASSOC);
print_r($createQizes);
$createQuestions = $pdo->query("SHOW CREATE TABLE questions")->fetch(PDO::FETCH_ASSOC);
print_r($createQuestions);
