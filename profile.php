<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <?php include_once "nav.php"; ?>
    </div>
    <form method="POST" action="">
        <input type="text" name="firstname" placeholder="FirstName" value="
        <?php
        $req = $bdd->query("SELECT * FROM user");
        $result = $req->fetch();
        echo $result['firstname'];
        ?>">
        <input type="text" name="lastname" placeholder="LastName" value="
        <?php
        $req = $bdd->query("SELECT * FROM user");
        $result = $req->fetch();
        $result['lastname'];
        ?>">
        <input type="text" name="psw" placeholder="password" value="
        <?php 
        $req = $bdd->query("SELECT * FROM user");
        $result = $req->fetch();
        $result['psw'];
        ?>">
        <input type="submit" value="Add User !">
    </form>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>