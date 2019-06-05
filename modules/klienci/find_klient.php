</br></br>

<h1>Szukanie klienci</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/
  $cur = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin KLIENCI_FIND(:PLOUG_CURSOR, :id_kl, :imie, :nazwisko, :ulica, :nr_domu, :miasto, :telefon ); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

  oci_bind_by_name($stmt, ":imie",  $_POST['imie']);
  oci_bind_by_name($stmt, ":nazwisko",  $_POST['nazwisko']);
  oci_bind_by_name($stmt, ":ulica",  $_POST['ulica']);
  oci_bind_by_name($stmt, ":nr_domu",  $_POST['nr_domu']);
  oci_bind_by_name($stmt, ":miasto",  $_POST['miasto']);
  oci_bind_by_name($stmt, ":telefon",  $_POST['telefon']);

  oci_bind_by_name($stmt, ":id_kl",  $_POST['id']);

  oci_execute($stmt);
  oci_execute($cur);



 ?>

</br>
<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie"  maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko"  maxlength="60" class="form-control">

      <label>Ulica</label>
      <input type="text" name="ulica"  maxlength="60" class="form-control">

      <label>Nr_domu</label>
      <input type="text" name="nr_domu"  maxlength="5" class="form-control">

      <label>Miasto</label>
      <input type="text" name="miasto"  maxlength="30" class="form-control">

      <label>Telefon</label>
      <input type="text" name="telefon"  maxlength="9" class="form-control">

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

        <th>imie</th>
        <th>nazwisko</th>
        <th>ulica</th>
        <th>nr_domu</th>
        <th>miasto</th>
        <th>telefon</th>
        <th>Edycja</th>
        <th>Usuwanie</th>
      </tr>
      </thead>
</div>
  <?php
      while (($klient = oci_fetch_array($cur, OCI_BOTH))) {

   ?>

   <tr>

     <td><?php  echo  $klient['IMIE'];   ?></td>
     <td><?php  echo  $klient['NAZWISKO'];   ?></td>
     <td><?php  echo  $klient['ULICA'];   ?> </td>
     <td><?php  echo  $klient['NR_DOMU'];   ?> </td>
     <td><?php  echo  $klient['MIASTO'];   ?> </td>
     <td><?php  echo  $klient['TELEFON'];   ?> </td>
     <td>
        <a href="index.php?v=klienci/edit_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-success">Edytuj</a>

      </td>
     <td>
        <a onclick="return confirm('Usunąć ten rekord?')" href="index.php?v=klienci/delete_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-danger">Usuń</a>
      </td>

   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
