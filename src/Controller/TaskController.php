<?php
namespace App\Controller;

use App\Model\TaskManager;

class TaskController extends AbstractController
{

    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $task = array_map('trim', $_POST);
            // TODO validations (length, format...)
            // if validation is ok, insert and redirection
            $taskManager = new TaskManager();
            $id = $taskManager->insert($task);
            header('location:/todo/browse');
        }
        return $this->twig->render('Add/add.html.twig');
    }

    public function browse(): string
    {
        $taskManager = new TaskManager();
        $tasks = $taskManager->selectAll();
        return $this->twig->render('Browse/browse.html.twig', ['tasks' => $tasks]);
    }

    public function show(int $id)
    {
        $taskManager = new TaskManager();
        $task = $taskManager->selectOneById($id);
        return $this->twig->render('Show/show.html.twig', ['task' => $task]);
    }

    public function delete(int $id)
    {
        $id = $_GET['id'];
        $taskManager = new TaskManager();
        $task = $taskManager->delete($id);
        return $this->twig->render('Delete/delete.html.twig');
    }
}