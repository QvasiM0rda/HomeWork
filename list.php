<?php
  error_reporting(E_ALL);
  session_start();
  require_once 'functions.php';
  
  $fileName = __DIR__ . '/files/test_list.json';
  $testFile = getJSON($fileName);

  if ($_SESSION['login'] !== 'guest') {
    $addTest = '<button type="submit" name="add_test">Добавить тест</button>';
  }
  
  if (isset($_GET['add_test'])) {
    header('Location: admin.php');
    die;
  }
  if (isset($_GET['to_test'])) {
    $_SESSION['test_number'] = $_GET['test_number'];
    header('Location: test.php');
    die;
  }
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
    <form method="GET">
      <label for="test_number">Введите номер теста: </label>
    	<input type="text" name="test_number" id="test_number">
    	<button type="submit" name="to_test">Перейти к тесту</button>
      <?php if(!empty($addTest)) { echo $addTest; } ?>
    </form>
  </body>
</html>