</br></br>

<h1>Szukanie magazynu</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/
  $cur = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin MAGAZYNY_FIND(:PLOUG_CURSOR, :id_mag, :m, :ul, :nr, :reg); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

  oci_bind_by_name($stmt, ":m",  $_POST['miasto']);
  oci_bind_by_name($stmt, ":ul",  $_POST['ulica']);
  oci_bind_by_name($stmt, ":nr",  $_POST['numer']);
  oci_bind_by_name($stmt, ":reg",  $_POST['region']);

  oci_bind_by_name($stmt, ":id_mag",  $_POST['id']);

  oci_execute($stmt);
  oci_execute($cur);



 ?>

</br>
<form method="post">
  <div class="form-group">
      <label>Miasto</label>
      <input type="text" name="miasto"  maxlength="30" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica"  maxlength="30" class="form-control">

      <label>Numer</label>
      <input type="text" name="numer"  maxlength="5" class="form-control">

      <label>Region</label>


      <select class="form-control" name="region" >
        <option selected>  </option>
        <option>Dolnośląskie</option>
        <option>Kujawsko-pomorskie</option>
        <option>Lubelskie</option>
        <option>Lubuskie</option>
        <option>Łódzkie</option>
        <option>Małopolskie</option>
        <option>Mazowieckie</option>
        <option>Opolskie</option>
        <option>Podkarpackie</option>
        <option>Podlaskie</option>
        <option>Pomorskie</option>
        <option>Śląskie</option>
        <option>Świętokrzyskie</option>
        <option>Warmińsko-mazurskie</option>
        <option>Wielkopolskie</option>
        <option>Zachodniopomorskie</option>
      </select>



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

          <th>Miasto</th>
          <th>Ulica</th>
          <th>Numer</th>
          <th>Województwo</th>

      </tr>
      </thead>
</div>
  <?php
      while (($magazyny = oci_fetch_array($cur, OCI_BOTH))) {

   ?>

   <tr>

       <td><?php  echo $magazyny['MIASTO'];   ?></td>
       <td><?php  echo $magazyny['ULICA'];   ?></td>
       <td><?php  echo $magazyny['NUMER'];   ?> </td>
       <td><?php  echo $magazyny['REGION'];   ?> </td>
      

   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
