<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['ulica'] ,
    $_POST['nr_domu'] , $_POST['miasto'] , $_POST['telefon'] )){
/*
      $result = $pdo->prepare('SELECT id_klient.NEXTVAL AS nextInsertID FROM DUAL');
      $result->execute();
      $nextInsertId = $result->fetchColumn(0);
*/
    $result = $pdo->prepare('INSERT INTO klienci (ID_KLIENTA,IMIE,NAZWISKO,ULICA,NR_DOMU,MIASTO,TELEFON)
     VALUES (klient.NEXTVAL, :imie, :nazwisko, :ulica,:nr_domu,:miasto,:telefon )');

    $result->bindParam(':imie',$_POST['imie'] );
    $result->bindParam(':nazwisko',$_POST['nazwisko'] );
    $result->bindParam(':ulica',$_POST['ulica'] );
    $result->bindParam(':nr_domu',$_POST['nr_domu'] );
    $result->bindParam(':miasto',$_POST['miasto'] );
    $result->bindParam(':telefon',$_POST['telefon'] );
    $result->execute();

    header('location: index.php?v=klienci/klienci');

}

 ?>


</br>
<h1>Dodawanie klienta</h1>

<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie" maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko" maxlength="60" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica" maxlength="60" class="form-control">

      <label>Nr_domu</label>
      <input type="text" name="nr_domu" maxlength="5" class="form-control">

      <label>Miasto</label>
      <input type="text" name="miasto" maxlength="30" class="form-control">

      <label>Telefon</label>
      <input type="text" name="telefon" maxlength="9" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
