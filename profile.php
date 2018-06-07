<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $req = $bd->prepare("UPDATE user SET firstname = ?, lastname = ? WHERE id = 2");
        $req->execute(array($_POST['firstname'], $_POST['lastname']));
    }
    if(!empty($_POST['psw'])){
        $req = $bd->prepare("UPDATE user SET psw = ? WHERE id = 2");
        $req->execute(array($_POST['psw']));
    }
    $req = $bd->query("SELECT * FROM user WHERE id = 2");
    $result = $req->fetch();
    ?>
    <div>
    <form method="POST" action="">
        <input type="text" name="firstname" placeholder="firstname" value="<?php echo $result['firstname']; ?>">
        <input type="text" name="lastname" placeholder="lastname" value="<?php echo $result['lastname']; ?>">
        <input type="text" name="psw" value="" placeholder="password">
        <input type="submit" value="Add modif">
    </form>
    </div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>