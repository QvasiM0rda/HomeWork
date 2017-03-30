<?php
  error_reporting(E_ALL);
  session_start();

  function getContent ($fileName) {
    $content = file_get_contents($fileName);
    $data = json_decode($content, true);
    return ($data);
  }

  if (isset($_GET['test_number'])) {
    $testListDir = __DIR__ . '/files/test_list.json';    
    $testList = getContent($testListDir);
    
    $testNumber = $_GET['test_number'];

    if ($testNumber > count($testList)) {
      header('HTTP/1.0 404 Not Found');
      header('HTTP/1.1 404 Not Found');
      header('Status: 404 Not Found');
      die();
    } else {
      $testFileName = __DIR__ . '/files/' . $testList[$testNumber - 1];
    }

    $testArray = getContent($testFileName);
    $rightAnswer = 0;
    $_SESSION['test_number'] = $testNumber;

    if (isset($_POST[1])) {
      $arrayLength = count($testArray);
      for ($i=1; $i<=$arrayLength; $i++){
        $answer = $_POST[$i];

        if ($answer === $testArray[$i-1]['result']) {
          $resultArray[$i] = 'Вопрос №' . $i . ' - Правильно';
          $rightAnswer++;
        } else {
          $resultArray[$i] = 'Вопрос №' . $i . ' - Не правильно';
        }
      }

      if ($rightAnswer === $arrayLength) {
        $_SESSION['rate'] = 'Отлично!';
      } else {
        $_SESSION['rate'] = 'Нармаальна';
      }

      if ($rightAnswer === 0) {
        $_SESSION['rate'] = 'Плохо :(';
      }

      $_SESSION['name'] = $_POST['fio'];
      
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
      <label for="fio">Введите Ваше имя и фамилию</label>
      <input type="text" name="fio" id="fio">
      <button>Ответить</button>
    </form>
  </body>
</html>