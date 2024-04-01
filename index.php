<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>iDiscuss</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>    
    <body>
        <?php include "partical/_header.php"?>    
        <?php include "partical/_dbconnect.php"?>
        
        
    <!-- slider -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/sliderimg1.jpg" class="d-block w-100" height="650px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100" height="650px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider3.jpg" class="d-block w-100" height="650px" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <h1 style="text-align: center">iDiscuss - Category</h1>
    </div>

    <!-- category container start  -->
    <div class="container my-4">
        <div class="row">
            <?php 
                $sql = "SELECT * FROM `category`";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    // echo $row['category_Id'] . "<br>";
                    // echo $row['title'] . "<br>";;
                    // echo $row['description'];
                    $cat_id = $row['category_Id'];
                    $cat = $row['title'];
                    $desc = $row['description'];
                    echo '   <div class="col-md-4 my-2">
                    <div class="card" style="width: 18rem;">
                        <img src="img/img'.$cat_id.'.jpg" class="card-img-top" alt="Image for Category">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid='.$cat_id.'">'.$cat.'</a></h5>
                            <p class="card-text">'.substr($desc, 0,90).'...</p>
                            <a href="threadlist.php?catid='.$cat_id.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';                }
            ?>
         
        </div>
    </div>
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