<?php


if(isset( $_POST['ID_KURIERA'] , $_POST['ID_MAGAZYNU'] ,
    $_POST['ID_KLIENTA'] ,
       $_POST['WAGA'],  $_POST['NAZWA'])){



      $stmt = oci_parse($conn, "begin INSERT_PACZKA( :ID_KURIERA, :ID_MAGAZYNU,
                                                    :ID_KLIENTA, :WAGA, :NAZWA
                                                    ); end;");

      //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

      oci_bind_by_name($stmt, ":ID_KURIERA",  $_POST['ID_KURIERA']);
      oci_bind_by_name($stmt, ":ID_MAGAZYNU",  $_POST['ID_MAGAZYNU']);
      oci_bind_by_name($stmt, ":ID_KLIENTA",  $_POST['ID_KLIENTA']);

      oci_bind_by_name($stmt, ":WAGA",  $_POST['WAGA']);
      oci_bind_by_name($stmt, ":NAZWA",  $_POST['NAZWA']);


      oci_execute($stmt);

      header('location: index.php?v=paczki/paczki');

  }


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
      <select class="form-control" name="ID_KURIERA">
        <?php
          while (($kurier = oci_fetch_array($cur, OCI_BOTH))) {
            echo '<option value="' . $kurier['ID_KURIERA'] . '" >';
            echo "(".$kurier['ID_KURIERA'].")"." ".$kurier['IMIE']." ".$kurier['NAZWISKO'];
            echo '</option>';
          }
         ?>
      </select>

      <label>Magazyn</label>
      <select class="form-control" name="ID_MAGAZYNU">
        <?php
          while (($magazyn = oci_fetch_array($cur2, OCI_BOTH))) {
            echo '<option value="' . $magazyn['ID_MAGAZYNU'] . '" >';
            echo "(".$magazyn['ID_MAGAZYNU'].")"." ".$magazyn['MIASTO']." ".$magazyn['ULICA']." ".$magazyn['NUMER'];
            echo '</option>';
          }
         ?>
      </select>

      <label>Odbiorca</label>
      <select class="form-control" name="ID_KLIENTA">
        <?php
          while (($klient = oci_fetch_array($cur1, OCI_BOTH))) {
            echo '<option value="' . $klient['ID_KLIENTA'] . '" >';
            echo "(".$klient['ID_KLIENTA'].")"." ".$klient['IMIE']." ".$klient['NAZWISKO']." ".$klient['TELEFON'];
            echo '</option>';
          }
         ?>
      </select>



      <label>Waga[KG]</label>
      <input type="number" name="WAGA" maxlength="9"  class="form-control">


      <label>Nazwa</label>
      <input type="text" name="NAZWA" maxlength="30"  class="form-control">


  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>
