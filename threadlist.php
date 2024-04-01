<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>iDiscuss</title>
    <style>
    #ques {
        min-height: 388px;
    }
    </style>
</head>

<body>
    <?php include "partical/_header.php"; ?>
    <?php include "partical/_dbconnect.php"; ?>

      <!-- jumbotron for fetching the question -->
    <?php 

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `category` WHERE `category_Id` = $id";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $cat_title = $row['title'];
            $cat_desc = $row['description'];
        }
        
    ?>

    
    <!-- insert db in comment -->
    <?php
    $showAlert = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
            $th_title = $_POST['title'];
            $th_title = str_replace("<", "&lt", $th_title);
            $th_title = str_replace(">", "&gt", $th_title);
            $th_desc = $_POST['description'];
            $th_desc = str_replace("<", "&lt", $th_desc);
            $th_desc = str_replace(">", "&gt", $th_desc);
            $user_Id = $_POST['user_Id'];
            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `DateTime`) VALUES ('$th_title', '$th_desc', '$id', ' $user_Id', current_timestamp())";
            $result = mysqli_query($con,$sql);
            if(!$result){
                echo "Error: " . mysqli_error($con);
            }

            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Thread has been inserted Please wait community to respond. 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            
    }

    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $cat_title; ?> Forum</h1>
            <p class="lead"><?php echo $cat_desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer Forum for sharing knowledge with each others.No Spam / Advertising / Self-promote
                in the forums is not allowed.Do not post copyright-infringing material. Do not post “offensive” posts,
                links or images.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

     <!-- form for posting question -->
     <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div class="container my-4">
        <h3>Start a Discussion</h3>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="title">
                <small id="emailHelp" class="form-text text-muted">Make you question as crips and short as
                    possible.</small>
            </div>
            <div class="form-group">
                <label for="desc">Elaborate Your Concern</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <input type="hidden" name="user_Id" value="'.$_SESSION['user_Id'].'">
            <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
        </form>
    </div>';
        }else{
            echo '<div class="container">
            <p class="lead">Login to asked question</p>
            </div>';
        }
    

    ?>

      <!-- fetching the thread from the database -->
    <div class="container" id="ques">
        <h3>Browse Questions</h3>
        <?php 

                $id = $_GET['catid'];
                $noResult = true;
                $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id;";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                     $thread_id = $row['thread_id'];
                     $cat_title = $row['thread_title'];
                    $cat_desc = $row['thread_description'];
                    $dataTime = $row['DateTime'];
                    $thread_cat_id = $row['thread_cat_id'];
                    $sql2 = "select username from user where user_Id ='$thread_cat_id'";
                    $result2 = mysqli_query($con,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $username = $row2['username'];
                    echo '<div class="media  my-3">
                    <img src="img/user.jpg" weight="50px" height="45px" class="mr-3" alt="...">
                    <div class="media-body">
                        <p class="font-weight-bold my-0">Asked by <span style="text-transform:uppercase;"><em> '.$username.' </em></span> at '.$dataTime.'</p>
                        <h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='.$thread_id.'">'.$cat_title.'</a> </h5>
                             '.$cat_desc.'
                    </div>
                </div>';
                }
                if($noResult){
                    echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <p class="display-4">No Threads Found</p>
                      <p class="lead">Be The First Person To Asked Question</p>
                    </div>
                  </div>';
                }

        ?>
    </div>
    <?php include "partical/_footer.php" ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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