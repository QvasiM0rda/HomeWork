<?php
  error_reporting(E_ALL);
  
  $fileName = __DIR__ . '/test_list.json';
  $testFile = file_get_contents($fileName);
  $testFileDecoded = json_decode($testFile, true);
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
  	<title>Список загруженных тестов</title>
  </head>
  <body>
    <?php foreach ($testFileDecoded as $testFileName) { ?>
    	<p><?= $testFileName['name']; ?></p>
    <?php } ?>
    <form method="GET" action="test.php">
      <label for="test_number">Введите номер теста: </label>
    	<input type="text" name="test_number" id="test_number">
    	<button>Перейти к тесту</button>
    </form>
  </body>
</html>