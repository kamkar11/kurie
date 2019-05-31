<?php


if(isset($_POST['miasto'] , $_POST['ulica'] , $_POST['numer'] ,
    $_POST['region']  )){


      $stmt = oci_parse($conn, "begin UPDATE_MAGAZYN(:id, :miasto, :ulica, :numer, :region); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
      oci_bind_by_name($stmt, ":miasto",  $_POST['miasto']);
      oci_bind_by_name($stmt, ":ulica",  $_POST['ulica']);
      oci_bind_by_name($stmt, ":numer",  $_POST['numer']);
      oci_bind_by_name($stmt, ":region",  $_POST['region']);

      oci_bind_by_name($stmt, ":id",  $_GET['id']);

      oci_execute($stmt);

/*
    $result = $pdo->prepare('UPDATE magazyny SET miasto = :miasto, ulica = :ulica, numer = :numer,
                                                region = :region
                                                WHERE id_magazynu = :id ');

    $result->bindParam(':miasto',$_POST['miasto'] );
    $result->bindParam(':ulica',$_POST['ulica'] );
    $result->bindParam(':numer',$_POST['numer'] );
    $result->bindParam(':region',$_POST['region'] );

    $result->bindParam(':id',$_GET['id']);
    $result->execute();
*/
    header('location: index.php?v=magazyny/magazyny');
}



if(!isset($_GET['id'])){
    header('location: index.php?v=magazyny/magazyny');
}
/*
$result = $pdo->prepare('SELECT * FROM magazyny WHERE ID_MAGAZYNU= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$magazyny = $result->fetch(); // przechowuje
*/

$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SELECT_MAGAZYN_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$magazyny = oci_fetch_array($cur, OCI_BOTH);


 ?>


</br>
<h1>Edycja magazynu</h1>

<form method="post">
  <div class="form-group">
      <label>Miasto</label>
      <input type="text" name="miasto" value="<?php echo $magazyny['MIASTO'];  ?>" maxlength="30" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica" value="<?php echo $magazyny['ULICA'];  ?>" maxlength="30" class="form-control">

      <label>Numer</label>
      <input type="text" name="numer" value="<?php echo $magazyny['NUMER'];  ?>" maxlength="5" class="form-control">

      <label>Region</label>


      <select class="form-control" name="region" >
        <option selected><?php echo $magazyny['REGION'];  ?> </option>
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
