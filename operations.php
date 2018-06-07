<?php
function db_connect(){
    try {
      $host = "localhost";
      $dbname = "petitcon";
      $user = "root";
      $password = "";

      $db = new PDO('mysql:host=localhost;dbname='.$dbname.'', $user, $password);
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
$operations = $query->fetchAll(PDO::FETCH_ASSOC);

$labels = array_keys($operations[0]);

?>
<table class="table">
    <thead>
    <tr>
    <?php
    foreach($labels as $label){
        echo '<th scope="col">';
        echo $label;
        echo '</th>';
    }
    ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $values = array_map(function($value){
        return array_map(function($val){return $val;},$value);
    
    },$operations);
    var_dump($values);
    foreach($operations as $key => $value){
        echo '<tr>';
            foreach($value as $subKey => $subValue) {
                echo "<td>" . $subValue . "</td>";
            }
    
        echo '</tr>';
    }
    ?>
    </tbody>
</table>