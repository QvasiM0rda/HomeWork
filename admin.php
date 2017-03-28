<?php
  error_reporting(E_ALL);
  
  if  (isset($_POST['redirect'])) {
    header("Location: list.php");
  }

  $uploadedFile = isset($_FILES['file_upload']) ? $_FILES['file_upload'] : '';
  if ($uploadedFile !== '') {
    $uploadedFileName = $uploadedFile['name'];
    $uploadedFileTmpName = $uploadedFile['tmp_name'];
    $uploadedFilePath = __DIR__ . '/files/' . $uploadedFileName;
    $fileMoved = move_uploaded_file($uploadedFileTmpName, $uploadedFilePath);
    if ($fileMoved) {
      $moveResult = 'Файл успешно загружен!';
      $fileName = __DIR__ . '/test_list.json';
      $testList = file_get_contents($fileName);
      $testListDecoded = json_decode($testList);
      $testListDecoded[] = ['name' => $uploadedFileName];
      file_put_contents($fileName, json_encode($testListDecoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    } else {
      $moveResult = 'Файл не был загружен!';
    }
  }
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