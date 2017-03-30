<?php
  error_reporting(E_ALL);
  
  if  (isset($_POST['redirect'])) {
    header("Location: list.php");
  }

  function fileList ($testName) {
    $fileListName = __DIR__ . '/files/test_list.json';
    if (!file_exists($fileListName)) {
      $file = fopen($fileListName, 'w');
      fclose($file);
    }

    $testList = file_get_contents($fileListName);
    $testListDecoded = json_decode($testList, true);
    $testListDecoded[] = $testName;

    $testListEncoded = json_encode($testListDecoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($fileListName, $testListEncoded);
  }

  function fileMove ($file) {
    if ($file !== '') {
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $filePath = __DIR__ . '/files/' . $fileName;
      $fileMoved = move_uploaded_file($fileTmpName, $filePath);
      if ($fileMoved === true) {
        $moveResult = 'Файл успешно загружен!';
        fileList($fileName);
      } else {
        $moveResult = 'Файл не был загружен!';
      }
      return ($moveResult);
    }
  }

  $uploadedFile = isset($_FILES['file_upload']) ? $_FILES['file_upload'] : '';
  echo fileMove($uploadedFile);

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Форма для загрузки файлов</title>
  </head>
  <body>
    <?php if (isset($moveResult)) { echo $moveResult; } ?>
    <form enctype="multipart/form-data" action="admin.php" method="post">
      <input type="file" name="file_upload">
      <input type="submit" value="Отправить">
      <br>
      <button name="redirect">Перейти к списку тестов</button>
    </form>
  </body>
</html>