<?php
  error_reporting(E_ALL);
  session_start();
  header('Content-Disposition: attachment; filename="sert.jpg');
  
  $sertTempateFile = __DIR__ . '/files/sert.jpg';
  $sertTemplateWidth =  800;
  $sertTemplateheight = 581;
  $sertWidth = $sertTemplateWidth;
  $sertHeight = $sertTemplateheight;

  $fontFile = __DIR__ . '/files/FONT.ttf';

  $sert = imagecreatetruecolor($sertWidth, $sertHeight);

  $textColor = imagecolorallocate($sert, 0, 0, 0);
  $text = 'Сертификат, подтверждающий, что';
  $userName = $_SESSION['user_name'];
  $text2 = 'прошел тест № ' . $_SESSION['test_number'];
  $text3 = 'И получил оценку';
  $rate = $_SESSION['rate'];

  $sertTemplate = imagecreatefromjpeg($sertTempateFile);
  imagecopyresampled($sert, $sertTemplate, 0, 0, 0, 0, $sertWidth, $sertHeight, $sertTemplateWidth, $sertTemplateheight);
  imagettftext($sert, 25, 0, 180, 250, $textColor, $fontFile, $text);
  imagettftext($sert, 25, 0, 180, 300, $textColor, $fontFile, $userName);
  imagettftext($sert, 25, 0, 180, 350, $textColor, $fontFile, $text2);
  imagettftext($sert, 25, 0, 180, 400, $textColor, $fontFile, $text3);
  imagettftext($sert, 30, 0, 450, 400, $textColor, $fontFile, $rate);
  imagejpeg($sert, null, 100);