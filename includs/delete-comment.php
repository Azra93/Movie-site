<?php 

include 'db.inc.php';

if(isset($_GET['comment_id']) && !empty($_GET['comment_id'])){
    $id = $_GET['comment_id'];

    try{
        $sql = "DELETE FROM comment WHERE comment_id='{$id}'";

        $conn->exec($sql);
        echo "Record deleted successfully!";
        
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}