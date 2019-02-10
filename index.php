<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
$router = new Router();
$router->run();
if(!isset($_COOKIE['beejee'])) {
    require_once(ROOT.'/view/login_view.html');
}
else{
    require_once (ROOT.'/view/edit_task_view.html');
}
require_once(ROOT.'/view/task_view.html');
?>