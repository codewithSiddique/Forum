<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
    #ques {
        min-height: 85vh;
    }
    </style>

</head>

<body>
    <?php include "partical/_dbconnect.php"?>
    <?php include "partical/_header.php"?>

<div class="container my-4">
    <h1>Search Result For <?php  echo $_GET['search'] ?></h1>
<?php
         include "partical/_dbconnect.php";
        $noresult = true;
        $query = $_GET["search"];
        $sql = "SELECT * FROM threads WHERE MATCH (thread_title,thread_description) against ('$query')";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_description'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=". $thread_id;
               
                // displaying for search result
                echo '<div class="container my-3" id="ques">
                        
                            <div class="result">
                                <h3><a href="'.$url.'" class="text-dark">  '.$title.' </a></h3>
                                 <p> '.$desc.' </p>
                            </div>
                    </div>';
        }
        if($noresult){
            echo '<div class="container" id="ques">
                     <h3>Browse Questions</h3>
                        <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                 <p class="display-4">No Result Found</p>
                                    <ul>

                                        <li>Make sure that all words are spelled correctly.</li>
                                        <li>Try different keywords.</li>
                                        <li>Try more general keywords.</li>
                                    </ul>
                                </div>
                         </div>    
                 </div>';
        }
    ?>
</div>

 

    <!-- <div class="container my-3" id="ques">
        <h2>Search result for <em>"<?php echo $_GET['search']; ?>"</em></h2>
        <div class="result">
            <h3>
                <a href="/category/" class="text-dark"><?php echo $title ?></a>
            </h3>
            <p><?php echo $description?></p>
        </div>
    </div> -->

    <!-- category container start  -->

    <?php include "partical/_footer.php"?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>