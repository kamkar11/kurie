<?php


if(isset($_POST['imie'] , $_POST['nazwisko'] , $_POST['email'] ,
    $_POST['tel_praca'] , $_POST['tel_prywatny'] , $_POST['pojazd'] ,
     $_POST['godz_roz_pracy'],  $_POST['godz_zak_pracy'],  $_POST['login'],  $_POST['haslo'] )){

       $haslo = $_POST['haslo'];

       //$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
       //$haslo_hash = md5($haslo);
       $stmt = oci_parse($conn, "begin UPDATE_KURIER(:id, :imie, :nazwisko, :email,
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
       oci_bind_by_name($stmt, ":id",  $_GET['id']);

       oci_execute($stmt);



    header('location: index_kurier.php?v=kurierzy/kurierzy');

}



if(!isset($_GET['id'])){
    header('location: index_kurier.php?v=kurierzy/kurierzy');
}
/*
$result = $pdo->prepare('SELECT * FROM klienci WHERE ID_KLIENTA= :id');
$result->bindParam(':id', $_GET['id']);
$result->execute();

$klienci = $result->fetch(); // przechowuje
*/
$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SELECT_KURIER_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$kurierzy = oci_fetch_array($cur, OCI_BOTH);

$cur2 = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin POJAZDY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur2, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur2);


 ?>


</br>
<h1>Edycja kuriera</h1>

<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie" value="<?php echo $kurierzy['IMIE'];  ?>" maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko" value="<?php echo $kurierzy['NAZWISKO'];  ?>" maxlength="60" class="form-control">

      <label>Email</label>
      <input type="email" name="email" value="<?php echo $kurierzy['EMAIL'];  ?>" maxlength="60" class="form-control">

      <label>Tel_praca</label>
      <input type="text" name="tel_praca" value="<?php echo $kurierzy['TEL_PRACA'];  ?>" maxlength="9" class="form-control">

      <label>Tel_prywatny</label>
      <input type="text" name="tel_prywatny" value="<?php echo $kurierzy['TEL_PRYWATNY'];  ?>" maxlength="9"  class="form-control">

      <label>Pojazd</label>
      <select class="form-control" name="pojazd" >
        <?php
          while (($pojazd = oci_fetch_array($cur2, OCI_BOTH))) {
            if($kurierzy['ID_POJAZDU'] == $pojazd['ID_POJAZDU']){
              echo '<option selected value="' . $pojazd['ID_POJAZDU'] . '" >';
            } else {
              echo '<option value="' . $pojazd['ID_POJAZDU'] . '" >';
            }

            echo "(".$pojazd['NR_REJESTRACYJNY'].")"." ".$pojazd['MARKA']." ".$pojazd['MODEL_POJAZDU'];
            echo '</option>';
          }
         ?>
      </select>

      <label>godz_roz_pracy</label>
      <input type="time" name="godz_roz_pracy" value="<?php echo $kurierzy['GODZ_ROZ_PRACY'];  ?>"  class="form-control">

      <label>godz_zak_pracy</label>
      <input type="time" name="godz_zak_pracy" value="<?php echo $kurierzy['GODZ_ZAK_PRACY'];  ?>"  class="form-control">

      <label>Login</label>
      <input type="text" name="login" value="<?php echo $kurierzy['LOGIN'];  ?>" maxlength="60" class="form-control">

      <label>Hasło</label>
      <input type="password" name="haslo" value="<?php echo $kurierzy['HASLO'];  ?>" maxlength="60" class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
