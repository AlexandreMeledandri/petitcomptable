<div class="col-md-4">
    <ul class="list-group">
    <?php
        $req = $db->query("SELECT id, label FROM accounts WHERE iduser = 1");
        while ($result = $req->fetch()) { ?> 
            <li class="list-group-item list-group-item-action"><a href="index.php?accounts=<?php echo $result['id'] ?>"><?php echo $result['label']; ?></a></li>
            <?php
        }
        ?>
    </ul>
</div>