</br></br>

<h1>Szukanie klienci</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/
  $cur = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin POJAZDY_FIND(:PLOUG_CURSOR, :id_poj, :marka, :model_pojazdu, :nr_rejestracyjny, :poj_pojazdu ); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

  oci_bind_by_name($stmt, ":marka",  $_POST['marka']);
  oci_bind_by_name($stmt, ":model_pojazdu",  $_POST['model_pojazdu']);
  oci_bind_by_name($stmt, ":nr_rejestracyjny",  $_POST['nr_rejestracyjny']);
  oci_bind_by_name($stmt, ":poj_pojazdu",  $_POST['poj_pojazdu']);

  oci_bind_by_name($stmt, ":id_poj",  $_POST['id']);

  oci_execute($stmt);
  oci_execute($cur);



 ?>

</br>
<form method="post">
  <div class="form-group">
    <label>Marka</label>
    <input type="text" name="marka"  maxlength="30" class="form-control">

    <label>Model</label>
    <input type="text" name="model_pojazdu"  maxlength="30" class="form-control">

    <label>Nr_rejestracyjny</label>
    <input type="text" name="nr_rejestracyjny"  maxlength="7" class="form-control">

    <label>Pojemność pojazdu</label>
    <input type="number" name="poj_pojazdu"   class="form-control">

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
