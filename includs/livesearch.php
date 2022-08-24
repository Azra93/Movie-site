<?php

    include 'db.inc.php';

    if(isset($_POST['input'])){
       echo $input = "%{$_POST['input']}%";

        $sql = $conn->prepare("SELECT * FROM movie WHERE movie_name LIKE :input");
            $sql->execute(['input' => $input]);
            $count = $sql->rowCount();

            if($count>0){

                $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
                $results = $sql->fetchAll();           
        
                foreach($results as $column=>$value){
                    ?>
                    <div class='movie'>
                                <div class="img">
                                    <img src="../img/<?php echo $value['img']; ?>" with='200px' height='300px' border-radius='30px'>
                                </div>
                                <div>
                                    <h3><?php echo $value['movie_name'];?></h3>
                                    <h5>Year: <?php echo $value['year'];?></h5>
                                    <div class="link">
                                        <a href="show-movie.php?id=<?php echo $value['id'];?>" target='_blank'><button>Read more</button></a>
                                    </div>
                               </div>
                            </div>
                    <?php
                }

            }else{
                echo "<h4 style='color:white'>No data Foiund</h4>";
            }
    }

?>