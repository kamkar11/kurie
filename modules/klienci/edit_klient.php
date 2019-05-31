<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['ulica'] ,
    $_POST['nr_domu'] , $_POST['miasto'] , $_POST['telefon'] )){

      $stmt = oci_parse($conn, "begin UPDATE_KLIENT(:id, :imie, :nazwisko, :ulica, :nr_domu, :miasto, :telefon); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
      oci_bind_by_name($stmt, ":imie",  $_POST['imie']);
      oci_bind_by_name($stmt, ":nazwisko",  $_POST['nazwisko']);
      oci_bind_by_name($stmt, ":ulica",  $_POST['ulica']);
      oci_bind_by_name($stmt, ":nr_domu",  $_POST['nr_domu']);
      oci_bind_by_name($stmt, ":miasto",  $_POST['miasto']);
      oci_bind_by_name($stmt, ":telefon",  $_POST['telefon']);

      oci_bind_by_name($stmt, ":id",  $_GET['id']);

      oci_execute($stmt);

/*
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
*/
    header('location: index.php?v=klienci/klienci');
}



if(!isset($_GET['id'])){
    header('location: index.php?v=klienci/klienci');
}
/*
$result = $pdo->prepare('SELECT * FROM klienci WHERE ID_KLIENTA= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$klienci = $result->fetch(); // przechowuje
*/
$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SELECT_KLIENT_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$klienci = oci_fetch_array($cur, OCI_BOTH);


 ?>


</br>
<h1>Edycja klienta</h1>

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
