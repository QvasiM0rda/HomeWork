<?php
  $userNumber = $_GET ['userNumber'];
  $userNumber = (int) $userNumber;

  $number_1 = 1;
  $number_2 = 1;
  $number_3 = 0;

  while (true) {
  	if ($number_1 > $userNumber) {
  		echo ' Число ' . $userNumber . ' не входит в числовой ряд.';
  		break;
  	}

  	if ($number_1 == $userNumber) {
  		echo ' Число ' . $userNumber . ' входит в числовой ряд.';
  		break;
  	}
  	else {
  		$number_3 = $number_1;
  		$number_1 = $number_1 + $number_2;
  		$number_2 = $number_3;
  	}
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Домашнее задание ко второму уроку</title>
	<meta charset="utf-8">
</head>
<body>
  <form method="GET">
  <label for="userNumber">Введите число: </label>
  	<input type="text" name="userNumber" id="userNumber">
    <br>
    <input type="submit" name="submit">
  </form>
</body>
</html>