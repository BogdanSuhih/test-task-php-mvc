<?php

namespace Project\Controllers;

use Project\Controllers\AbstractController;
use Project\Services\Db;

class MainController extends AbstractController
{
    public function main()
    {
        if (!$this->user) {
            $this->view->renderTemplate('main/main.php', ['title'=>'Main Page']);
            return;
        }

        $this->view->renderTemplate(
            'main/main.php',
            ['title'=>'Main Page', 'user' => $this->user]
        );
    }

    public function install()
    {
        $db = Db::getInstanse();
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];

        $usersTable = "CREATE TABLE `".$dbOptions['dbname']."`.`users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT ,
            `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `role` ENUM('boss','manager','performer') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'performer',
            `password_hash` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `auth_token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
        PRIMARY KEY  (`id`),
        UNIQUE  `email` (`email`))
        ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $recordsTable = "CREATE TABLE `".$dbOptions['dbname']."`.`records` (
            `id` INT(11) NOT NULL AUTO_INCREMENT ,
            `user_id` int(11) NOT NULL ,
            `title` VARCHAR(255) NOT NULL ,
            `body` TEXT NOT NULL ,
            `user_role` ENUM('boss','manager','performer') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `button` ENUM('boss','manager','performer') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
        PRIMARY KEY  (`id`))
        ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $db->query($usersTable);
        $db->query($recordsTable);
        header('Location: index.php', true, 302);
        exit();
    }
}
