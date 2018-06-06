
<?php

session_start();

if(isset($_POST['createAccount'])) {
  $db = db_connect();
  $password = $_POST['psw'];
  $hash = hash("sha256", $password . $_POST['lastname']);//Mot de passe crypter

  $req = $db->prepare("INSERT INTO user (lastname, firstname, psw) VALUES(:lastname, :firstname, :psw)");
  $req->execute(array(
        "lastname"  => $_POST['lastname'],
        "firstname" => $_POST['firstname'],
        "psw"       => $hash));

echo $req->rowCount(); //verifie la creation du compte en retournant 1
}

/****** COOKIE *******/
if(isset($_POST['login'])) {
  login($_POST['lastname'], $_POST['firstname'], $_POST['psw']);
}else {
  if(isset($_COOKIE['lastname']) && isset($_COOKIE['firstname']) && isset($_COOKIE['psw'])) {
    echo $_COOKIE['psw'];
    login($_COOKIE['lastname'], $_COOKIE['firstname'], $_COOKIE['psw'], true);
  }
}

function login($lastname, $firstname, $psw, $fromCookie = false) {
  $db = db_connect();

  if($fromCookie == true) {$hash = $psw;}
  else {$hash = hash("sha256", $psw . $_POST['lastname']);}

  $req = $db->prepare("SELECT * FROM user WHERE lastname = :lastname AND firstname = :firstname AND psw = :psw");
  $req->execute(array(
        "lastname"  => $lastname,
        "firstname" => $firstname,
        "psw"       => $hash));
  $dataUser = $req->fetch();

  if($req->rowCount() == 1) {
    setcookie("lastname", $lastname, time() + (86400 * 30), "/"); // 86400 = 1 jour
    setcookie("firstname", $firstname, time() + (86400 * 30), "/"); // 86400 = 1 jour
    setcookie("psw", $hash, time() + (86400 * 30), "/"); // 86400 = 1 jour

    $_SESSION['idUser'] = $dataUser['id'];
    
    header("Location: index.php"); // Lorsque log envoie vers la page Index
  }else {
    echo "Identifiant ou mot de passe incorrect.";

  }
}


/****** Connection à la base de données *******/

function db_connect(){

  try {
    $host = "localhost";
    $dbname = "monpetitcomptable";
    $user = "root";
    $password = "root";

    $db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password);
    return $db;
  }catch (Exception $e) {
    die('ERREUR : '.$e->getMessage());
  }

}
function getMessage(){
  echo 'erreur';
}
?>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <script type="text/javascript" src="public/main.js"></script>
  </head>
  <body>
    <div class="container">

      <!--- BEAU FORMULAIRE --->
      <div class="container">
      	<div class="row">
  			     <div class="col-md-12 col-md-offset-3">
  				    <div class="panel panel-login" style="padding: 15px;">
  					     <div class="panel-heading">
  						      <div class="row">
  							       <div class="col-md-6">
  								        <a href="#" class="active" id="login-form-link">Login</a>
  							       </div>
  							       <div class="col-md-6">
  								        <a href="#" id="register-form-link">Register</a>
  							       </div>
  						      </div>
  						      <hr>
  					     </div>
  					     <div class="panel-body">
  						      <div class="row">
  							       <div class="col-lg-12">
  								       <form id="login-form" action="" method="post" role="form" style="display: block;">
  									         <div class="form-group">
  										          <input type="text" name="lastname" tabindex="1" class="form-control" placeholder="lastname">
  									         </div>
                             <div class="form-group">
  										          <input type="text" name="firstname" tabindex="1" class="form-control" placeholder="firstname">
  									         </div>
  									         <div class="form-group">
  										          <input type="password" name="psw" tabindex="2" class="form-control" placeholder="Password">
  									         </div>
  									         <div class="form-group">
  										          <div class="row">
  											           <div class="col-sm-6 col-sm-offset-3">
  												            <input type="submit" name="login" tabindex="4" class="form-control btn btn-login" value="Log In">
  											           </div>
  										          </div>
  									         </div>
  								       </form>
  								       <form id="register-form" action="" method="post" role="form" style="display: none;">
  									         <div class="form-group">
  										          <input type="text" name="lastname"  tabindex="1" class="form-control" placeholder="lastname">
  									         </div>
  									         <div class="form-group">
  										          <input type="text" name="firstname"  tabindex="1" class="form-control" placeholder="firstname">
  									         </div>
  									         <div class="form-group">
  										          <input type="password" name="psw"  tabindex="2" class="form-control" placeholder="Password">
  									         </div>
  									         <div class="form-group">
  										          <div class="row">
  											           <div class="col-sm-6 col-sm-offset-3">
  												            <input type="submit" name="createAccount" tabindex="4" class="form-control btn btn-register" value="Register Now">
  											           </div>
  										          </div>
  									         </div>
  								        </form>
  							       </div>
  						      </div>
  					     </div>
  				    </div>
  			   </div>
  		  </div>
  	  </div>
    </div>
  </body>
</html>
