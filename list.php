<?php
  error_reporting(E_ALL);
  require_once 'functions.php';
  
  $fileName = __DIR__ . '/files/test_list.json';
  $testFile = getJSON($fileName);
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
  	<title>Список загруженных тестов</title>
  </head>
  <body>
    <?php for ($i=1; $i<=count($testFile); $i++) {
      $testFileName = 'Тест № ' . $i . ' - ' . $testFile[$i-1]; ?>
    <p>
      <?= $testFileName; ?>
    </p>
    <?php } ?>
    <form method="GET" action="test.php">
      <label for="test_number">Введите номер теста: </label>
    	<input type="text" name="test_number" id="test_number">
    	<button>Перейти к тесту</button>
    </form>
  </body>
</html>