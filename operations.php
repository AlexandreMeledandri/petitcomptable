<?php
$account = 1;

$query = $db->prepare("SELECT * FROM operations WHERE idaccount = ?");
$query->execute(array($account));
$operations = $query->fetchAll(PDO::FETCH_ASSOC);

$labels = array_keys($operations[0]);

?>
<<<<<<< HEAD
<div class="col-md-8">
    <table class="table table-bordered">
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
</div>
=======
<table class="table table-bordered">
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
>>>>>>> 4f873bc34aba4b5ff0fa323bc2c194d5b8ea5f4f
