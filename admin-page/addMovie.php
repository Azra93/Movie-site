<?php
    include '../includs/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add movie</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style-admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


</head>
<body>
    <div class="wrapper">
        <?php
            require 'admin-header.php';
        ?>
  
    <div class="add">
        
        <form action="" method='POST' enctype="multipart/form-data" class='form'>
        <h3>ADD MOVIE</h3>
            <label for="name_movie">Name: </label>
            <br>
            <input type="text" name='name_movie'>
            <br>
            <label for="image">Photo:</label>
            <input type="file" name='image'>
            <br>
            <label for="desc">Description: </label>
            <br>
            <input type="text" name='desc'>
            <br>
            <label for="year">Year: </label>
            <br>
            <input type="text" name="year">
            <br>
            <label for="category">Category: </label>
            <select name="category" id="">
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="drama">Drama</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Romace">Romance</option>
            </select>
            <br>
            <input type="submit" name='submit' value='Add movie'>
        </form>
    </div>
  </div>
</body>
</html>

<?php

    if(isset($_POST['submit'])){
        if(!empty($_POST['name_movie']) && !empty($_FILES['image']) && !empty($_POST['desc']) && !empty($_POST['year']) && !empty($_POST['year'])){
            $name_movie = $_POST['name_movie'];
            $desc = $_POST['desc'];
            $year = $_POST['year'];
            $category = $_POST['category'];
            $filename = $_FILES['image']['name'];

            $target_dir = '../img/';
            $target_file = $target_dir.basename($_FILES['image']['name']);
	
	        // Select file type
	        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	        // valid file extensions
	        $extensions_arr = array("jpg","jpeg","png","gif");
 
	        // Check extension
	        if( in_array($imageFileType,$extensions_arr) ){
                $new_image_name = uniqid("IMG-", true).'.'. $imageFileType;
 
	        // Upload files and store in database
	        if(move_uploaded_file($_FILES["image"]["tmp_name"],'../img/'.$filename)){

            $sql= "INSERT INTO movie (movie_name, img, descriptions, year, category) VALUES ('{$name_movie}','{$filename}', '{$desc}', '{$year}', '{$category}')";
            $conn->prepare($sql);
                
                if($conn->exec($sql)){
                    echo "Movie added succesfully.";
                }else{
                    echo "Something went wrong!!!";
                }
            }}
        }
    }

?>
