<?php
require ROOT.'\components\db.php';

class Task
{
    public static function  view()
    {
        $db= Db::getConnection();
            $select_all_task = $db->query("SELECT * from task");
            $select_all_task->setFetchMode(PDO::FETCH_ASSOC);
            $task = $select_all_task->fetchAll();
        return $task;
    }
    public static function  edit($id, $text)
    {
        $a_id = explode(",", $id);
        $a_text=explode(",",$text);
            $db = Db::getConnection();
            for($i=0; $i<count($a_text);  $i++) {

                try {
                    $insert_task = $db->prepare("INSERT INTO `beejee`.`task` (`text`, `email`, `name`) VALUES (:id, 'eu.elit@massaMauris.org', :text)");
                    $insert_task->bindParam(':id', $a_id[$i], PDO::PARAM_STR);
                    $insert_task->bindParam(':text', $a_text[$i], PDO::PARAM_STR);
                    $insert_task->execute();
                } catch (Exception $ex) {
                    $ex->getMessage() . "<br>";
                }
            }

        return true;
    }
}
?>