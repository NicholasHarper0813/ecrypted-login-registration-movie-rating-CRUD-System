<?php 
require_once 'core/init.php';
require_once 'Classes/Movie.php';
require_once 'Classes/Database.php';

if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $movie = new Movie();
    $movie->destroy($id);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <div class="container">
        <div class="row justify-content-center"><h2>Movie CRUD</h2></div>            
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th>Movie Title</th>
                <th>Duration</th>
                <th>Movie Ratings</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                   $movie = new Movie();              
                   $rows = $movie->select();
                   foreach($rows as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['duration']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td><a class="btn btn-sm btn-primary" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> &nbsp; 
                            <a class="btn btn-sm btn-danger" href="CRUDPage.php?del=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                <?php
                   }
                ?> 
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
