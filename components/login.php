<?php

define('ROOT', dirname(__FILE__));
//$ttt=ROOT.'\db.php';
//var_dump($ttt);
require_once ROOT.'\db.php';
$db= Db::getConnection();
    try {
        $isset_user = $db->prepare("SELECT users.name from users WHERE users.name=:usr_name 
                                  AND users.password=:password");
        $isset_user->bindParam(':usr_name', $_POST['username'], PDO::PARAM_STR);
        $isset_user->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
        $isset_user->setFetchMode(PDO::FETCH_ASSOC);
        $isset_user->execute();
        $user = $isset_user->fetchColumn();
    }
    catch (Exception $ex){
        $ex->getMessage()."<br>";
    }
if($user=='admin')
{
    $cookie_name='beejee';
    $cookie_value='123';
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    header("Location:../index.php");
}
?>