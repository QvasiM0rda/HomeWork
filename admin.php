<?php
  error_reporting(E_ALL);
  session_start();
  require_once 'functions.php';
  
  if ($_SESSION['login'] === 'guest') {
    header('HTTP/1.0 404 Not Found');
    header('HTTP/1.1 404 Not Found');
    header('Status: 404 Not Found');
    die();
  }
  
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