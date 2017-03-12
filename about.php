<?php
  $myName = 'Рустам';
  $myAge = '25 лет';
  $myEmail = 'darkrustam@gmail.com';
  $myCity = 'Махачкала';
  $aboutMe = 'сисадмин, начинающий веб-разработчик';
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Домашнее задание к первому уроку</title>
    <meta charset="utf-  ">
    <style>
      body {
        font-family: sans-serif;
      }

      .table-row {
        display: table-row;
      }

      .table-cell {
        display: table-cell;
        padding: 5px 10px;
      }
    </style>
  </head>
  <body>
    <h1>Информация обо мне:</h1>
    <div class="table-row">
      <div class="table-cell">Имя</div>
      <div class="table-cell"><?= $myName; ?></div>
    </div>
    <div class="table-row">
      <div class="table-cell">Возраст</div>
      <div class="table-cell"><?= $myAge; ?></div>
    </div>
    <div class="table-row">
      <div class="table-cell">Электронный ящик</div>
      <div class="table-cell"><?= $myEmail; ?></div>
    </div>
    <div class="table-row">
      <div class="table-cell">Город</div>
      <div class="table-cell"><?= $myCity; ?></div>
    </div>
    <div class="table-row">
      <div class="table-cell">Обо мне</div>
      <div class="table-cell"><?= $aboutMe; ?></div>
    </div>
</body>
</html>