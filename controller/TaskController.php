<?php
require_once ROOT.'\model\task.php';
class TaskController
{
    public function show()
    {
        echo 'TaskContrl Show';
        return true;
    }
    public function update()
    {
        echo 'TaskContrl update';
        return true;
    }
    public function edit($id, $text)
    {
        if($id) {
            Task::edit($id, $text);
            //require_once(ROOT.'/view/task_view.html');
        }
        return true;
    }
    public function delete()
    {
        echo 'TaskContrl Delete';
        return true;
    }
}