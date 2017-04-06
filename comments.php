<?php
  error_reporting(E_ALL);
  require_once ('functions.php');

  class Comments
  {
    public $commentAuthor;
    public $commentText;
    public $commentDate;

    public function __construct($author, $text, $date)
    {
      $this->commentAuthor = $author;
      $this->commentText = $text;
      $this->commentDate = $date;
    }
    
    public function setComment(Functions $functions)
    {
      $commentAuthor = $this->commentAuthor;
      $commentText = $this->commentText;
      $commentDate = $this->commentDate;
      $comment = $functions->getJSON('comment.json');
      $comment[] = ["author" => $commentAuthor, "text" => $commentText, "date" => $commentDate];
      $functions->setJSON('comment.json', $comment);
    }
  }