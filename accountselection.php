<ul class="list-group" style="width: 20%;">
  <?php
    $req = $db->query("SELECT label FROM accounts WHERE iduser = 1");
    while ($result = $req->fetch()) { ?> 
        <li class="list-group-item list-group-item-action"><a href="index.php?accunts=<?php echo $result['label'] ?>"><?php echo $result['label']; ?></a></li>
        <?php
    }
    ?>
</ul>