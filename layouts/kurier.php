


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Kurier!</title>
  </head>
  <body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top" >
  <a class="navbar-brand" href="#">DOSTAWY.PL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index_kurier.php?v=klienci/klienci">Klienci <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="index_kurier.php?v=pojazdy/pojazdy">Pojazdy</a>
      <a class="nav-item nav-link" href="index_kurier.php?v=magazyny/magazyny">Magazyny</a>
      <a class="nav-item nav-link" href="index_kurier.php?v=kurierzy/kurierzy">Kurierzy</a>
      <a class="nav-item nav-link" href="index_kurier.php?v=paczki/paczki">Paczki</a>
    </div>
  </div>
  <label style="color: yellow;"><?php echo $_SESSION['kurier']  ?></label><br/><br/>
  <a href="loout_kurier.php" class="btn btn-success">Wyloguj</a>
</nav>


    <div class="container">
        <?php echo $content; ?>
    </div>


    <div class="navbar navbar-fixed-bottom">
        <div class="navbar-inner">
            <div class="width-constraint clearfix">
                <p class="pull-left muted credit">DOSTAWY.PL  v1.0.0</p>

                <p class="pull-right muted credit">©2019 • CONFIDENTIAL ALL RIGHTS RESERVED</p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>
