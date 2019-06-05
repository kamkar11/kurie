<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['email'] ,
    $_POST['tel_praca'] , $_POST['tel_prywatny'] , $_POST['pojazd'] ,
     $_POST['godz_roz_pracy'],  $_POST['godz_zak_pracy'],  $_POST['login'],  $_POST['haslo'] )){
/*
      $result = $pdo->prepare('SELECT id_klient.NEXTVAL AS nextInsertID FROM DUAL');
      $result->execute();
      $nextInsertId = $result->fetchColumn(0);

*/

//  dump($_POST);

      $haslo = $_POST['haslo'];
    //  $godz_roz_pracy =  "2019-05-01"." ".$_POST['godz_roz_pracy'].":00.000000";
    //  $godz_zak_pracy =  "2019-05-01"." ".$_POST['godz_zak_pracy'].":00.000000";
      //$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
      //$haslo_hash = md5($haslo);
      $stmt = oci_parse($conn, "begin INSERT_KURIER(:imie, :nazwisko, :email,
                                                    :tel_praca, :tel_prywatny, :pojazd,
                                                   :godz_roz_pracy, :godz_zak_pracy, :login, :haslo  ); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
      oci_bind_by_name($stmt, ":imie",  $_POST['imie']);
      oci_bind_by_name($stmt, ":nazwisko",  $_POST['nazwisko']);
      oci_bind_by_name($stmt, ":email",  $_POST['email']);
      oci_bind_by_name($stmt, ":tel_praca",  $_POST['tel_praca']);
      oci_bind_by_name($stmt, ":tel_prywatny",  $_POST['tel_prywatny']);
      oci_bind_by_name($stmt, ":pojazd",  $_POST['pojazd']);
      oci_bind_by_name($stmt, ":godz_roz_pracy",  $_POST['godz_roz_pracy']);
      oci_bind_by_name($stmt, ":godz_zak_pracy",  $_POST['godz_zak_pracy']);
      oci_bind_by_name($stmt, ":login",  $_POST['login']);
      oci_bind_by_name($stmt, ":haslo",  $haslo );

      oci_execute($stmt);

      header('location: index_kurier.php?v=kurierzy/kurierzy');

  }


$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin POJAZDY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur);

//value="' . $pojazd['ID_POJAZDU'] . '"

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
            echo '<option value="' . $pojazd['ID_POJAZDU'] . '" >';
            echo "(".$pojazd['NR_REJESTRACYJNY'].")"." ".$pojazd['MARKA']." ".$pojazd['MODEL_POJAZDU'];
            echo '</option>';
          }
         ?>
      </select>

      <label>godz_roz_pracy</label>
      <input type="time" name="godz_roz_pracy"  class="form-control">

      <label>godz_zak_pracy</label>
      <input type="time" name="godz_zak_pracy"  class="form-control">

      <label>Login</label>
      <input type="text" name="login" maxlength="60" class="form-control">

      <label>Hasło</label>
      <input type="password" name="haslo" maxlength="60" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
