<html>
    <head>
    </head>
    <body>
        <div class="container">
            <?php include_once "nav.php"; ?>
            <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <input name="name" type="text" />
                <input type="submit" name="createAccount" />
            </form>
            <?php include_once "footer.php"; ?>
        </div>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>

<?php

if(isset($_POST['createAccount'])){
    var_dump($_POST['name']);
}