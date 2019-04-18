<?php


if(isset($_POST['marka'] , $_POST['model_pojazdu'] , $_POST['nr_rejestracyjny'] ,
    $_POST['poj_pojazdu']  )){

    $result = $pdo->prepare('INSERT INTO pojazdy (ID_POJAZDU,MARKA,MODEL_POJAZDU,NR_REJESTRACYJNY,POJ_POJAZDU)
     VALUES (pojazd.NEXTVAL, :marka, :model_pojazdu, :nr_rejestracyjny,:poj_pojazdu)');

     $result->bindParam(':marka',$_POST['marka'] );
     $result->bindParam(':model_pojazdu',$_POST['model_pojazdu'] );
     $result->bindParam(':nr_rejestracyjny',$_POST['nr_rejestracyjny'] );
     $result->bindParam(':poj_pojazdu',$_POST['poj_pojazdu'] );

    $result->execute();

    header('location: index.php?v=pojazdy/pojazdy');

}

 ?>


</br>
<h1>Dodawanie pojazdu</h1>

<form method="post">
  <div class="form-group">
    <label>Marka</label>
    <input type="text" name="marka"  maxlength="30" class="form-control">

    <label>Model</label>
    <input type="text" name="model_pojazdu"  maxlength="30" class="form-control">

    <label>Nr_rejestracyjny</label>
    <input type="text" name="nr_rejestracyjny"  maxlength="7" class="form-control">

    <label>Pojemność pojazdu</label>
    <input type="number" name="poj_pojazdu"   class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
