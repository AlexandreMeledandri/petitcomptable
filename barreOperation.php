<?php
if(isset($_GET['account'])){
    $query = $db->prepare("SELECT id FROM accounts WHERE iduser = ? AND id = ?");
    $query->execute(array($_SESSION['idUser'],$_GET['account']));
    $account = $query->fetch();
    $account = $account['id'];
} else {
    $query = $db->prepare("SELECT id FROM accounts WHERE iduser = ?");
    $query->execute(array($_SESSION['idUser']));
    $account = $query->fetch();
    $account = $account['id'];
}
		$category = $db->query("SELECT * FROM category");
		$category = $category->fetchAll(PDO::FETCH_ASSOC);

	      if(isset($_POST['createOperation'])) {
	    		$req = $db->prepare("INSERT INTO operations (idaccount, date, label, mode, amount, category) VALUES(:account, NOW(), :label, :mode, :amount, :category)");


	    		$req->execute(array(
	          		"account"  	=> $account,
	          		"label"  	=> $_POST['label'],
	          		"mode"  	=> $_POST['mode'],
	          		"amount"  	=> $_POST['amount'],
	          		"category"  => $_POST['category']));
			  }
	?>
<div class="row">
<form method="post" action="">
	<fieldset>

		<label for="label">Label : </label>
					<input type="text" name="label" id="libelle" maxlength="35" />

		<label for="operation">Operation type :</label>
			<SELECT id="type" name="type" >
				<OPTION value="debit">Debit</OPTION>
				<OPTION value="credit">Credit</OPTION>
			</SELECT>

			<label for="category">Category :</label>
			<SELECT id="idCategory" onchange="catChange();return false;" name="category">
				<?php
				foreach($category as $cat){
						echo '<OPTION value ="'.$cat['id'].'">'.$cat['name'].'</OPTION>';
				}
				?>
			</SELECT>

				<label for="mode">Mode of operation : </label>
					<input type="radio" name="mode" value='Credit_card'/>Credit card</input>
					<input type="radio" name="mode" value='Bank_check'/>Bank_Check</input>

				</br>

		<label for="montant">Please indicate the amount of the transaction :</label>
					<input type="number" step="0.01" name="amount" id="amount" />	

					<input type="submit" name="createOperation" value="Valider">

	</fieldset>
</form>
</div>
