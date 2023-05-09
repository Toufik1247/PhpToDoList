-- Débute le script
START TRANSACTION;
-- Supprime la bdd si elle existe, idéal pour repartir de 0
DROP DATABASE IF EXISTS todo_list;
-- Crée la bdd
CREATE DATABASE IF NOT EXISTS todo_list;
-- Sélectionne la bdd
USE todo_list;
-- Créez la table `tasks`
CREATE TABLE tasks (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(150) NOT NULL,
    important BOOLEAN NOT NULL DEFAULT FALSE,
    completed BOOLEAN NOT NULL DEFAULT FALSE
);
-- Insérez des données de test
INSERT INTO tasks (title, description, important)
VALUES (
        'Acheter un 2ème écran',
        'Acheter un 2ème écran pour devenir full stack',
        FALSE
    ),
    (
        'Réunion avec le client',
        'Réunion avec le client pour discuter du projet',
        FALSE
    ),
    (
        'Garagiste',
        'Appeler le garagiste pour faire un devis',
        TRUE
    ),
    (
        'Appeler le médecin',
        'Prendre rendez-vous avec le médecin pour un contrôle',
        TRUE
    );
-- Termine le Script
COMMIT;