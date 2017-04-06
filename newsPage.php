<?php
  error_reporting(E_ALL);
  require_once ('news.php');
  
  $news = new News('', '', '');
  $newsArray = $functions->getJSON($newsFile);
  $commentArray = $functions->getJSON($commentFile);
  
  if (!empty($_POST)) {
    $_SESSION['comment_author'] = $_POST['name'];
    $_SESSION['comment_text'] = $_POST['comment'];
    $_SESSION['comment_date'] = date('d_m_Y');
  }
  
  if(!empty($_POST['refresh'])) {
    header('refresh');
  }
?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Горячие новости</title>
</head>
<body>
  <?php
    foreach ($newsArray as $newsValue) {
      $newsTitle = $newsValue['title'];
      $newsText = $newsValue['text'];
      $newsDate = $newsValue['date'];
  
      $news = new News($newsTitle, $newsText, $newsDate);
      echo $news->getNews();
  ?>
  <br>
  <br>
  <form method="post">
    <fieldset>
      <legend>Комментарии</legend>
      <?php
        if (!empty($commentArray)) {
          foreach ($commentArray as $commentValue) {
            $commentAuthor = $commentValue['author'];
            $commentText = $commentValue['text'];
            $commentDate = $commentValue['date'];
    
            $comment = new Comments($commentAuthor, $commentText, $commentDate);
            echo $news->getComments($comment);
          }
        }
      ?>
      <label for="name">Введите Ваше имя:</label>
      <br>
      <input type="text" name="name" id="name" size="60">
      <br><br>
      <label for="comment">Оставьте комментарий. Он появится после обновления страницы.</label>
      <br>
      <textarea name="comment" id="comment" cols="45" rows="10"></textarea>
      <br><br>
      <button type="submit">Оставить комментарий</button>
      <button type="submit" value="refresh">Обновить страницу</button>
    </fieldset>
  </form>
  <?php } ?>
</body>
</html>