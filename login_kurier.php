<?php
session_start();
include('db/pdo.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DOSTAWY.PL | KURIER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>DOSTAWY</b>.PL
    </div>
    <!-- /.login-logo -->
    <div class="container">
      <p class="login-box-msg"><b>Kurier Logowanie</b></p>

      <form name="form1" class="form-group" method="post">
        <div class="form-group ">
          <input type="text" name="username" class="form-control" placeholder="Użytkownik" required=""/>

        </div>
        <div class="form-group ">
          <input type="password" name="password" class="form-control" placeholder="Hasło" required=""/>

        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary " name="submit1" value="Login">Zaloguj</button>
          </div>
          <!-- /.col -->
        </div>

      </div>
    </div>
      </form>

<a href="login.php" class="text-center">Zaloguj się jako administrator</a>


<?php

    if(isset($_POST["submit1"] , $_POST["username"], $_POST["password"]))
    {
      $cur = oci_new_cursor($conn);
      $stmt = oci_parse($conn, "begin LOGIN_KURIER(:PLOUG_CURSOR , :login , :haslo); end;");
      oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
      oci_bind_by_name($stmt, ":login",  $_POST['username']);
      oci_bind_by_name($stmt, ":haslo",  $_POST['password']);
      oci_execute($stmt);
      oci_execute($cur);

      $kurierLog = oci_fetch_array($cur, OCI_BOTH);


        $kurier=0;

        $kurier = oci_num_rows($stmt);
        if ($kurier == 0) {
          ?>
                      <p>brak</p>

                  <?php

                } elseif ( ($kurierLog['LOGIN'] == $_POST['username'] ) &&  ($kurierLog['HASLO'] == $_POST['password'] )  ) {
                $_SESSION["kurier"]=$_POST["username"];
                $_SESSION["kurier_id"]=$kurierLog["ID_KURIERA"];
                //echo $kurier;
                  header("Location:index_kurier.php");
                }
                elseif ( ($kurierLog['LOGIN'] != $_POST['username'] ) ||  ($kurierLog['HASLO'] != $_POST['password'] )  ) {

                  echo ' zły login lub hasło';
                }
              }

              ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->

<!-- iCheck -->
<script src="js/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
