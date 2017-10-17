<?php

include(__DIR__ . '/../init.inc.php');

$theTime = strtotime('-7 days');
$db = NewsRaw::getDb();
$db->query('DELETE FROM news WHERE `created_at` < ' . $theTime);
$db->query('DELETE FROM news_info WHERE `time` < ' . $theTime);
$db->query('DELETE FROM news_raw WHERE `time` < ' . $theTime);
