<?php


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title></title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/../index.php">LOGIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">



      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
        <div class="container">
          <h3>Register</h3>
          <hr>
          <form class="" action="/controller/insertUser.php" method="post">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="text">Nome :</label>
                  <input type="text" class="form-control" name="name" id="name" value="" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="email">Email :</label>
                  <input type="email" class="form-control" name="email" id="email" value="" required>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="password">Senha :</label>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>
              </div>

              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="password">Confirme a senha :</label>
                  <input type="password" class="form-control" name="password" id="confirm_password" value="" required>
                </div>
              </div>




              <?php if (isset($_SESSION['error'])) : ?>
                <div class="col-12">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
              <?php
                unset($_SESSION['error']);
              endif; ?>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="index.php" class="btn btn-warning">Cancelar</a>
              </div>




              <div class="col-12 col-sm-6 text-right">
                <a href="index.php">J?? possuo uma conta.</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    var password = document.getElementById("password"),
      confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
      if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Senhas diferentes!");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
  </script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>