<?php
  error_reporting(E_ALL);

  $continents = array(
    'Eurasia' => array(
      'Ursus arctos', 'Talpa europaea', 'Ailurus fulgens'
    ), 
    'Africa' => array(
      'Panthera pardus', 'Camelus', 'Giraffa camelopardalis'
    ), 
    'North America' => array(
      'Procyon lotor', 'Rangifer tarandus', 'Alces alces'
    ), 
    'South America' => array(
      'Vultur gryphus ', 'Mephitidae', 'Puma concolor'
    ), 
    'Australia' => array(
      'Sarcophilus laniarius', 'Macropus', 'Ornithorhynchus anatinus'
    ), 
    'Antarctica' => array(
      'Arctocephalus gazella', 'Aptenodytes forsteri', 'Pagodroma nivea'
    )
  );
//Находим парные имена, создаем два массива: $fantasticBeast, состоящий из континента и первой части имени; $secondNameArray - состоящий из второй части имени
   foreach ($continents as $continentKey => $continent) {
    $firstName = '';
    foreach ($continent as $animalKey => $animalName) {
      $spacePosition = strpos($animalName, ' '); //находим пробел, если есть, делим элемент на две части 
      if (!empty($spacePosition)) {
        $firstName = $firstName . substr($animalName, 0, $spacePosition) . ',';
        $secondNameArray[] = substr($animalName, $spacePosition);        
      } 
    }
    $fantasticBeast[$continentKey] = explode(',', $firstName);
  }

  shuffle($secondNameArray);
  $arrayCounter = 0;
//Вводим всё вместе, пробуем убрать пробел у последнего элемента
  foreach ($fantasticBeast as $fantasticContinent => $firstNameArray) {
    array_pop($firstNameArray);
    echo '<h2>' . $fantasticContinent . '</h2>';
    for ($i=0; $i<=count($firstNameArray) - 1; $i++) {
      if ($i === count($firstNameArray) - 1) {
        echo $firstNameArray[$i] . $secondNameArray[$arrayCounter];
      }
      else {
        echo $firstNameArray[$i] . $secondNameArray[$arrayCounter] . ', ';
      }
      $arrayCounter++; 
    }
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Fantastic Beast and where to find them</title>
</head>
<body>
</body>
</html>