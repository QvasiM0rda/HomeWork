<?php
  error_reporting(E_ALL);
  require_once 'functions.php';
  
  if  (isset($_POST['redirect'])) {
    header("Location: list.php");
    die;
  }

  if (isset($_FILES['file_upload'])) {
    echo fileMove($_FILES['file_upload']);
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