<?php
    include '../includs/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style-admin.css">
    <link rel="stylesheet" href="../css/style-users.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


</head>
<body>
    <div class="wrapper">
<nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li class="arrow"><a href="../includs/admin.php"><i class="fa fa-tachometer"></i><br>Dashboard</a></li>
           <li class="dropdown">
            <a href="addMovie.php" class="dropdown-toggle" ><i class="fa fa-film"  style='color:white'></i><br>Add movie<span class="caret"></span></a>
            
          </li>
          <li class="dropdown">
            <a href="deleteMovie.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"><i class="fa fa-trash" aria-hidden="true"></i><br>Delete movie<span class="caret"></span></a>
            
          </li>
          <li class="dropdown">
            <a href="users.php" class="dropdown-toggle" ><i class="fa fa-user" ></i><br>Registered users<span class="caret"></span></a>
            
          </li>
          <li><a href="comments.php"><i class="fa fa-folder" ></i><br>Comments</a></li>
          <li><a href="#"><i class="bi bi-box-arrow-right" width='100px'></i><br>Log Out</a></li>
        </ul>
     
      </div>
    </div>
  </nav>

  <?php
        if(isset($_GET['updateid'])){

            $idd = $_GET['updateid'];

          $query = "SELECT * FROM movie WHERE id='{$idd}'";  
          $statement = $conn->prepare($query);  
          $statement->execute();  
          $count = $statement->rowCount(); 
          if($count > 0)  {
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              $results = $statement->fetchAll();
              echo '<tbody>';
              foreach($results as $column=>$type){

                $id = $type['id'];
                $img = $type['img'];
                $name = $type ['movie_name'];
                $desc = $type ['descriptions'];
                $year = $type['year'];
                $category = $type['category'];
              }
          }
          }
    ?>

<div class="add">
        
        <form action="" method='POST' enctype="multipart/form-data" class='form'>
        <h3>ADD MOVIE</h3>
            <label for="name_movie">Name: </label>
            <br>
            <input type="text" name='name_movie' value=<?php echo $name;?>>
            <br>
            <label for="image">Photo:</label>
            <input type="file" name='image' value=<?php echo $img;?>>
            <br>
            <label for="desc">Description: </label>
            <br>
            <input type="text" name='desc' value=<?php echo $desc;?>>
            <br>
            <label for="year">Year: </label>
            <br>
            <input type="text" name="year" value=<?php echo $year;?>>
            <br>
            <label for="category">Category: </label>
            <select name="category" id="" value=<?php echo $category;?>>
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="drama">Drama</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Horror">Horror</option>
                <option value="Romace">Romance</option>
            </select>
            <br>
            <input type="hidden" name="idd" value=<?php echo $id; ?>>
            <input type="submit" name='submit' value='Edit movie'>
        </form>
    </div>

    <?php

        if(isset($_POST['submit'])){
            if(!empty($_POST['name_movie']) && !empty($_FILES['image']) && !empty($_POST['desc']) && !empty($_POST['year']) && !empty($_POST['year'])){
            $id = $_POST['idd'];
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

                    $sql= "UPDATE movie SET 
                        movie_name='{$name_movie}', 
                        img='{$filename}', 
                        descriptions='{$desc}', 
                        year='{$year}', 
                        category='{$category}' 
                        WHERE id='{$id}'";
                    $stmt = $conn->prepare($sql);

                    $stmt->execute();

                    //echo a message to say the UPDATE succeeded
                    if($stmt->rowCount()){
                        echo "records UPDATED successfully";
                    }else{
                        echo 'Something went wrong!';
                    }
                    
                    
                }
            }
      }
      }

            
?>
