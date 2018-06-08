<?php

if(isset($_GET['deleteAccount'])){
    $req = $db->prepare("DELETE FROM accounts WHERE id = ?");
    $req->execute(array($_GET['deleteAccount']));
}
?>
<div class="col-md-4">
    <ul class="list-group">
    <?php
        //iduser = 6;
        $req = $db->prepare("SELECT id, label FROM accounts WHERE iduser = ?");
        $req->execute(array($_SESSION['idUser']));
        while ($result = $req->fetch()) { ?> 
            <li class="list-group-item list-group-item-action"><div class="row"><p class="col-md-10"><a href="index.php?account=<?php echo $result['id'] ?>"><?php echo $result['label']; ?></a></p><p class="col-md-2"><a href="index.php?deleteAccount=<?php echo $result['id'] ?>">X</a></p></div></li>
            <?php
        }
        ?>
        <li><a href="index.php?profileCreate">Create Account</a></li>
    </ul>
</div>