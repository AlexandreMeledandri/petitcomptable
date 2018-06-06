<?php
function db_connect(){
    try {
      $host = "localhost";
      $dbname = "petitcomptable";
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
$account = 1;

$query = $db->prepare("SELECT * FROM operations WHERE idaccount = ?");
$query->execute(array($account));
$operations = $query->fetch(PDO::FETCH_ASSOC);
var_dump($operations);

?>
<table class="table">
    <thead>
    <tr>
    <?php
    foreach($operations as $key => $value){
        echo '<th scope="col">';
        echo $key;
        echo '</th>';
    }
    ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($operations as $key => $value){
        echo '<tr>';
        echo '<th>';
        echo $value;
        echo '</th>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>