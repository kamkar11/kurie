<?php


if(isset($_POST['miasto'] , $_POST['ulica'] , $_POST['numer'] ,
    $_POST['region']  )){

    $result = $pdo->prepare('INSERT INTO magazyny (ID_MAGAZYNU,MIASTO,ULICA,NUMER,REGION)
     VALUES (magazyn.NEXTVAL, :miasto, :ulica, :numer,:region)');

     $result->bindParam(':miasto',$_POST['miasto'] );
     $result->bindParam(':ulica',$_POST['ulica'] );
     $result->bindParam(':numer',$_POST['numer'] );
     $result->bindParam(':region',$_POST['region'] );

    $result->execute();

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
      <input type="text" name="region"  maxlength="30" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
