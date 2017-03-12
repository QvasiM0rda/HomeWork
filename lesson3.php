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

  foreach ($continents as $continentKey => $continentName) {
    foreach ($continentName as $animalKey => $animalName) {
      $spacePosition = strpos($animalName, ' ');
      if (!empty($spacePosition)) {
        $firstNameArray[] = substr($animalName, 0, $spacePosition);
        $secondNameArray[] = substr($animalName, $spacePosition + 1);
      }
    }
  }

  shuffle ($secondNameArray);

  for ($i=0; $i<count($firstNameArray) - 1; $i++) {
      echo $firstNameArray[$i] . ' ' . $secondNameArray[$i] . ',<br>';
  }

  echo $firstNameArray[count($firstNameArray) - 1] . ' ' . $secondNameArray[count($firstNameArray) - 1];

  /*var_dump ($fantasticBeast);*/
  echo '<br><br>';
  var_dump ($firstNameArray);
  echo '<br><br>';
  var_dump ($secondNameArray);