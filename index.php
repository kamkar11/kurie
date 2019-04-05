<?php
/*
$tablica = [1,2,3,4,5];

echo $tablica[0].'<br/>';

$n = count($tablica);
for ($i=0; $i < $n ; $i++) {
  // code...
  echo $tablica[$i].'<br/>';
}
*/
include('utils/utils.php');
/*
$tablica = [1,2,3,4,5];

dump($tablica);
*/
dump($_GET);
 ?>

 <a href="index.php?v=klienci">Klienci</a>
 <a href="index.php?v=pojazdy">Pojazdy</a>
 <a href="index.php?v=magazyny">Magazyny</a>
 <hr>

 <?php
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

      include($moduleDir);
    }
    else {
      header("HTTP/1.1 404 Not Found");
      echo '404';
    }
  ?>
