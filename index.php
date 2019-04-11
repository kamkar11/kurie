<?php

include('db/pdo.php');
include('utils/utils.php');

//dump($_GET);



  if(array_key_exists('v',$_GET)){
    $module = $_GET['v'];
  }
  else{
      $module = 'klienci';
  }

/*
    if($module == 'klienci'){
      include('modules/klienci.php');
    }
    if($module == 'pojazdy'){
      include('modules/pojazdy.php');
    }
    if($module == 'magazyny'){
      include('modules/magazyny.php');
    }
*/

  $moduleDir = 'modules/' . $module . '.php';



  if(file_exists($moduleDir)){

       ob_start();
       include($moduleDir);
       $content = ob_get_contents();
       ob_end_clean();

       include('layouts/admin.php');
    }
    else {
      header("HTTP/1.1 404 Not Found");
      echo '404';
    }
  ?>
