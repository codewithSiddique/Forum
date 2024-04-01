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
        min-height: 333px;
    }
    </style>

</head>

<body>
    <?php include 'partical/_header.php';?>
    <?php include 'partical/_dbconnect.php'; ?>


    <!-- jumbotron for fetching the question -->
    <?php
        $id = $_GET['threadid'];
         $sql = "SELECT * FROM `threads` WHERE `thread_id` = $id;";
         $result = mysqli_query($con,$sql);
         while($row = mysqli_fetch_assoc($result)){
    
             $title = $row['thread_title'];
             $desc = $row['thread_description'];
             // Query the user table to find out the name of OP
             $thread_user_id = $row['thread_user_id'];
             $sql2 = "select username from user where user_Id ='$thread_user_id'";
             $result2 = mysqli_query($con,$sql2);
             $row2 = mysqli_fetch_assoc($result2);
             $posted_by = $row2['username'];

    }

    ?>

    <!-- insert db in comment -->
    <?php
      $showAlert = false;
      if($_SERVER['REQUEST_METHOD'] == "POST"){
              $comment_content = $_POST['comment'];
              $comment_content = str_replace("<", "&lt", $comment_content);
              $comment_content = str_replace(">", "&gt",$comment_content);
              $user_Id = $_POST['user_Id'];
              $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$id', '$user_Id', current_timestamp());";
              $result = mysqli_query($con,$sql);
              $showAlert = true;
              if($showAlert){
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your Comment has been inserted. 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
              }
              
      }
  
      ?>


    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title;?></h1>
            <p class="lead"> <?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer Forum for sharing knowledge with each others.No Spam / Advertising / Self-promote
                in the forums is not allowed.Do not post copyright-infringing material. Do not post “offensive” posts,
                links or images.
                Remain respectful of other members at all times.</p>

            <h6>Posted by <span style="text-transform:uppercase;"><em><?php echo $posted_by;?></em></span></h6>
        </div>
    </div>

    <!-- form for posting comment -->

    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container my-4">
        <h3>Post a Comment</h3>
        <form action="  '.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">
                <label for="comment">Type your Comment</label>
                <textarea class="form-control" name="comment" id="description" rows="3"></textarea>
                <input type="hidden" name="user_Id" value="'.$_SESSION['user_Id'].'">
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">Post a Comment</button>
        </form>
    </div>';
    }else{
            echo '<div class="container">
            <p class="lead">Login to start a Discussion</p>
            </div>';
    }
   

    ?>
 

    <!-- fetching the thread from the database -->
    <div class="container" id="ques">
        <h3>Start a Discussion</h3>
        <?php 
    $id = $_GET['threadid'];
    $noResult = true;
    $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id;";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $comment_id = $row['comment_id'];
        $comment_content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];
        $sql2 = "select username from user where user_Id ='$thread_user_id'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $username = $row2['username'];
        echo '<div class="media  my-3">
                <img src="img/user.jpg" weight="50px" height="45px" class="mr-3" alt="...">
                <div class="media-body">
                    <p class="font-weight-bold my-0">Answer by <span style="text-transform:uppercase;"><em> '.$username.' </em></span> at '.$comment_time.'</p>
                   '.$comment_content.'
                </div>
         </div>';
    }
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
             <div class="container">
             <p class="display-4">No Comments Found</p>
          <p class="lead">Be The First Person Post a Comment</p>
            </div>
            </div>';
    }

?>


    </div>



    <?php include 'partical/_footer.php';?>

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