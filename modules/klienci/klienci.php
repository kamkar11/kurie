</br></br>

<h1>Klienci</h1>

<?php
/*
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">


<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php?v=klienci">Klienci</a></li>
<li class="breadcrumb-item"><a href="index.php?v=pojazdy">Pojazdy</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="index.php?v=magazyny">Magazyny</a></li>
</ol>
</nav>
*/
  $result = $pdo->query('SELECT * FROM klienci ORDER BY ID_KLIENTA DESC');
  $klienci = $result->fetchAll();
  //dump($klienci);

 ?>

</br>
<a href="index.php?v=klienci/add_klient" class="btn btn-primary btn-lg">Dodaj klienta</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
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
      </thead>
</div>
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
          <a href="index.php?v=klienci/edit_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a href="index.php?v=klienci/delete_klient&id=<?php echo $klient['ID_KLIENTA']; ?>" class="btn btn-danger">Usuń</a>
        </td>

   </tr>

  <?php } ?>



</table>
