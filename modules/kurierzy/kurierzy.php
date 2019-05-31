</br></br>

<h1>Kurierzy</h1>

<?php

    $cur = oci_new_cursor($conn);
    $stmt = oci_parse($conn, "begin KURIERZY_ALL(:PLOUG_CURSOR); end;");
    oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);
    oci_execute($stmt);
    oci_execute($cur);






/*
  $result = $pdo->query('SELECT * FROM klienci ORDER BY ID_KLIENTA DESC');
  $klienci = $result->fetchAll();
  //dump($klienci);
*/
//$result = $pdo->prepare("klienciall();");

//"begin TOOLS_PKG.getOrgCode(?); end;"
//"CALL klienciall()"

//$stmt->bindParam(1, 'hai!', PDO::PARAM_STR);
//$rs = $stmt->execute();

//$klienci = $result->fetchAll();

// PDO::FETCH_ASSOC
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
          <th>ID pojazd</th>
          <th>Marka</th>
          <th>Model</th>
          <th>godz_roz_pracy</th>
          <th>godz_zak_pracy</th>
          <th>Edycja</th>
          <th>Usuwanie</th>
      </tr>
      </thead>
</div>
  <?php
    //foreach ($klienci as $klient) {
    while (($kurier = oci_fetch_array($cur, OCI_BOTH))) {
   ?>

   <tr>

       <td><?php  echo  $kurier['IMIE'];   ?></td>
       <td><?php  echo  $kurier['NAZWISKO'];   ?></td>
       <td><?php  echo  $kurier['EMAIL'];   ?> </td>
       <td><?php  echo  $kurier['TEL_PRACA'];   ?> </td>
       <td><?php  echo  $kurier['TEL_PRYWATNY'];   ?> </td>
       <td><?php  echo  $kurier['ID_POJAZDU'];   ?> </td>
       <td><?php  echo  $kurier['MARKA'];   ?> </td>
       <td><?php  echo  $kurier['MODEL_POJAZDU'];   ?> </td>
       <td><?php  echo  $kurier[9];   ?> </td>
       <td><?php  echo  $kurier[10];   ?> </td>
       <td>
          <a href="index.php?v=kurierzy/edit_kurier&id=<?php echo $kurier['ID_KURIERA']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a onclick="return confirm('Usunąć ten rekord?')" href="index.php?v=kurierzy/delete_kurier&id=<?php echo $kurier['ID_KURIERA']; ?>" class="btn btn-danger">Usuń</a>
        </td>

   </tr>

  <?php } ?>




</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
