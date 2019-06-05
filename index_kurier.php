<?php

session_start();

if (!isset($_SESSION['kurier'],$_SESSION["kurier_id"] ))
{
  header('Location: login_kurier.php');
  exit();
}



include('db/pdo.php');
include('utils/utils.php');









  if(array_key_exists('v',$_GET)){
    $module = $_GET['v'];
  }
  else{
      $module = 'paczki/paczki';
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

  $moduleDir = 'modules_kurier/' . $module . '.php';



  if(file_exists($moduleDir)){

       ob_start();
       include($moduleDir);
       $content = ob_get_contents();
       ob_end_clean();

       include('layouts/kurier.php');
    }
    else {
      header("HTTP/1.1 404 Not Found");
      echo '404';
    }
  ?>
