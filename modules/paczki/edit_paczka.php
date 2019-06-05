<?php


if(isset( $_POST['kur'] , $_POST['mag'] ,
    $_POST['kl'] ,
       $_POST['WAGA'],  $_POST['NAZWA'])){



      $stmt = oci_parse($conn, "begin UPDATE_DANE_PACZKI(:id, :ID_KURIERA, :ID_MAGAZYNU,
                                                    :ID_KLIENTA, :WAGA, :NAZWA
                                                    ); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

      oci_bind_by_name($stmt, ":ID_KURIERA",  $_POST['kur']);
      oci_bind_by_name($stmt, ":ID_MAGAZYNU",  $_POST['mag']);
      oci_bind_by_name($stmt, ":ID_KLIENTA",  $_POST['kl']);
      oci_bind_by_name($stmt, ":id",  $_GET['id']);

      oci_bind_by_name($stmt, ":WAGA",  $_POST['WAGA']);
      oci_bind_by_name($stmt, ":NAZWA",  $_POST['NAZWA']);


      oci_execute($stmt);

      header('location: index.php?v=paczki/paczki');

  }

  if(!isset($_GET['id'])){
      header('location: index.php?v=paczki/paczki');
  }

  $cur00 = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin SELECT_PACZKA_ID(:id, :PLOUG_CURSOR); end;");

  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur00, -1, OCI_B_CURSOR);
  oci_bind_by_name($stmt, ":id",  $_GET['id']);

  oci_execute($stmt);
  oci_execute($cur00);
  $paczka = oci_fetch_array($cur00, OCI_BOTH);


$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin KURIERZY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur);

$cur1 = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin KLIENCI_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur1, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur1);

$cur2 = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin MAGAZYNY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur2, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur2);

//value="' . $pojazd['ID_POJAZDU'] . '"

?>



</br>
<h1>Dodawanie paczki</h1>

<form method="post">
  <div class="form-group">
      <label>Kurier</label>
      <select class="form-control" name="kur">
        <?php
          while (($kurier = oci_fetch_array($cur, OCI_BOTH))) {
            if($paczka['ID_PACZKI'] == $kurier['ID_KURIERA']){
              echo '<option selected value="' . $kurier['ID_KURIERA'] . '" >';
            } else {
                  echo '<option value="' . $kurier['ID_KURIERA'] . '" >';
            }

            echo "(".$kurier['ID_KURIERA'].")"." ".$kurier['IMIE']." ".$kurier['NAZWISKO'];
            echo '</option>';
          }

         ?>
      </select>

      <label>Magazyn</label>
      <select class="form-control" name="mag">
        <?php
          while (($magazyn = oci_fetch_array($cur2, OCI_BOTH))) {
            if($paczka['ID_PACZKI'] == $magazyn['ID_MAGAZYNU']){
              echo '<option selected value="' . $magazyn['ID_MAGAZYNU'] . '" >';
            } else {
                  echo '<option value="' . $magazyn['ID_MAGAZYNU'] . '" >';
            }


            echo "(".$magazyn['ID_MAGAZYNU'].")"." ".$magazyn['MIASTO']." ".$magazyn['ULICA']." ".$magazyn['NUMER'];
            echo '</option>';
          }
         ?>
      </select>

      <label>Odbiorca</label>
      <select class="form-control" name="kl">
        <?php
          while (($klient = oci_fetch_array($cur1, OCI_BOTH))) {
            if($paczka['ID_PACZKI'] == $klient['ID_KLIENTA']){
              echo '<option selected value="' . $klient['ID_KLIENTA'] . '" >';
            } else {
                  echo '<option value="' . $klient['ID_KLIENTA'] . '" >';
            }

            echo "(".$klient['ID_KLIENTA'].")"." ".$klient['IMIE']." ".$klient['NAZWISKO']." ".$klient['TELEFON'];
            echo '</option>';
          }
         ?>
      </select>



      <label>Waga[KG]</label>
      <input type="number" name="WAGA" value="<?php echo $paczka['WAGA'];  ?>" maxlength="9"  class="form-control">


      <label>Nazwa</label>
      <input type="text" name="NAZWA" value="<?php echo $paczka['NAZWA'];  ?>" maxlength="30"  class="form-control">


  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
