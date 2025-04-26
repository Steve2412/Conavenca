<?php

require_once __DIR__ . '/vendor/autoload.php';

use Ifsnop\Mysqldump as IMysqldump;

try {
    $dump = new IMysqldump\Mysqldump('mysql:host=localhost;dbname=tesis', 'root', '');
    $dump->start('backup/backup.sql');
    $file_url = 'backup/backup.sql';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    readfile($file_url);
} catch (\Exception $e) {
    echo 'mysqldump-php error: ' . $e->getMessage();
}
