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
      'Vultur gryphus', 'Mephitidae', 'Puma concolor'
    ), 
    'Australia' => array(
      'Sarcophilus laniarius', 'Macropus', 'Ornithorhynchus anatinus'
    ), 
    'Antarctica' => array(
      'Arctocephalus gazella', 'Aptenodytes forsteri', 'Pagodroma nivea'
    )
  );

function fantasticBeast ($continents) {
  foreach ($continents as $continentName => $animalArray) {
    $firstName = '';
    foreach ($animalArray as $animalKey => $animalName) {
      $spacePosition = strpos($animalName, ' ');
      if (!empty($spacePosition)) {
        $firstName = $firstName . substr($animalName, 0, $spacePosition) . ',';
        $secondNameArray[] = substr($animalName, $spacePosition);
      }
    }
    $firstNameArray[$continentName] = explode(',', $firstName);
  }

  shuffle($secondNameArray);
  $arrayCount = 0;

  foreach ($firstNameArray as $continentName => $animalArray) {
    $toOutput = '';
    array_pop($animalArray);
    for ($i=0; $i<=count($animalArray) - 1; $i++) {
      if ($i === count($animalArray) - 1) {
        $toOutput = $toOutput . '<p>' . $animalArray[$i] . ' ' . $secondNameArray[$arrayCount] . '</p>'; 
      }
      else {
        $toOutput = $toOutput . '<p>' . $animalArray[$i] . ' ' . $secondNameArray[$arrayCount] . ',</p>';  
      }
      $arrayCount++;
    }
    echo '<h2>' . $continentName . '</h2>'. $toOutput;
  }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Fantastic Beast and where to find them</title>
  <style>
    body {
      font-family: sans-serif;
    }
    h1, h2   {
      text-transform: uppercase;
      text-align: center;
    }

    p {
      text-align: center; 
    }
  </style>
</head>
<body>
  <h1>Fantastic Beast and where to find them</h1>
  <?php fantasticBeast($continents) ?>
</body>
</html>