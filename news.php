<?php
  require_once ('comments.php');

  class News
  {
    public $newsTitle;
    public $newsText;
    public $newsDate;
    public $comments;

    public function __construct($newsTitle, $newsText, $newsDate)
    {
      $this->newsTitle = $newsTitle;
      $this->newsText = $newsText;
      $this->newsDate = $newsDate;
    }

    public function getNews()
    {
      $newsTitle = '<h2>' . $this->newsTitle . '</h2>';
      $newsText = '<p>' . $this->newsText . '</p>';
      $newsDate = '<time>' . $this->newsDate . '</time>';
      $news = $newsTitle . "\n" . $newsText . "\n" . $newsDate;
      return $news;
    }

    public function getComments(Comments $comment)
    {
      $commentAuthor = '<h3>' . $comment->commentAuthor . '</h3>';
      $commentText = '<p>' . $comment->commentText . '</p>';
      $commentDate = '<time>' . $comment->commentDate . '</time>';
      $comment = $commentAuthor . "\n" . $commentText . "\n" . $commentDate;
      return $comment;
    }
  }