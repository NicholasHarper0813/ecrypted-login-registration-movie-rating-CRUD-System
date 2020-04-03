<?php
require_once 'core/init.php';

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'email' => array(
          'required' => true,
          'min' => 2,
          'max' => 30,
          'unique' => 'users'
      ),
      'password' => array(
          'required' => true,
          'min' => 2
      ),
      'password-again' => array(
          'required' => true,
          'matches' => 'password'
      ),
      'names' => array(
          'required' => true,
          'min' => 2,
          'max' => 60,
      ),
    ));

    if($validation->passed()) {
      $user = new User();

      $salt = Hash::salt(32);

      try {
        $user->create(array(
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password'), $salt),
            'salt' => $salt,
            'names' => Input::get('names'),
            'joined' => date('Y-m-d H:i:s'),
            'group' => 1
        ));

        Session::flash('home', 'You have been registered and can now Log In!');
        Redirect::to('index.php');

      } catch(Exception $e) {
          die($e->getMessage());
      }
    } else {
      foreach ($validation->errors() as $error) {
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

    <title>Register Account</title>
  </head>
  <body>
      <div class="row justify-content-center">
        <form action="" method="post">
            <h3 style="color : blue">Register Account</h3>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" id="password" name="password" required >
            </div>
            <div class="form-group">
                <label for="pwd">Password Again:</label>
                <input type="password" class="form-control" placeholder="Enter password again" id="password-again" name="password-again" required >
            </div>
            <div class="form-group">
                <label for="name">Full Names:</label>
                <input type="text" class="form-control" placeholder="Full Names" id="names" name="names" required >
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
            <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>