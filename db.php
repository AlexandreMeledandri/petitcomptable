<?php
function db_connect(){
    try {
      $host = "localhost";
      $dbname = "petitcon";
      $user = "root";
      $password = "root";

      $db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password);
      return $db;
    } catch (Exception $e) {
      die('ERREUR : '.$e->getMessage());
    }

  }
  function getMessage(){
    echo 'erreur';
}
$db = db_connect();