<?php
  error_reporting(E_ALL);
  session_start();
  require_once 'functions.php';

  $fileName = __DIR__ . '/files/login.json';
  $userList = getJSON($fileName);
  
  if (!empty($_POST)) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $id = count($userList) + 1;
    $error = false;
  
    foreach ($userList as $user) {
      if ($user['login'] === $login) {
        $error = true;
      }
    }
    if (!$error) {
      $userList[] = ['login' => $login, 'password' => $password, 'name' => $name, 'id' => $id];
      $reg = jsonEncode($userList, $fileName);
      if ($reg) {
        header('Location: index.php');
        die;
      }
    } else {
      echo 'Такой пользователь уже зарегистрирован!';
    }
  }
  
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
  </head>
  <body>
  <form method="post">
    <label for="login">Логин</label>
    <input type="text" name="login" id="login">
    <br>
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <br>
    <label for="name">Ваше имя</label>
    <input type="text" name="name" id="name">
    <br>
    <button type="submit">Зарегистрироваться</button>
  </form>
  </body>
</html>
