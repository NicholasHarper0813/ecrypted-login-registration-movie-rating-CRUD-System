<?php
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

      $validate = new Validate();
      $validation = $validate->check($_POST, array(
            'email' => array('required' => true),
            'password' => array('required' => true) 
      ));

      if($validation->passed()) {
           $user = new User();

           $remember = (Input::get('remember-me') === 'on') ? true : false;
           $login = $user->login(Input::get('email'), Input::get('password'), $remember);

           if($login){
             Redirect::to('create.php');
           } else {
             echo "<div class='row justify-content-center' style='color: red'>" . "Sorry, Wrong Email address or Password." . "</div>";
           }

      } else {
          foreach($validation->errors() as $error) {
              echo "<div class='row justify-content-center' style='color: red'>" . $error, "</div>";
          }
      }

    }
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

    <title>Log In</title>
  </head>
  <body>
      <div class="row justify-content-center">
        <form action="" method="post" >
            <h3 style="color : blue">Please Log In</h3>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" id="password" name="password" required>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember-me" id="remember-me"> Remember me
                </label>
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
            <button type="submit" class="btn btn-lg btn-primary btn-block">Log In</button>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>