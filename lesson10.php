<?php
  error_reporting(E_ALL);

  interface GetPrice
  {
    public function getPrice();
  }

  abstract class Delivery implements GetPrice
  {
    abstract public function getDeliveryPrice();
    abstract public function getTitle();
  }

  class Product extends Delivery
  {
    public $title;
    public $price;
    public $discount = 0.1;
    protected $delivery;

    public function __construct($title, $price)
    {
      $this->title = $title;
      $this->price = $price;
    }

    public function getPrice()
    {
      $this->delivery = 300;
      return $this->price - ($this->price * $this->discount);
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function getDeliveryPrice()
    {
      return $this->delivery;
    }
  }

  class Keyboard extends Product
  {
    public $connectType;
    public $keyType;

    public function __construct($title, $price, $connectType, $keyType)
    {
      parent::__construct($title, $price);
      $this->connectType = $connectType;
      $this->keyType = $keyType;
    }
  }

  class Printers extends Product
  {
    public $paperSize;
    public $listPerSec;

    public function __construct($title, $price, $paperSize, $listPerSec)
    {
      parent::__construct($title, $price);
      $this->paperSize = $paperSize;
      $this->listPerSec = $listPerSec;
    }
  }

  class Sugar extends Product
  {
    public $weight;
    public $delivery = 250;

    public function __construct($title, $price, $weight)
    {
      parent::__construct($title, $price);
      $this->weight = $weight;
    }

    public function getPrice()
    {
      if ($this->weight > 10) {
        $this->delivery = 300;
        return $this->price - ($this->price * $this->discount);
      }
      else {
        return $this->price;
      }
    }

    public function getTotalPrice()
    {
      return $this->price * $this->weight;
    }
  }

  $keyboard = new Keyboard('Клавиатура', 500, 'USB', 'мембрана');
  echo $keyboard->getTitle() . ' стоит ' . $keyboard->getPrice() . '. Стоимость доставки - ' . $keyboard->getDeliveryPrice();
  echo '<br>';
  $printer = new Printers('Принтер', 35000, 'A4/A3', '10');
  echo $printer->getTitle() . ' стоит ' . $printer->getPrice() . '. Стоимость доставки - ' . $printer->getDeliveryPrice();
  echo '<br>';
  $sugar = new Sugar('Сахар', 500, 11);
  echo $sugar->getTitle() . ' стоит ' . $sugar->getPrice() . ' за килограмм. Общая стоимость - ' . $sugar->getTotalPrice()
  . '. Стоимость доставки - ' . $sugar->getDeliveryPrice();