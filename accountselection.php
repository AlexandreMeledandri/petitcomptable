<div class="col-md-4">
    <ul class="list-group">
    <?php
        $req = $db->prepare("SELECT id, label FROM accounts WHERE iduser = ?");
        $req->execute(array($_SESSION['idUser']));
        while ($result = $req->fetch()) { ?> 
            <li class="list-group-item list-group-item-action"><div class="row"><p class="col-md-10"><a href="index.php?accounts=<?php echo $result['id'] ?>"><?php echo $result['label']; ?></a></p><p class="col-md-2"><a href="index.php?deleteAccount=<?php echo $result['id'] ?>">X</a></p></div></li>
            <?php
        }
        ?>
        <li><a href="index.php?profileCreate">Create Account</a></li>
    </ul>
</div>

<?php

if(isset($_GET['deleteAccount'])){
    var_dump($_GET['deleteAccount']);
    $req = $db->prepare("DELETE FROM accounts WHERE id = ?");
    $req->execute(array($_GET['deleteAccount']));
}