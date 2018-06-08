<div class="col-md-4">
    <ul class="list-group">
    <?php
        //iduser = 6;
        $req = $db->prepare("SELECT id, label FROM accounts WHERE iduser = ?");
        $req->execute(array($_SESSION['idUser']));
        var_dump($_SESSION['idUser']);
        while ($result = $req->fetch()) { ?> 
            <li class="list-group-item list-group-item-action"><a href="index.php?accounts=<?php echo $result['id'] ?>"><?php echo $result['label']; ?></a></li>
            <?php
        }
        ?>
        <li><a href="index.php?profileCreate">Create Account</a></li>
    </ul>
</div>