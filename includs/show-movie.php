<?php
session_start();
include 'db.inc.php';


$_SESSION['movie_id'] = $_GET['id'];
$movie_id = $_GET['id'];

if (isset($_POST['save'])) {
    $uID = $_SESSION['id'];
    $ratedIndex =$_POST['ratedIndex'];
    $ratedIndex;
    $ratedIndex++;

    if ($uID === 0) {
        $sql="INSERT INTO stars (rateIndex, user_id, movie_id) VALUES ('{$ratedIndex}', '{$uID}', '{$movie_id}')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $sql = $conn->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $uID = $uData['id'];
    } else
        $conn->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$uID'");

    exit(json_encode(array('id' => $uID)));
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <link rel="stylesheet" href="../css/style-movie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="wrapper">
        <div class="header">
        <div class='logo'><a href="#">
                <img src="../img/logo.png" width='150px' height='100px' margin-top='20px'>
            </a></div>
            <nav>
                <ul>
                    <li><a href="user.php">Home</a></li>
                    <li><div class="dropdown">
                        <a class="dropbtn">Category's <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="#">Action</a>
                            <a href="#">Comdey</a>
                            <a href="#">Romance</a>
                            <a href="#">Drama</a>
                            <a href="#">Fanatasy</a>
                            <a href="#">Horror</a>
                        </div>
                    </div></li>
                    <!--<li><a href="#">List of movies</a></li>-->
                    <li><input type="search" placeholder="Search..."></li>
                    <li><i class="fa fa-search"></i></li>
                </ul>
            </nav>
            <a href="logout.php"><button>Log Out</button></a>
        </div>
    <div id="main">
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            
                $query = "SELECT * FROM movie WHERE id='{$id}'";  
                $statement = $conn->prepare($query);  
                $statement->execute();  
                $count = $statement->rowCount(); 
                if($count > 0)  {
                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $results = $statement->fetchAll();
                    foreach($results as $column=>$type){
                    
        ?>
        <div id='movie'>
            <div class="img">
                <img src="../img/<?php echo $type['img']; ?>" width='500' height='700px' style='border-radius: 40px'>
            </div>
            <div class="desc">
                <h1 style='color:white'><?php echo $type['movie_name'];?></h1>
                <h4 style='color:white'><?php echo $type['year'];?></h4>
                <p style='color:white'><?php echo $type['descriptions'];?></p>
                <div class="stars" >
                    <?php
                $query = "SELECT ROUND(AVG(user_rating) ) AS rating FROM comment WHERE movie_id='{$id}'";  
                $statement = $conn->prepare($query);  
                $statement->execute(); 
                if($count > 0)  {
                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $results = $statement->fetchAll();
                    foreach($results as $column=>$type){
                ?>
                    <h3 style="color:yellow">Average rating: <?php echo $type['rating']; }}?> </h3>
                    <?php
                        for($i=0; $i< $type['rating']; $i++){
                            echo '<i class="fa fa-star fa-2x" style="color:yellow"></i>';
                        }
                    ?>
                    
                </div>
            </div>
            <?php
                    }
                }
            }
            ?>
        </div>
        
        <div class="col-sm-4 text-center">
            
        </div>
        
        <div class="comment">
            <h2>Did you like this movie?</h2>
                <h5 >Leave your Comment & Review Here</h5>
                <button type="button" name="add_review" id="add_review" >Comment & Review</button>
        </div>

        <?php 
                      
            $sql = $conn->prepare("SELECT user.username, comment.comment_id, comment.comment, comment.user_rating, comment.user_id,comment.movie_id, movie.id FROM comment JOIN user ON comment.user_id=user.id JOIN movie ON comment.movie_id = movie.id");
            $sql->execute();
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $results = $sql->fetchAll();           
       
            foreach($results as $column=>$value){
                if($movie_id == $value['movie_id']){
                    echo '<div class="show-comment">';
                    echo "<h3 style='color:blcak'>".$value['username']."</h3>";
                    echo "<p style='color:white'>".$value['comment']."</p>";
                        for($i=0; $i<$value['user_rating']; $i++){
                            echo'<i class="fas fa-star star-light submit_star mr-1" style="color:yellow"></i>';
                        }
                        echo '<br>';
                        if($_SESSION['id'] == $value['user_id']){
                            echo '<a href="delete-comment.php?comment_id='.$value['comment_id'].'">Delete</a>';
                            echo '<br>';
                       
                        }
                        
            
    ?>
    </div>
    <?php
    }}
    ?>
   
    </div>

</body>
</html>
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	<div class="form-group">
	        		<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>
<script src='../js/star-rating.js'></script>