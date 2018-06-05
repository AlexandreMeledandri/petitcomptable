

<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">

      <!--  Ajout de la Navbar  -->
      <?php include_once "nav.php";?>

      <!--  Formulaire de creation de compte  -->
      <form method="post" action="">
        <p>
          <span>Create Your Profile</span>
        <p>
        <input type="text" name="lastname" placeholder="Lastname" /> <br>
        <input type="text" name="firstname" placeholder="Firstname" /> <br>
        <input type="password" name="psw" placeholder="password" /> <br>
         <br>

        <input type="submit" name="createAccount" value="Valider">

      </form>
      <?php

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
      ?>

      <!--  Connection au compte   -->
      <form method="post" action="">
        <p>
          <span>Login</span>
        <p>
        <input type="text" name="lastname" placeholder="Lastname" /> <br>
        <input type="text" name="firstname" placeholder="Firstname" /> <br>
        <input type="password" name="psw" placeholder="password" /> <br>
        <br>
        <input type="submit" name="login" value="login">
      </form>

      <?php
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

        if($req->rowCount() == 1) {
          setcookie("lastname", $lastname, time() + (86400 * 30), "/"); // 86400 = 1 jour
          setcookie("firstname", $firstname, time() + (86400 * 30), "/"); // 86400 = 1 jour
          setcookie("psw", $hash, time() + (86400 * 30), "/"); // 86400 = 1 jour

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
      <!--  Ajout du Footer  -->
      <?php include_once "footer.php"; ?>
    </div>
  </body>
</html>
