<?php 

include '../includs/db.inc.php';

if(isset($_GET['comment-id']) && !empty($_GET['comment-id'])){
    $id = $_GET['comment-id'];

    try{
        $sql = "DELETE FROM comment WHERE comment_id='{$id}'";

        $conn->exec($sql);
        echo "Record deleted successfully";
        header('Location: comments.php');
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}