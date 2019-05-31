<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['ulica'] ,
    $_POST['nr_domu'] , $_POST['miasto'] , $_POST['telefon'] )){
/*
      $result = $pdo->prepare('SELECT id_klient.NEXTVAL AS nextInsertID FROM DUAL');
      $result->execute();
      $nextInsertId = $result->fetchColumn(0);
*/
      $stmt = oci_parse($conn, "begin INSERT_KLIENT(:imie, :nazwisko, :ulica, :nr_domu, :miasto, :telefon); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
      oci_bind_by_name($stmt, ":imie",  $_POST['imie']);
      oci_bind_by_name($stmt, ":nazwisko",  $_POST['nazwisko']);
      oci_bind_by_name($stmt, ":ulica",  $_POST['ulica']);
      oci_bind_by_name($stmt, ":nr_domu",  $_POST['nr_domu']);
      oci_bind_by_name($stmt, ":miasto",  $_POST['miasto']);
      oci_bind_by_name($stmt, ":telefon",  $_POST['telefon']);

      oci_execute($stmt);

      header('location: index.php?v=klienci/klienci');

  }


$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin POJAZDY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur);



?>



</br>
<h1>Dodawanie kuriera</h1>

<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie" maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko" maxlength="60" class="form-control">

      <label>Email</label>
      <input type="email" name="email" maxlength="60" class="form-control">

      <label>Tel_praca</label>
      <input type="text" name="tel_praca" maxlength="9" class="form-control">

      <label>Tel_prywatny</label>
      <input type="text" name="tel_prywatny" maxlength="9"  class="form-control">

      <label>Pojazd</label>
      <select class="form-control" name="pojazd">
        <?php
          while (($pojazd = oci_fetch_array($cur, OCI_BOTH))) {
            echo '<option value="' . $pojazd['ID_POJAZDU'] . '">';
            echo "(".$pojazd['ID_POJAZDU'].")"." ".$pojazd['MARKA']." ".$pojazd['MODEL_POJAZDU'];
            echo '</option>';
          }
         ?>
      </select>

      <label>godz_roz_pracy</label>
      <input type="time" name="godz_roz_pracy"  class="form-control">

      <label>godz_zak_pracy</label>
      <input type="time" name="godz_roz_pracy"  class="form-control">

      <label>Login</label>
      <input type="text" name="login" maxlength="60" class="form-control">

      <label>Hasło</label>
      <input type="text" name="haslo" maxlength="60" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
