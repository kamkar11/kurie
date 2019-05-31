<?php


if(isset($_POST['miasto'] , $_POST['ulica'] , $_POST['numer'] ,
    $_POST['region']  )){


      $stmt = oci_parse($conn, "begin INSERT_MAGAZYN( :miasto, :ulica, :numer,:region); end;");


      oci_bind_by_name($stmt, ":miasto",  $_POST['miasto']);
      oci_bind_by_name($stmt, ":ulica",  $_POST['ulica']);
      oci_bind_by_name($stmt, ":numer",  $_POST['numer']);
      oci_bind_by_name($stmt, ":region",  $_POST['region']);


      oci_execute($stmt);

/*
    $result = $pdo->prepare('INSERT INTO magazyny (ID_MAGAZYNU,MIASTO,ULICA,NUMER,REGION)
     VALUES (magazyn.NEXTVAL, :miasto, :ulica, :numer,:region)');

     $result->bindParam(':miasto',$_POST['miasto'] );
     $result->bindParam(':ulica',$_POST['ulica'] );
     $result->bindParam(':numer',$_POST['numer'] );
     $result->bindParam(':region',$_POST['region'] );

    $result->execute();
*/


    header('location: index.php?v=magazyny/magazyny');

}

 ?>


</br>
<h1>Dodawanie magazynu</h1>

<form method="post">
  <div class="form-group">
      <label>Miasto</label>
      <input type="text" name="miasto"  maxlength="30" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica"  maxlength="30" class="form-control">

      <label>Numer</label>
      <input type="text" name="numer"  maxlength="5" class="form-control">

      <label>Region</label>

      <select class="form-control" name="region">
        <option>Dolnośląskie</option>
        <option>Kujawsko-pomorskie</option>
        <option>Lubelskie</option>
        <option>Lubuskie</option>
        <option>Łódzkie</option>
        <option>Małopolskie</option>
        <option>Mazowieckie</option>
        <option>Opolskie</option>
        <option>Podkarpackie</option>
        <option>Podlaskie</option>
        <option>Pomorskie</option>
        <option>Śląskie</option>
        <option>Świętokrzyskie</option>
        <option>Warmińsko-mazurskie</option>
        <option>Wielkopolskie</option>
        <option>Zachodniopomorskie</option>
      </select>

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
