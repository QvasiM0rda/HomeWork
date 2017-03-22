<?php
  error_reporting (E_ALL);
  $file = file_get_contents('lesson5.json');
  $phoneBook = json_decode($file, true);
  $tableTitle = array_keys($phoneBook[0]);
?>

<!DOCTYPE html>
<html eng="ru">
  <head>
    <title>Домашнее задание к пятому уроку</title>
    <meta charset="utf-8">
    <style type="text/css">
      table,
      tr,
      th,
      td {
        border: 1px solid black;
      }

      table {
        border-collapse: collapse;
      }

      th,
      td  {
        padding: 5px 10px;
      }
    </style>
  </head>
  <body>
    <table>
      <tr>
      <?php foreach ($tableTitle as $rowTitle) { ?>      
        <th><?php echo $rowTitle; ?></th><?php } ?>
      </tr>
      <?php foreach ($phoneBook as $row) { ?>
      <tr>
        <?php foreach ($row as $cellValue) { ?>
          <td><?php echo $cellValue; ?></td><?php } ?>
      </tr>
      <?php } ?>
    </table>
  </body>
</html>