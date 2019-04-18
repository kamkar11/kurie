</br></br>
<h1>Pojazdy</h1>


<?php


  $result = $pdo->query('SELECT * FROM pojazdy ORDER BY ID_POJAZDU DESC');
  $pojazdy = $result->fetchAll();
  //dump($klienci);

 ?>

</br>
<a href="index.php?v=pojazdy/add_pojazd" class="btn btn-primary btn-lg">Dodaj pojazd</a>
</br></br></br>

<div class="table-responsive-md">
    <table class="table table-primary table-sm ">
      <thead class="thead-dark">
      <tr>
          <th>ID</th>
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
    foreach ($pojazdy as $pojazd) {

   ?>

   <tr>
       <td><?php  echo $pojazd['ID_POJAZDU'];   ?></td>
       <td><?php  echo $pojazd['MARKA'];   ?></td>
       <td><?php  echo $pojazd['MODEL_POJAZDU'];   ?></td>
       <td><?php  echo $pojazd['NR_REJESTRACYJNY'];   ?> </td>
       <td><?php  echo $pojazd['POJ_POJAZDU'];   ?> </td>
       <td>
          <a href="index.php?v=pojazdy/edit_pojazd&id=<?php echo $pojazd['ID_POJAZDU']; ?>" class="btn btn-success">Edytuj</a>

        </td>
       <td>
          <a href="index.php?v=pojazdy/delete_pojazd&id=<?php echo $pojazd['ID_POJAZDU']; ?>" class="btn btn-danger">Usuń</a>
        </td>

   </tr>

  <?php } ?>



</table>
