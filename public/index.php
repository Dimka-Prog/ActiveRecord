<?php

    use MySql\ActiveRecord;
    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;
    use Subdirectory\subClass1;

    require_once dirname(__DIR__) . '/vendor/autoload.php';

    $loader = new FilesystemLoader(__DIR__ . '/template');
    $twig = new Environment($loader);

    $userTable = new subClass1();

    $actRecord = new ActiveRecord();
    $arrUsers = $actRecord->read();

//    $actRecord->id = 2;
//    $arrUsers = $actRecord->searchByID();

//    $actRecord->chatUser = "dima";
//    $arrUsers = $actRecord->searchByValue();

//    $actRecord->id = 1;
//    $arrUsers = $actRecord->delete();

    try {
        echo $twig->render('table.twig', [
            'infoUsers' => $userTable,
            'arrUsers' => $arrUsers,
        ]);
    } catch (Exception $exception) {
        die ('ERROR: ' . $exception->getMessage());
    }






