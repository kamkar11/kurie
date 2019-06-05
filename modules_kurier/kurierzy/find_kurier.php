</br></br>

<h1>Szukanie kuriera</h1>

<?php

/*
  $result = $pdo->query('SELECT * FROM magazyny ORDER BY ID_MAGAZYNU DESC');
  $magazyny = $result->fetchAll();
  //dump($klienci);
*/
  $cur = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin KURIERZY_FIND(:PLOUG_CURSOR, :id_kur, :imie, :nazwisko, :email, :tel_praca, :tel_prywatny, :pojazd,
                              :godz_roz_pracy,:godz_zak_pracy,:login); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);

  oci_bind_by_name($stmt, ":imie",  $_POST['imie']);
  oci_bind_by_name($stmt, ":nazwisko",  $_POST['nazwisko']);
  oci_bind_by_name($stmt, ":email",  $_POST['email']);
  oci_bind_by_name($stmt, ":tel_praca",  $_POST['tel_praca']);
  oci_bind_by_name($stmt, ":tel_prywatny",  $_POST['tel_prywatny']);
  oci_bind_by_name($stmt, ":pojazd",  $_POST['pojazd']);
  oci_bind_by_name($stmt, ":godz_roz_pracy",  $_POST['godz_roz_pracy']);
  oci_bind_by_name($stmt, ":godz_zak_pracy",  $_POST['godz_zak_pracy']);
  oci_bind_by_name($stmt, ":login",  $_POST['login']);


  oci_bind_by_name($stmt, ":id_kur",  $_POST['id']);

  oci_execute($stmt);
  oci_execute($cur);


  $cur2 = oci_new_cursor($conn);
  $stmt = oci_parse($conn, "begin POJAZDY_ALL(:PLOUG_CURSOR); end;");
  oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur2, -1, OCI_B_CURSOR);
  oci_execute($stmt);
  oci_execute($cur2);



 ?>

</br>
<form method="post">
  <div class="form-group">
      <label>Imie</label>
      <input type="text" name="imie" maxlength="30" class="form-control">

      <label>Nazwisko</label>
      <input type="text" name="nazwisko" maxlength="60" class="form-control">

      <label>Email</label>
      <input type="email" name="email" maxlength="60" class="form-control">

      <label>Tel_praca</label>
      <input type="text" name="tel_praca" maxlength="9" class="form-control">

      <label>Tel_prywatny</label>
      <input type="text" name="tel_prywatny" maxlength="9"  class="form-control">

      <label>Pojazd</label>
      <select class="form-control" name="pojazd">
        <?php
          echo '<option selected  >';
          echo " ";
          echo '</option>';
          while (($pojazd = oci_fetch_array($cur2, OCI_BOTH))) {
            echo '<option value="' . $pojazd['ID_POJAZDU'] . '" >';
            echo "(".$pojazd['NR_REJESTRACYJNY'].")"." ".$pojazd['MARKA']." ".$pojazd['MODEL_POJAZDU'];
            echo '</option>';
          }
         ?>
      </select>

      <label>godz_roz_pracy</label>
      <input type="time" name="godz_roz_pracy"  class="form-control">

      <label>godz_zak_pracy</label>
      <input type="time" name="godz_zak_pracy"  class="form-control">

      <label>Login</label>
      <input type="text" name="login" maxlength="60" class="form-control">



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
        <th>email</th>
        <th>tel_praca</th>
        <th>tel_prywatny</th>
        <th>Pojazd</th>
        <th>godz_roz_pracy</th>
        <th>godz_zak_pracy</th>
        <th>Edycja</th>
        <th>Usuwanie</th>
      </tr>
      </thead>
</div>
  <?php
      while (($kurier = oci_fetch_array($cur, OCI_BOTH))) {

   ?>

   <tr>

     <td><?php  echo  $kurier['IMIE'];   ?></td>
     <td><?php  echo  $kurier['NAZWISKO'];   ?></td>
     <td><?php  echo  $kurier['EMAIL'];   ?> </td>
     <td><?php  echo  $kurier['TEL_PRACA'];   ?> </td>
     <td><?php  echo  $kurier['TEL_PRYWATNY'];   ?> </td>
     <td><a href="index_kurier.php?v=pojazdy/show_pojazd&id=<?php  echo  $kurier['ID_POJAZDU'];   ?>" class="btn btn-info">
       Pokaż pojazd <?php  echo  $kurier['ID_POJAZDU'];   ?></a>  </td>
     <td><?php  echo  $kurier[7];   ?> </td>
     <td><?php  echo  $kurier[8];   ?> </td>


   </tr>

  <?php } ?>



</table>

<?php
oci_free_statement($stmt);
oci_free_statement($cur);
oci_close($conn);
 ?>
