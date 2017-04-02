<?php
  error_reporting(E_ALL);
  session_start();
  require_once 'functions.php';
  
  if (isset($_SESSION['test_number'])) {
    $testListDir = __DIR__ . '/files/test_list.json';    
    $testList = getJSON($testListDir);
    
    $testNumber = (int)$_SESSION['test_number'];
    $_SESSION['test_number'] = $testNumber;
    
    $testArray = getTest($testList, $testNumber);
    
    if (!$testArray) {
      header('HTTP/1.0 404 Not Found');
      header('HTTP/1.1 404 Not Found');
      header('Status: 404 Not Found');
      die();
    }
    
    if (!empty($_POST)) {
      $result = testResult($_POST, $testArray);
      header ('Location: sert.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Тест</title>
  </head>
  <body>
    <?php
      if(isset($result)){
        foreach ($result as $results) {
          echo $results . '<br>';
        }
        die;
      } ?>
    <form method="POST">
      <?php
        if (!empty($testArray)) {
          $formOutput = form($testArray);
        } else {
            echo '<p>Тест не выбран</p>';
            die;
        }
        foreach ($formOutput as $output) {
          echo $output['label'];
          echo $output['input'];
          echo '<br>';
        }
      ?>
      <button>Ответить</button>
    </form>
  </body>
</html>
