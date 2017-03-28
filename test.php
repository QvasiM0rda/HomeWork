<?php
  error_reporting(E_ALL);

  if (isset($_GET['test_number'])) {

    $testNumber = $_GET['test_number'] - 1;

    $testListFile = file_get_contents('test_list.json');
    $testList = json_decode($testListFile, true);
  
    $testFileName = __DIR__ . '/files/' . $testList[$testNumber]['name'];

    $testFile = file_get_contents($testFileName);
    $testArray = json_decode($testFile, true);

    if (isset($_POST[1])) {
      for ($i=1; $i<=count($testArray); $i++){
        $answer = $_POST[$i];
        if ($answer === $testArray[$i-1]['result']) {
          $resultArray[$i] = 'Вопрос №' . $i . ' - Правильно';
        } else {
          $resultArray[$i] = 'Вопрос №' . $i . ' - Не правильно';
        }
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
    <?php
      if(isset($resultArray)){
        foreach ($resultArray as $results) {
          echo $results . '<br>';
        }
        die;
      } ?>
    <form method="POST">
      <?php foreach ($testArray as $test) {
      $question = $test['question'];
      $type = '"' . $test['type'] . '"';
      $name = '"' . $test['name'] . '"';
      $id = '"' . $test['id'] . '"';
      $result = $test['result'];

      $formLabel = '<label for=' . $id .'>' . $question . '</label>';
      $formInput = '<input type=' . $type . ' name=' . $name . ' id=' . $id .  '>' ?>
      <?= $formLabel; ?>
      <?= $formInput; ?>
      <br>
      <?php } ?>
      <button>Ответить</button>
    </form>
  </body>
</html>