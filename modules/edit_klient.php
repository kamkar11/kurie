<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['ulica'] ,
    $_POST['nr_domu'] , $_POST['miasto'] , $_POST['telefon'] )){
/*
      $result = $pdo->prepare('SELECT id_klient.NEXTVAL AS nextInsertID FROM DUAL');
      $result->execute();
      $nextInsertId = $result->fetchColumn(0);
*/
    $result = $pdo->prepare('UPDATE klienci SET imie = :imie, nazwisko = :nazwisko, ulica = :ulica,
                                                nr_domu = :nr_domu, miasto = :miasto, telefon = :telefon
                                                WHERE id_klienta = :id ');

    $result->bindParam(':imie',$_POST['imie'] );
    $result->bindParam(':nazwisko',$_POST['nazwisko'] );
    $result->bindParam(':ulica',$_POST['ulica'] );
    $result->bindParam(':nr_domu',$_POST['nr_domu'] );
    $result->bindParam(':miasto',$_POST['miasto'] );
    $result->bindParam(':telefon',$_POST['telefon'] );
    $result->bindParam(':id',$_GET['id']);
    $result->execute();

    header('location: index.php?v=klienci');
}

/*
if(isset($_GET)){
    print_r($_GET);
}
*/

if(!isset($_GET['id'])){
    header('location: index.php?v=klienci');
}

$result = $pdo->prepare('SELECT * FROM klienci WHERE ID_KLIENTA= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$klienci = $result->fetch(); // przechowuje




 ?>



<h1>Dodawanie klienta</h1>

<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie" value="<?php echo $klienci['IMIE'];  ?>" maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko" value="<?php echo $klienci['NAZWISKO'];  ?>" maxlength="60" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica" value="<?php echo $klienci['ULICA'];  ?>" maxlength="60" class="form-control">

      <label>Nr_domu</label>
      <input type="text" name="nr_domu" value="<?php echo $klienci['NR_DOMU'];  ?>" maxlength="5" class="form-control">

      <label>Miasto</label>
      <input type="text" name="miasto" value="<?php echo $klienci['MIASTO'];  ?>" maxlength="30" class="form-control">

      <label>Telefon</label>
      <input type="text" name="telefon" value="<?php echo $klienci['TELEFON'];  ?>" maxlength="9" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
