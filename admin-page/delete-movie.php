<?php

include '../includs/db.inc.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    try{
        $sql = "DELETE FROM movie WHERE id='{$id}'";

        $conn->exec($sql);
        echo "Record deleted successfully";
        header('Location: deleteMovie.php');
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}