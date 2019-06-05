



</br></br>

<h1>Magazyny</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/
  $cur = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin MAGAZYNY_ALL(:PLOUG_CURSOR); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
  oci_execute($stmt);
  oci_execute($cur);

 ?>

</br>
<a href="index_kurier.php?v=magazyny/find_magazyn" class="btn btn-primary btn-lg">Znajdz magazyn</a>
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
  <?php
      while (($magazyn = oci_fetch_array($cur, OCI_BOTH))) {

   ?>

   <tr>

       <td><?php  echo $magazyn['MIASTO'];   ?></td>
       <td><?php  echo $magazyn['ULICA'];   ?></td>
       <td><?php  echo $magazyn['NUMER'];   ?> </td>
       <td><?php  echo $magazyn['REGION'];   ?> </td>


   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
