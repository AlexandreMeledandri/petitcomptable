<?php
?>
<div class="col-md-8">
    <form method="post" action="">
        <fieldset>
            <label for="label">Label : </label>
            <input type="text" name="label" id="label" maxlength="35" />
            <label for="type">Type : </label>
            <select id="type" name="type">
                <option value="current">Current</option>
                <option value="saving">Savings</option>
                <option value="joint">Joint</option>
            </select>
            <label for="currency">Currency : </label>
            <select id="currency" name="currency">
                <option value="euro">Euro</option>
                <option value="dollar">Dollar</option>
            </select>
            <label for="balance">Initial Balance : </label>
            <input type="text" name="balance" id="balance" maxlength="10" />
            <input type="submit" value="Add account">
    </form>
    <?php 

        $req = $db ->prepare("SELECT COUNT(`iduser`) FROM accounts WHERE iduser = ? ");
        $req -> execute(array($_SESSION['idUser']));
        $result = $req->fetch();

        if($result != 10){
            if(isset($_POST['balance']) && isset($_POST['currency']) && isset($_POST['label']) && isset($_POST['type']))
            {
                $req = $db->prepare("INSERT INTO accounts(iduser, balance, currency, label, type) VALUES(?, ?, ?, ?, ?)");
                $req->execute(array($_SESSION['idUser'], $_POST['balance'], $_POST['currency'], $_POST['label'], $_POST['type']));
                header('location:index.php');
            }          
        }else{echo "accounts > 10";}
    ?>
</div>
