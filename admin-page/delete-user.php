<?php

include '../includs/db.inc.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    try{
        $sql = "DELETE FROM user WHERE id='{$id}'";

        $conn->exec($sql);
        echo "Record deleted successfully";
        header('Location: users.php');
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}