<?php

require('./php/DBManager.php');
require('./php/Task.php');

class ManagerTask extends DBManager
{
    // Méthode pour récupérer toutes les tâches de la base de données et les stocker dans un tableau
    public function getAllTasks()
    {
        $res = $this->getConnexion()->query('SELECT * FROM tasks');

        $tasks = [];

        foreach ($res as $task) {
            $newTask = new Task;
            $newTask->setId($task['id']);
            $newTask->setTitle($task['title']);
            $newTask->setDescription($task['description']);
            $newTask->setImportant($task['important']);
            $newTask->setCompleted($task['completed']);

            $tasks[] = $newTask;
        }

        return $tasks;
    }

    // Méthode pour créer une nouvelle tâche dans la base de données
    public function create($task)
    {
        $request = 'INSERT INTO tasks(title, description, important) VALUES (?, ?, ?)';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([
            $task->getTitle(), $task->getDescription(), $task->isImportant()
        ]);
        header('Refresh:0');
        return true;
    }

    // Méthode pour supprimer une tâche dans la base de données
    public function remove($id)
    {
        $request = 'DELETE FROM tasks WHERE id = ?';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$id]);
        header('Refresh:0');
        return true;
    }

    // Méthode pour définir une tâche comme terminée
    public function complete($id)
    {
        $request = 'UPDATE tasks SET completed = NOT completed WHERE id = ?';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$id]);
        header('Refresh:0');
        return true;
    }

}