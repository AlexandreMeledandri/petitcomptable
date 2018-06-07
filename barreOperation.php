<?php

		function db_connect(){
        try {
          $host = "localhost";
          $dbname = "petitcomptable";
          $user = "root";
          $password = "root";

          $db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password);
          return $db;
        } catch (Exception $e) {
          die('ERREUR : '.$e->getMessage());
        }

      }
      function getMessage(){
        echo 'erreur';
      }
      	$idUser = 6;
		$db = db_connect();
		$category = $db->query("SELECT * FROM category");
		$category = $category->fetchAll(PDO::FETCH_ASSOC);
		$account = $db->prepare("SELECT label, id FROM accounts WHERE iduser = ?");
		$account->execute(array($idUser));
		$account = $account->fetchALL(PDO::FETCH_ASSOC);

	      if(isset($_POST['createOperation'])) {

	      	//var_dump(($_POST));


	    		$req = $db->prepare("INSERT INTO operations (idaccount, date, label, type, mode, amount, category) VALUES(:account, NOW(), :label, (SELECT type FROM category where id = :category), :mode, :amount, :category)");


	    		$req->execute(array(
	          		"account"  	=> $_POST['account'],
	          		"label"  	=> $_POST['label'],
	          		"mode"  	=> $_POST['mode'],
	          		"amount"  	=> $_POST['amount'],
	          		"category"  => $_POST['category']));

     // echo $req->rowCount();
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

					<label for="label">Libéllé : </label>
						       <input type="text" name="label" id="libelle" maxlength="35" />

					<label for="operation">Type opération :</label>
						<SELECT id="type" name="type" >
							<OPTION value="debit">Débiter</OPTION>
							<OPTION value="credit">Créditer</OPTION>
						</SELECT>

						<label for="category">Categories :</label>
						<SELECT id="idCategory" onchange="catChange();return false;" name="category">
							<?php
							foreach($category as $cat){
									var_dump($cat);
									echo '<OPTION value ="'.$cat['id'].'">'.$cat['name'].'</OPTION>';
							}
							?>
						</SELECT>

							<label for="mode">Mode d'opération : </label>
								<input type="radio" name="mode" value='Credit_card'/>Credit card</input>
								<input type="radio" name="mode" value='Cheque'/>Chéque</input>

							</br>

					<label for="montant">Veuillez indiquer le montant de l'opération ?</label>
						       <input type="number" name="amount" id="amount" />

					<label for="account">Veuillez renseignez votre compte : </label>
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