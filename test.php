<?php
  error_reporting(E_ALL);

  if (isset($_GET['test_number'])) {

    $testNumber = $_GET['test_number'] - 1;

    $testListFile = file_get_contents('test_list.json');
    $testList = json_decode($testListFile, true);
  
    $testFileName = __DIR__ . '/files/' . $testList[$testNumber]['name'];

    $testFile = file_get_contents($testFileName);
    $test = json_decode($testFile, true);

    $question = $test[0]['question'];
    $type = '"' . $test[0]['type'] . '"';
    $name = '"' . $test[0]['name'] . '"';
    $result = $test[0]['result'];
    $id = '"' . $test[0]['id'] . '"';

    if (isset($_POST['answer'])) {
      $resultGet = $_POST['answer'];
      $resultInt = (int) $resultGet;
      if ($resultInt === $result) {
        $res = 'Правильно';
      } else {
        $res = 'Не правильно';
      }
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
    <?php if(isset($res)) { echo $res; } ?>
    <form method="post">
      <label for=<?= $id; ?> > <?= $question; ?> </label>
      <input type=<?= $type; ?> name=<?= $name; ?> id=<?= $id; ?>>
      <br>
      <button value="answer">Ответить</button>
    </form>
  </body>
</html>