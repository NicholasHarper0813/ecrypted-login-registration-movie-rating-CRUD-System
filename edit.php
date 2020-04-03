<?php 
require_once 'core/init.php';
require_once 'Classes/Movie.php';
require_once 'Classes/Database.php';

if(isset($_GET['id'])){
    $uid = $_GET['id'];

    $movie = new Movie();  
    
    $result = $movie->selectOne($uid);

}

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $rating = $_POST['rating'];
    $id = $_POST['id'];

    $movie = new Movie();
    $movie->update_movie($id,$title,$duration,$rating);

    Redirect::to('CRUDPage.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Movies</title>
  </head>
  <body>
    <h3>
        <?php
            $user = new User();
            if($user->isLoggedIn()) {
                echo "<div class='row justify-content-center'>" . escape($user->data()->names) . "</div>"; 
                echo "<div class='row justify-content-center'><a href='logout.php'>Log out</a></div>";
            }
        ?>
    </h3>
    <div class="row justify-content-center">
    <form action="" method="post">
        <div class="row justify-content-center"><h2>Edit a Movie</h2></div>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>" >
        <div class="form-group">
            <label for="title">Movie Title:</label>
            <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="<?php echo $result['title']; ?>" required autofocus>
        </div>
        <div class="form-group">
            <label for="time">Movie Duration:</label>
            <input type="datetime" class="form-control" placeholder="Duration" id="duration" name="duration" value="<?php echo $result['duration']; ?>" required >
        </div>
        <div class="form-group">
            <label for="rating">Ratings:</label>
            <input type="range" min="1" max="6" value="0" class="form-control" placeholder="Enter password again" id="rating" name="rating" value="<?php echo $result['rating']; ?>">
        </div> 
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit">
    </form>
    <div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>