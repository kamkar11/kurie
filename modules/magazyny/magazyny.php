</br></br>

<h1>Magazyny</h1>

<?php


  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);

 ?>

</br>
<a href="index.php?v=magazyny/add_magazyn" class="btn btn-primary btn-lg">Dodaj magazyn</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>
          <th>ID</th>
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
    foreach ($magazyny as $magazyn) {

   ?>

   <tr>
       <td><?php  echo $magazyn['ID_MAGAZYNU'];   ?></td>
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
