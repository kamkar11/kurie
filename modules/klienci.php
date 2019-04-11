<h1>Klienci</h1>

<?php

  $result = $pdo->query('SELECT * FROM klienci ORDER BY ID_KLIENTA DESC');
  $klienci = $result->fetchAll();
  //dump($klienci);

 ?>


<a href="index.php?v=add_klient" class="btn btn-primary">Dodaj klienta</a>


<table class="table table-hover">

  <tr>
      <th>ID</th>
      <th>imie</th>
      <th>nazwisko</th>
      <th>ulica</th>
      <th>nr_domu</th>
      <th>miasto</th>
      <th>telefon</th>
      <th>Edycja</th>
      <th>Usuwanie</th>
  </tr>

  <?php
    foreach ($klienci as $klient) {

   ?>

   <tr>
       <td><?php  echo $klient['ID_KLIENTA'];   ?></td>
       <td><?php  echo $klient['IMIE'];   ?></td>
       <td><?php  echo $klient['NAZWISKO'];   ?></td>
       <td><?php  echo $klient['ULICA'];   ?> </td>
       <td><?php  echo $klient['NR_DOMU'];   ?> </td>
       <td><?php  echo $klient['MIASTO'];   ?> </td>
       <td><?php  echo $klient['TELEFON'];   ?> </td>
       <td>
          <a href="index.php?v=edit_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a href="index.php?v=delete_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-danger">Usuń</a>
        </td>

   </tr>

  <?php } ?>



</table>
