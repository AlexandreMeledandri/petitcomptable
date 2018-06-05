

<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <?php include_once "nav.php";?>
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

        $req = $db->prepare("INSERT INTO user (lastname, firstname, psw) VALUES(:lastname, :firstname, :psw)");
        $req->execute(array(
              "lastname"  => $_POST['lastname'],
              "firstname" => $_POST['firstname'],
              "psw"       => $_POST['psw']));

      echo $req->rowCount();

      }

      function db_connect(){
        try {
          $host = "localhost";
          $dbname = "monpetitcomptable";
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
      ?>

      <?php include_once "footer.php"; ?>
    </div>
  </body>
</html>
