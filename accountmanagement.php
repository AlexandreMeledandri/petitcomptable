<?php
include_once "accountselection.php";
if(isset($_GET['profileCreate'])){
    include_once "profilecreate.php";
} else {
    include_once "operations.php";
}