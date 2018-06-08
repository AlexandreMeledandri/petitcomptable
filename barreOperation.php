<?php
      	$idUser = 6;
		$category = $db->query("SELECT * FROM category");
		$category = $category->fetchAll(PDO::FETCH_ASSOC);
		$account = $db->prepare("SELECT label, id FROM accounts WHERE iduser = ?");
		$account->execute(array($idUser));
		$account = $account->fetchALL(PDO::FETCH_ASSOC);

	      if(isset($_POST['createOperation'])) {
	    		$req = $db->prepare("INSERT INTO operations (idaccount, date, label, type, mode, amount, category) VALUES(:account, NOW(), :label, (SELECT type FROM category where id = :category), :mode, :amount, :category)");


	    		$req->execute(array(
	          		"account"  	=> $_POST['account'],
	          		"label"  	=> $_POST['label'],
	          		"mode"  	=> $_POST['mode'],
	          		"amount"  	=> $_POST['amount'],
	          		"category"  => $_POST['category']));
  			}
	?>

<html>
	<head>
		<script src="test.js"></script>
		</head>
		<body>
			<div>
			<form method="post" action="">
				<fieldset>

					<label for="label">Label : </label>
						       <input type="text" name="label" id="libelle" maxlength="35" />

					<label for="operation">Operation type :</label>
						<SELECT id="type" name="type" >
							<OPTION value="debit">Debitr</OPTION>
							<OPTION value="credit">Credit</OPTION>
						</SELECT>

						<label for="category">Category :</label>
						<SELECT id="idCategory" onchange="catChange();return false;" name="category">
							<?php
							foreach($category as $cat){
									var_dump($cat);
									echo '<OPTION value ="'.$cat['id'].'">'.$cat['name'].'</OPTION>';
							}
							?>
						</SELECT>

							<label for="mode">Mode of operation : </label>
								<input type="radio" name="mode" value='Credit_card'/>Credit card</input>
								<input type="radio" name="mode" value='Bank_check'/>Bank_Check</input>

							</br>

					<label for="montant">Please indicate the amount of the transaction :</label>
						       <input type="number" name="amount" id="amount" />

					<label for="account">Please fill in your account : </label>
					<select id='idAccount' name ="account">
						     <?php
							foreach($account as $cmpt){
									var_dump($cmpt);
									echo '<OPTION value ="'.$cmpt['id'].'">'.$cmpt['label'].'</OPTION>';
							}
							?>
					</select>

						       <input type="submit" name="createOperation" value="Valider">

			 	</fieldset>
			</form>
		</div>
	</body>
</html>
