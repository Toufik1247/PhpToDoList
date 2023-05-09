<?php
require('./php/ManagerTask.php');

// Création d'une instance de la class ManagerTask
$managerTask = new ManagerTask();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Code executé en fonction de l'action (ajout, suppression, marqué comme terminée)
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $newTask = new Task();
            $newTask->setTitle($_POST['title']);
            $newTask->setDescription($_POST['description']);
            $newTask->setImportant(isset($_POST['important']) ? 1 : 0);
            $managerTask->create($newTask);
        } elseif ($_POST['action'] == 'delete') {
            $managerTask->remove($_POST['task_id']);
        } elseif ($_POST['action'] == 'complete') {
            $managerTask->complete($_POST['task_id']);
        }
    }
}

// Récupère toutes les tâches présentes dans la bdd
$tasks = $managerTask->getAllTasks();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container main-container">
        <h1 class="my-4">Todo List</h1>

        <h2 class="mb-3">Ajouter une nouvelle tâche</h2>
        <form method="post" action="index.php">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="important" id="important" class="form-check-input">
                <label for="important" class="form-check-label">Important</label>
            </div>
            <input type="submit" value="Ajouter" class="btn btn-primary">
        </form>

        <h2 class="my-4">Liste des tâches</h2>
        <?php
        echo '<ul class="list-group">';
        foreach ($tasks as $task) {
            // Ajoute les classes CSS en fonction du statut de la tâche
            $class = '';
            if ($task->isImportant() && !$task->isCompleted()) {
                $class = ' task-important';
            } elseif (!$task->isImportant() && !$task->isCompleted()) {
                $class = ' task-normal';
            } elseif ($task->isCompleted()) {
                $class = ' task-completed';
            }
            echo '<li class="list-group-item d-flex justify-content-between align-items-center' . $class . '">';
            echo '<span style="' . ($task->isCompleted() ? 'text-decoration: line-through;' : '') . '">' . $task->getTitle() . ' - ' . $task->getDescription() . '</span>';
            echo '<span>';
            echo '<form action="" method="post" class="d-inline">';
            echo '<input type="hidden" name="action" value="complete">';
            echo '<input type="hidden" name="task_id" value="' . $task->getId() . '">';
            echo '<button type="submit" class="btn btn-link btn-sm text-decoration-none">';
            echo '<i class="fas fa-check"></i>';
            echo '</button>';
            echo '</form>';
            echo '<form action="" method="post" class="d-inline">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="task_id" value="' . $task->getId() . '">';
            echo '<button type="submit" class="btn btn-link btn-sm text-decoration-none">';
            echo '<i class="fas fa-trash-alt"></i>';
            echo '</button>' . '</form>' . '</span>' . '</li>';
        }
        echo '</ul>';
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>