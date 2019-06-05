<?php


if(!isset($_GET['id'])){
    header('location: index.php?v=paczki/paczki');
}


$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SELECT_MAGAZYN_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$magazyn = oci_fetch_array($cur, OCI_BOTH);


 ?>


</br>

</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

          <th>Miasto</th>
          <th>Ulica</th>
          <th>Numer</th>
          <th>Województwo</th>

      </tr>
      </thead>
</div>


   <tr>

       <td><?php  echo $magazyn['MIASTO'];   ?></td>
       <td><?php  echo $magazyn['ULICA'];   ?></td>
       <td><?php  echo $magazyn['NUMER'];   ?> </td>
       <td><?php  echo $magazyn['REGION'];   ?> </td>


   </tr>





</table>
