</br></br>

<h1>Wyszukiwanie paczek</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/


  $cur00 = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin PACZKI_FIND( :PLOUG_CURSOR, :id_pacz, :ID_KURIERA, :ID_MAGAZYNU,
                                                :ID_KLIENTA, :status, :godz_wys, :godz_dos, :WAGA, :NAZWA
                                                ); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur00, -1, OCI_B_CURSOR);
  //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

  oci_bind_by_name($stmt, ":ID_KURIERA",  $_POST['ID_KURIERA']);
  oci_bind_by_name($stmt, ":ID_MAGAZYNU",  $_POST['ID_MAGAZYNU']);
  oci_bind_by_name($stmt, ":ID_KLIENTA",  $_POST['ID_KLIENTA']);

  oci_bind_by_name($stmt, ":WAGA",  $_POST['WAGA']);
  oci_bind_by_name($stmt, ":NAZWA",  $_POST['NAZWA']);

  oci_bind_by_name($stmt, ":status",  $_POST['status']);

  oci_bind_by_name($stmt, ":godz_wys",  $_POST['godz_wys']);
  oci_bind_by_name($stmt, ":godz_dos",  $_POST['godz_dos']);


  oci_bind_by_name($stmt, ":id_pacz",  $_POST['id']);

  oci_execute($stmt);
  oci_execute($cur00);




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

 ?>

</br>
<form method="post">
  <div class="form-group">
      <label>Kurier</label>
      <select class="form-control" name="ID_KURIERA">
        <?php
        echo '<option selected  >';
        echo " ";
        echo '</option>';
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
        echo '<option selected  >';
        echo " ";
        echo '</option>';
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
        echo '<option selected  >';
        echo " ";
        echo '</option>';
          while (($klient = oci_fetch_array($cur1, OCI_BOTH))) {
            echo '<option value="' . $klient['ID_KLIENTA'] . '" >';
            echo "(".$klient['ID_KLIENTA'].")"." ".$klient['IMIE']." ".$klient['NAZWISKO']." ".$klient['TELEFON'];
            echo '</option>';
          }
         ?>
      </select>

      <label>Status</label>
      <select class="form-control" name="status">
        <option selected></option>
        <option>BRAK</option>
        <option>WYSŁANO</option>
        <option>DOSTARCZONO</option>
      </select>

      <label>Godzina Wysłania</label>
      <input type="time" name="godz_wys" maxlength="9"  class="form-control">

      <label>Godzina Dostarczenia</label>
      <input type="time" name="godz_dos" maxlength="9"  class="form-control">


      <label>Waga[KG]</label>
      <input type="number" name="WAGA" maxlength="9"  class="form-control">


      <label>Nazwa</label>
      <input type="text" name="NAZWA" maxlength="30"  class="form-control">


  </div>

  <div class="form-group">
      <button class="btn btn-primary">Szukaj</button>

  </div>


</form>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

        <th>Nr_paczki</th>
        <th>Nr_kuriera</th>
        <th>Nr_magazynu</th>
        <th>Nr_klienta</th>
        <th>STATUS</th>
        <th>Godz_wysłania</th>
        <th>Godz_dostarczenia</th>
        <th>Waga[KG]</th>
        <th>Nazwa</th>

        <th>Edycja</th>
        <th>Edycja czasu</th>
        <th>Usuwanie</th>
      </tr>
      </thead>
</div>
  <?php
      while (($paczka = oci_fetch_array($cur00, OCI_BOTH))) {

   ?>

   <tr>

     <td><?php  echo  $paczka['ID_PACZKI'];   ?></td>
     <td><a href="index.php?v=paczki/show_kurier&id=<?php  echo  $paczka['ID_KURIERA'];  ?>" class="btn btn-info">
       Pokaż kuriera <?php  echo  $paczka['ID_KURIERA'];   ?></a> </td>
     <td><a href="index.php?v=paczki/show_magazyn&id=<?php  echo  $paczka['ID_MAGAZYNU'];   ?>" class="btn btn-info">
       Pokaż magazyn <?php  echo  $paczka['ID_MAGAZYNU'];   ?></a>  </td>
     <td><a href="index.php?v=paczki/show_klient&id=<?php  echo  $paczka['ID_KLIENTA'];   ?>" class="btn btn-info">
       Pokaż odbiorce <?php  echo  $paczka['ID_KLIENTA'];   ?></a>   </td>
     <td><?php  echo  $paczka['STATUS'];   ?> </td>
     <td><?php  echo  $paczka['GODZ_WYS'];   ?> </td>
     <td><?php  echo  $paczka['GODZ_DOS'];   ?> </td>
     <td><?php  echo  $paczka['WAGA'];   ?> </td>
     <td><?php  echo  $paczka['NAZWA'];   ?> </td>

     <td>
        <a href="index.php?v=paczki/edit_paczka&id=<?php echo $paczka['ID_PACZKI']; ?>" class="btn btn-success">Edytuj</a>

      </td>
      <td>
         <a href="index.php?v=paczki/edit_data_paczka&id=<?php echo $paczka['ID_PACZKI']; ?>" class="btn btn-success">Edytuj czas</a>

       </td>
     <td>
        <a onclick="return confirm('Usunąć ten rekord?')" href="index.php?v=paczki/delete_paczka&id=<?php echo $paczka['ID_PACZKI']; ?>" class="btn btn-danger">Usuń</a>
      </td>

   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur00);
oci_close($conn);
 ?>
