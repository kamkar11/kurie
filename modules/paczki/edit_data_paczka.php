



<?php
if(!isset($_GET['id'])){
    header('location: index.php?v=paczki/paczki');
}





$cur00 = oci_new_cursor($conn);
$stmt = oci_parse($conn, "begin PACZKI_ALL_ID(:PLOUG_CURSOR, :id); end;");
oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur00, -1, OCI_B_CURSOR);
oci_bind_by_name($stmt, ":id",  $_GET['id']);
oci_execute($stmt);
oci_execute($cur00);

$paczka = oci_fetch_array($cur00, OCI_BOTH);
if ($paczka['STATUS'] == "WYSŁANO") {

  //echo $paczka['STATUS'];
  if(isset( $_POST['godz_dos']
  )){


           $stmt = oci_parse($conn, "begin UPDATE_PACZKA_IF_WYS( :id , :godz_dos
                                                         ); end;");

           //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);



           oci_bind_by_name($stmt, ":godz_dos",  $_POST['godz_dos']);
            oci_bind_by_name($stmt, ":id",  $_GET['id']);

           //oci_bind_by_name($stmt, ":id",  $_GET['id']);

           oci_execute($stmt);


      header('location: index.php?v=paczki/paczki');

//  header('location: index_kurier.php?v=paczki/STATUS_BRAK');

} else{
  echo '
  </br>
  <h1>Edycja paczki</h1>

  <form method="post" >
    <div class="form-group">





        <label>Godzina Dostarczenia</label>
        <input type="time" name="godz_dos" maxlength="9"  class="form-control">




    </div>

    <div class="form-group">
        <button class="btn btn-primary">Zapisz</button>

    </div>


  </form>';
}

  // header('location: index_kurier.php?v=paczki/STATUS_WYSLANO');
}

if($paczka['STATUS'] == "BRAK"){
//  echo 'tak';



  if(isset( $_POST['godz_wys']
  )){


           $stmt = oci_parse($conn, "begin UPDATE_PACZKA_WYS( :id ,:godz_wys
                                                         ); end;");

           //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);


           oci_bind_by_name($stmt, ":godz_wys",  $_POST['godz_wys']);
            oci_bind_by_name($stmt, ":id",  $_GET['id']);

           //oci_bind_by_name($stmt, ":id",  $_GET['id']);

           oci_execute($stmt);


      header('location: index.php?v=paczki/paczki');

//  header('location: index_kurier.php?v=paczki/STATUS_BRAK');

} else{
echo '
</br>
<h1>Edycja paczki</h1>

<form method="post" >
  <div class="form-group">

      <label>Godzina Wysłania</label>
      <input type="time" name="godz_wys" maxlength="9"  class="form-control">

  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>';
}
}


if($paczka['STATUS'] == "DOSTARCZONO"){
//  echo 'tak';



if(isset( $_POST['godz_wys'], $_POST['godz_dos']
)){


         $stmt = oci_parse($conn, "begin UPDATE_PACZKA_DOS( :id ,:godz_wys, :godz_dos
                                                       ); end;");

         //oci_bind_by_name($stmt, ":PLOUG_CURSOR", $cur, -1, OCI_B_CURSOR);


         oci_bind_by_name($stmt, ":godz_wys",  $_POST['godz_wys']);
         oci_bind_by_name($stmt, ":godz_dos",  $_POST['godz_dos']);
          oci_bind_by_name($stmt, ":id",  $_GET['id']);

         //oci_bind_by_name($stmt, ":id",  $_GET['id']);

         oci_execute($stmt);


    header('location: index.php?v=paczki/paczki');

//  header('location: index_kurier.php?v=paczki/STATUS_BRAK');

} else{
echo '
</br>
<h1>Edycja paczki</h1>

<form method="post" >
  <div class="form-group">



      <label>Godzina Wysłania</label>
      <input type="time" name="godz_wys" maxlength="9"  class="form-control">

      <label>Godzina Dostarczenia</label>
      <input type="time" name="godz_dos" maxlength="9"  class="form-control">




  </div>

  <div class="form-group">
      <button class="btn btn-primary">Zapisz</button>

  </div>


</form>';
}

// header('location: index_kurier.php?v=paczki/STATUS_WYSLANO');
}

?>
