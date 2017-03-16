<?php
  error_reporting(E_ALL);

  if (empty($_POST)) {
    $city = 'Makhachkala';
  }
  else {
    $city = $_POST['city'];
  }

  $content = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=c20ca623db48917d5f4539ba21275344');

  $weatherData = json_decode($content, true);

  //Перевод температуры из градусов Кельвина в градусы Цельсия
  function kelvinToCelsius($temp) {
    if (!is_numeric($temp)) { return false; }
    return $temp - 273.15;
  }

  function hpaToMmhg ($press) {
    if (!is_numeric($press)) {return false;}
    return round($press / 1.3332239, 2);
  }

  $cityName = $weatherData['name'];
  $weatherConditions = $weatherData['weather'][0]['description'];
  $weatherConditionsIcon = 'http://openweathermap.org/img/w/' . $weatherData['weather'][0]['icon'] . '.png';
  $weatherTemp = kelvinToCelsius($weatherData['main']['temp']) . ' &degC';
  $humidity = $weatherData['main']['humidity'] . '%';
  $pressure = hpaToMmhg($weatherData['main']['pressure']) . ' мм. рт. ст.';
  $windSpeed = $weatherData['wind']['speed'] . ' м/с';
  $cloud = $weatherData['clouds']['all'] . ' %';
  $date = date('d F, Y', $weatherData['dt']);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Weather</title>
  <style>
    body {
      font-family: sans-serif;
    }

    .weather_cond img{
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <form method="POST">
    <label for="city_id">Enter your city: </label>
    <input type="text" name="city" id="city_id">
    <button>Go</button>
  </form>	

  <h1>Weather at <?php echo $cityName; ?>, <?php echo $date; ?></h1>
  <p class="weather_cond">Weather conditions: <?php echo $weatherConditions ?>;
  <img src="<?php echo $weatherConditionsIcon; ?>" alt="<?php echo $weatherConditions; ?>">;</p>
  <p>Temperature: <?php echo $weatherTemp; ?></p>
  <p>Humidity of air: <?php echo $humidity; ?></p>
  <p>Atmospheric pressure: <?php echo $pressure; ?></p>
  <p>Wind speed: <?php echo $windSpeed; ?></p>
  <p>Cloudiness: <?php echo $cloud; ?></p>
</body>
</html>