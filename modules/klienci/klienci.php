</br></br>

<h1>Klienci</h1>

<?php

    $cur = oci_new_cursor($conn);
    $stmt = oci_parse($conn, "begin KLIENCI_ALL(:PLOUG_CURSOR); end;");
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
<a href="index.php?v=klienci/add_klient" class="btn btn-primary btn-lg">Dodaj klienta</a>
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
    //foreach ($klienci as $klient) {
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
