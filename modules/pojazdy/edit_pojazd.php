<?php


if(isset($_POST['marka'] , $_POST['model_pojazdu'] , $_POST['nr_rejestracyjny'] ,
    $_POST['poj_pojazdu']  )){


    $result = $pdo->prepare('UPDATE pojazdy SET marka = :marka, model_pojazdu = :model_pojazdu, nr_rejestracyjny = :nr_rejestracyjny,
                                                poj_pojazdu = :poj_pojazdu
                                                WHERE id_pojazdu = :id ');

    $result->bindParam(':marka',$_POST['marka'] );
    $result->bindParam(':model_pojazdu',$_POST['model_pojazdu'] );
    $result->bindParam(':nr_rejestracyjny',$_POST['nr_rejestracyjny'] );
    $result->bindParam(':poj_pojazdu',$_POST['poj_pojazdu'] );

    $result->bindParam(':id',$_GET['id']);
    $result->execute();

    header('location: index.php?v=pojazdy/pojazdy');
}

/*
if(isset($_GET)){
    print_r($_GET);
}
*/

if(!isset($_GET['id'])){
    header('location: index.php?v=pojazdy/pojazdy');
}

$result = $pdo->prepare('SELECT * FROM pojazdy WHERE ID_POJAZDU= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$pojazdy = $result->fetch(); // przechowuje




 ?>


</br>
<h1>Edycja pojazdu</h1>

<form method="post">
  <div class="form-group">
      <label>Marka</label>
      <input type="text" name="marka" value="<?php echo $pojazdy['MARKA'];  ?>" maxlength="30" class="form-control">

      <label>Model</label>
      <input type="text" name="model_pojazdu" value="<?php echo $pojazdy['MODEL_POJAZDU'];  ?>" maxlength="30" class="form-control">

      <label>Nr_rejestracyjny</label>
      <input type="text" name="nr_rejestracyjny" value="<?php echo $pojazdy['NR_REJESTRACYJNY'];  ?>" maxlength="7" class="form-control">

      <label>Pojemność pojazdu</label>
      <input type="number" name="poj_pojazdu" value="<?php echo $pojazdy['POJ_POJAZDU'];  ?>"  class="form-control">



  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
