</br></br>

<h1>Kurier</h1>

<?php

if(!isset($_GET['id'])){
    header('location: index.php?v=paczki/paczki');
}

$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin SHOW_KURIER_ID(:id, :PLOUG_CURSOR); end;");

oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);

oci_execute($stmt);
oci_execute($cur);
$kurier = oci_fetch_array($cur, OCI_BOTH);



 ?>

</br>
<a href="index.php?v=kurierzy/add_kurier" class="btn btn-primary btn-lg">Dodaj kuriera</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

          <th>imie</th>
          <th>nazwisko</th>
          <th>email</th>
          <th>tel_praca</th>
          <th>tel_prywatny</th>
          <th>NR_rejestracyjny</th>
          <th>Marka</th>
          <th>Model</th>
          <th>godz_roz_pracy</th>
          <th>godz_zak_pracy</th>

      </tr>
      </thead>
</div>


   <tr>

       <td><?php  echo  $kurier['IMIE'];   ?></td>
       <td><?php  echo  $kurier['NAZWISKO'];   ?></td>
       <td><?php  echo  $kurier['EMAIL'];   ?> </td>
       <td><?php  echo  $kurier['TEL_PRACA'];   ?> </td>
       <td><?php  echo  $kurier['TEL_PRYWATNY'];   ?> </td>
       <td><?php  echo  $kurier['NR_REJESTRACYJNY'];   ?> </td>
       <td><?php  echo  $kurier['MARKA'];   ?> </td>
       <td><?php  echo  $kurier['MODEL_POJAZDU'];   ?> </td>
       <td><?php  echo  $kurier[9];   ?> </td>
       <td><?php  echo  $kurier[10];   ?> </td>


   </tr>






</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
