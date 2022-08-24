<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="../css/style-user.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
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
                    <li><input type="search" name='search' id='search' placeholder="Search..." ></li>
                    <li><i class="fa fa-search"></i></li>
                </ul>
            </nav>
            <a href="logout.php"><button>Log Out</button></a>
        </div>
        <div class="main" id='main'>
            

                <?php
                    $query = "SELECT * FROM movie";  
                    $statement = $conn->prepare($query);  
                    $statement->execute();  
                    $count = $statement->rowCount(); 
                    if($count > 0)  {
                        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                        $results = $statement->fetchAll();
                        foreach($results as $column=>$type){
                            ?>
                            <div class='movie'>
                                <div class="img">
                                    <img src="../img/<?php echo $type['img']; ?>" with='200px' height='300px' style='border-radius: 20px'>
                                </div>
                                <div>
                                    <h3><?php echo $type['movie_name'];?></h3>
                                    <h5>Year: <?php echo $type['year'];?></h5>
                                    <div class="link">
                                        <a href="show-movie.php?id=<?php echo $type['id'];?>" target='_blank'><button>Read more</button></a>
                                    </div>
                               </div>
                            </div>
                               <?php
                        }
                    }
                               ?>
           
        </div>
        <div class="footer">
            <?php
                require 'footer.php';
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src='../js/search.js'></script>
    <script src='../js/rating.js'></script>
    
</body>
</html>