<?php
  error_reporting(E_ALL);
  session_start();
  require_once 'functions.php';
  
  if (!empty($_POST)) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $auth = getUser($login, $password);
    
    if ($auth) {
      $id = $auth[0][2];
      $name = $auth[0][3];
      $_SESSION['login'] = $login;
      $_SESSION['password'] = $password;
      $_SESSION['user_name'] = $name;
      $_SESSION['user_id'] = $id;
      header('Location: list.php');
      die;
    } else {
      $authError = '<p>Неверный логин или пароль</p>';
      unset($_SESSION['login']);
      unset($_SESSION['password']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_id']);
    }
  }

  if (!empty($_POST['guest'])) {
    if ($_POST['guest'] === 'on' && !empty($_POST['login']))  {
      $_SESSION['login'] = 'guest';
      unset($_SESSION['password']);
      $_SESSION['user_name'] = $_POST['login'];
      unset($_SESSION['user_id']);
      header('Location: list.php');
      die;
    }
    if (empty($_POST['login'])) {
      $authError = 'Введите имя';
    }
  }
  
  if(isset($_POST['register'])) {
    header('Location: reg.php');
  }

?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Тесты</title>
  </head>
  <body>
    <?php if (!empty($authError)) {
      echo $authError;
    } ?>
    <form method="post">
      <label for="login">Логин или имя</label>
      <input type="text" name="login" id="login">
      <br>
      <label for="password">Пароль</label>
      <input type="password" name="password" id="password">
      <br>
      <label for="guest">Войти как гость</label>
      <input type="checkbox" name="guest" id="guest">
      <br>
      <button type="submit" name="enter">Войти</button>
      <button type="submit" name="register">Зарегистрироваться</button>
    </form>
  </body>
</html>