<?php

  //Открывает и декодирюет JSON файл
  function getJSON ($file) {
    $content = file_get_contents($file);
    $data = json_decode($content, true);
    return $data;
  }
  
  function jsonEncode ($array, $file) {
    $data = json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $putResult = file_put_contents($file, $data);
    return $putResult;
  }
  
  
  
  //Проверяет, был ли такой файл загружен ранее
  function testCheck ($testArray, $uploadedTest) {
    foreach ($testArray as $testName) {
      if ($testName === $uploadedTest) {
        return false;
      }
    }
    return true;
  }

  //Добавляет имя файла в список файлов
  function fileList ($testName) {
    $fileListName = __DIR__ . '/files/test_list.json';
    if (!file_exists($fileListName)) {
      $file = fopen($fileListName, 'w');
      fclose($file);
    }
    
    $testList = getJSON($fileListName);
    
    if (testCheck($testList, $testName)) {
      $testList[] = $testName;
      $testListEncoded = json_encode($testList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      file_put_contents($fileListName, $testListEncoded);
      return true;
    } else {
      return false;
    }
  }

  //Перемещает загруженный файл
  function fileMove ($file) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $filePath = __DIR__ . '/files/' . $fileName;
    
    if (fileList($fileName)) {
      $fileMoved = move_uploaded_file($fileTmpName, $filePath);
    } else {
      $moveResult = 'Файл с таким именем уже загружен!';
      return $moveResult;
    }
    if ($fileMoved === true) {
      $moveResult = 'Файл успешно загружен!';
    } else {
      $moveResult = 'Файл не был загружен!';
    }
    return $moveResult;
  }
  
  //Подгружает тест по номеру, если теста в списке нет - возвращает false
  function getTest($list, $number) {
    $listLength = count($list);
    for($i = 1; $i <= $listLength; $i++) {
      if ($i === $number) {
        $testName = $list[$i - 1];
      }
    }
    if (empty($testName)) {
      return false;
    }
    $testFileName = __DIR__ . '/files/' . $testName;
    $test = getJSON($testFileName);
    return $test;
  }
  
  //Проверяет ответы
  function testResult($answerArray, $testArray) {
    $arrayLength = count($testArray);
    $rightAnswer = 0;
    $resultArray = [];
    for ($i=1; $i<=$arrayLength; $i++){
      $answer = $answerArray[$i];
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
    $_SESSION['name'] = $answerArray['fio'];
    return $resultArray;
  }
  
  //Выводит форму для ответов
  function form($array) {
    $formOutput = [];
    $i = 0;
    foreach ($array as $test) {
      $question = $test['question'];
      $type = '"' . $test['type'] . '"';
      $name = '"' . $test['name'] . '"';
      $id = '"' . $test['id'] . '"';
      $result = $test['result'];
      $label = '<label for=' . $id .'>' . $question . '</label>';
      $input = '<input type=' . $type . ' name=' . $name . ' id=' . $id .  '>';
      $formOutput[] = ['label' => $label, 'input' => $input];
    }
    return $formOutput;
  }

  function getUser ($login, $password) {
    $userListFile = __DIR__ . '/files/login.json';
    $userList = getJSON($userListFile);
    $auth = [];
    foreach ($userList as $user) {
      if ((strcmp($login, $user['login']) === 0) && (strcmp($password, $user['password']) === 0)) {
        $id = $user['id'];
        $name = $user['name'];
        $auth[] = [$login, $password, $id, $name];
        return $auth;
      }
    }
    return false;
  }