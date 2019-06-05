


</br></br>

<h1>Paczki</h1>

<?php

    $cur = oci_new_cursor($conn);
    $stmt = oci_parse($conn, "begin PACZKI_ALL_KURIER(:PLOUG_CURSOR, :id); end;");
    oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
    oci_bind_by_name($stmt, ":id",  $_SESSION["kurier_id"]);
    oci_execute($stmt);
    oci_execute($cur);

 ?>

</br>
<a href="index_kurier.php?v=paczki/find_paczka" class="btn btn-primary btn-lg">Znajdz paczke</a>
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

      </tr>
      </thead>
</div>
  <?php
    //foreach ($klienci as $klient) {
    while (($paczka = oci_fetch_array($cur, OCI_BOTH))) {
   ?>

   <tr>

       <td><?php  echo  $paczka['ID_PACZKI'];   ?></td>
       <td><a href="index_kurier.php?v=paczki/show_kurier&id=<?php  echo  $paczka['ID_KURIERA'];  ?>" class="btn btn-info">
         Pokaż kuriera <?php  echo  $paczka['ID_KURIERA'];   ?></a> </td>
       <td><a href="index_kurier.php?v=paczki/show_magazyn&id=<?php  echo  $paczka['ID_MAGAZYNU'];   ?>" class="btn btn-info">
         Pokaż magazyn <?php  echo  $paczka['ID_MAGAZYNU'];   ?></a>  </td>
       <td><a href="index_kurier.php?v=paczki/show_klient&id=<?php  echo  $paczka['ID_KLIENTA'];   ?>" class="btn btn-info">
         Pokaż odbiorce <?php  echo  $paczka['ID_KLIENTA'];   ?></a>   </td>
       <td><?php  echo  $paczka['STATUS'];   ?> </td>
       <td><?php  echo  $paczka['GODZ_WYS'];   ?> </td>
       <td><?php  echo  $paczka['GODZ_DOS'];   ?> </td>
       <td><?php  echo  $paczka['WAGA'];   ?> </td>
       <td><?php  echo  $paczka['NAZWA'];   ?> </td>

       <td>
          <a href="index_kurier.php?v=paczki/edit_paczka&id=<?php echo $paczka['ID_PACZKI']; ?>" class="btn btn-success">Edytuj</a>

        </td>


   </tr>

  <?php } ?>




</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
