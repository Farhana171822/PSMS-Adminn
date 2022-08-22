<?php
    require_once('config.php');


    if(isset($_GET['id'])){
        $id =  $_GET['id'];
        }

    //$id = ;

    $stm = $pdo->prepare("DELETE FROM class WHERE id=?");
    $stm->execute(array($id));
    //header('location:index.php?delete=success');


    // $id = $_GET['id'];
    // $stm = $pdo->prepare("DELETE FROM class-routine WHERE id=?");
    // $stm->execute(array($id));
    //header('location:index.php?delete=success');  //delete korar pore home page a move krtsi abr
?>
