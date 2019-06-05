

<?php

if(!isset($_GET['id'])){
    header('location: index_kurier.php?v=klienci/klienci');
}

$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SELECT_KLIENT_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$klient = oci_fetch_array($cur, OCI_BOTH);

 ?>


</br>

</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

        <th>imie</th>
        <th>nazwisko</th>
        <th>ulica</th>
        <th>nr_domu</th>
        <th>miasto</th>
        <th>telefon</th>

      </tr>
      </thead>
</div>


   <tr>

     <td><?php  echo  $klient['IMIE'];   ?></td>
     <td><?php  echo  $klient['NAZWISKO'];   ?></td>
     <td><?php  echo  $klient['ULICA'];   ?> </td>
     <td><?php  echo  $klient['NR_DOMU'];   ?> </td>
     <td><?php  echo  $klient['MIASTO'];   ?> </td>
     <td><?php  echo  $klient['TELEFON'];   ?> </td>


   </tr>





</table>
