<?php
  error_reporting(E_ALL);
  session_start();
  $newsFile = 'news.json';
  $commentFile = 'comment.json';

  class Functions
  {
    private $content;
    private $data;
  
    public function getJSON($fileName)
    {
      $this->content = file_get_contents($fileName);
      $this->data = json_decode($this->content, true);
      return $this->data;
    }
  
    public function setJSON($fileName, $data)
    {
      $this->data = $data;
      $this->content = json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      file_put_contents($fileName, $this->content);
    }
  }
  
  $functions = new Functions();

  if (!empty($_SESSION['comment_author'])) {
    $commentAuthor = $_SESSION['comment_author'];
    $commentText = $_SESSION['comment_text'];
    $commentDate = $_SESSION['comment_date'];
  
    $comment = new Comments($commentAuthor, $commentText, $commentDate);
    $comment->setComment($functions);
    unset($_SESSION['comment_author']);
  }