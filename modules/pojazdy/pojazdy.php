</br></br>
<h1>Pojazdy</h1>


<?php

/*
  $result = $pdo->query('SELECT * FROM pojazdy ORDER BY ID_POJAZDU DESC');
  $pojazdy = $result->fetchAll();
  //dump($klienci);
*/

$cur = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin POJAZDY_ALL(:PLOUG_CURSOR); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cur);
 ?>

</br>
<a href="index.php?v=pojazdy/add_pojazd" class="btn btn-primary btn-lg">Dodaj pojazd</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>

          <th>Marka</th>
          <th>Model</th>
          <th>Nr_rej</th>
          <th>Poj_pojazdu[KG]</th>
          <th>Edycja</th>
          <th>Usuwanie</th>
      </tr>
      </thead>
</div>
  <?php
      while (($pojazd = oci_fetch_array($cur, OCI_BOTH))) {

   ?>

   <tr>
       <td><?php  echo $pojazd['MARKA'];   ?></td>
       <td><?php  echo $pojazd['MODEL_POJAZDU'];   ?></td>
       <td><?php  echo $pojazd['NR_REJESTRACYJNY'];   ?> </td>
       <td><?php  echo $pojazd['POJ_POJAZDU'];   ?> </td>
       <td>
          <a href="index.php?v=pojazdy/edit_pojazd&id=<?php echo $pojazd['ID_POJAZDU']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a onclick="return confirm('Usunąć ten rekord?')" href="index.php?v=pojazdy/delete_pojazd&id=<?php echo $pojazd['ID_POJAZDU']; ?>" class="btn btn-danger">Usuń</a>
        </td>

   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
