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
<a href="index.php?v=magazyny/add_magazyn" class="btn btn-primary btn-lg">Dodaj magazyn</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

          <th>Miasto</th>
          <th>Ulica</th>
          <th>Numer</th>
          <th>Województwo</th>
          <th>Edycja</th>
          <th>Usuwanie</th>
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
       <td>
          <a href="index.php?v=magazyny/edit_magazyn&id=<?php echo $magazyn['ID_MAGAZYNU']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a onclick="return confirm('Usunąć ten rekord?')" href="index.php?v=magazyny/delete_magazyn&id=<?php echo $magazyn['ID_MAGAZYNU']; ?>" class="btn btn-danger">Usuń</a>

        </td>

   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
