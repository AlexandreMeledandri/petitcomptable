<?php
if(isset($_GET['delete'])){
    $req = $db->prepare("DELETE FROM operations WHERE id = ? AND idaccount = ?");
    $req->execute(array($_GET['delete'],$account));
}

$query = $db->prepare("SELECT * FROM operations WHERE idaccount = ?");
$query->execute(array($account));
$operations = $query->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
if(!empty($operations)){
    $labels = array_keys($operations[0]);
}

?>
<div class="col-md-8">
    <table class="table table-bordered">
        <thead>
        <tr>
        <?php
        
        foreach($labels as $label){
            if($label != "id" && $label != "idaccount") {
                echo '<th scope="col">';
                echo $label;
                echo '</th>';
            }
        }
        ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($operations as $key => $value){
            echo '<tr>';
                foreach($value as $subKey => $subValue) {
                    if($subKey == "id"){$idOperation = $subValue;}

                    if($subKey != "id" && $subKey != "idaccount") {echo "<td>" . $subValue . "</td>";}
                }
                echo '<td><a href="index.php?delete=' . $idOperation . '">Supprimer</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
