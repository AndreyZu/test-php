<?php


class MyLogger
{
  // Приватное свойство, доступ есть только у MyLogger.
  private $log_file;

  // Сеттер для $log_file, принимает переменную и присваивает её в $log_file
  function __construct($log_file){
    $this->log_file = $log_file;
  }


  // Запись данных в $log_file. Дата + сообщение. PHP_EOL - конец строки. Флаг FILE_APPEND - дописывает $log_file вместо перезаписи.
  function info($message){
    file_put_contents($this->log_file, date('Y-m-d H:i:s').' INFO: '.$message.PHP_EOL, FILE_APPEND);
  }

  // Запись в $log_file ошибки. Дата + сообщение
  function error($message){
    file_put_contents($this->log_file,date('Y-m-d H:i:s').' ERROR: '.$message.PHP_EOL, FILE_APPEND);
  }
}

