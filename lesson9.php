<?php
  error_reporting(E_ALL);
  
  class Products
  {
    public $brand;
    public $model;
    public $price;
    protected $discount;
    
    
  }

  class Car extends Products
  {
    public $year;
    public $color;
  
    public function __construct($brand, $model, $price, $year, $color)
    {
      $this->brand = $brand;
      $this->model = $model;
      $this->price = $price;
      $this->year = $year;
      $this->color = $color;
    }
    
    public function getPrice()
    {
      if ($this->price > 1000000) {
        $carPrice = ' с учетом скидки стоит ' . round($this->price - ($this->price * $this->discount)) . ' руб.';
      } else {
        $carPrice = ' стоит ' .  $this->price . ' руб.';
      }
      return $carPrice;
    }
    
    public function getCar()
    {
      $car = $this->brand . ' ' . $this->model . ' ' . $this->color . ' ' . $this->year . ' года';
      return $car;
    }
  }
  
  class TV extends Products
  {
    
  
    public function __construct($brand, $model, $price)
    {
      $this->brand = $brand;
      $this->model = $model;
      $this->price = $price;
    }
  
    public function getPrice()
    {
      if ($this->price > 10000) {
        $tvPrice = ' с учетом скидки стоит ' . round($this->price - ($this->price * $this->discount)) . ' руб.';
      } else {
        $tvPrice = ' стоит ' .  $this->price . ' руб.';
      }
      return $tvPrice;
    }
  
    public function getTV()
    {
      $tv = $this->brand . ' ' . $this->model;
      return $tv;
    }
  }
  
  class Pen
  {
    public $color;
    
    public function __construct($color)
    {
      $this->color = $color;
    }
    
    public function getColor()
    {
      $penColor = 'Цвет ручки - ' . $this->color;
      return $penColor;
    }
  }
  
  class Duck
  {
    public $name;
    
    public function getDuckName()
    {
      return $this->name;
    }
    
  }

  class Product
  {
    public $name;
    public $price;
    
    public function __construct($name, $price)
    {
      $this->name = $name;
      $this->price = $price;
    }
    
    public function getProduct()
    {
      $product = $this->name . ' стоит ' . $this->price;
       return $product;
    }
  }
  
  $audi = new Car('Audi', 'A6', 2600000, '2017','white');
  echo $audi->getCar() . $audi->getPrice();
  echo '<br>';
  $bmw = new Car('BMW', '5', 710000, '2001','black');
  echo $bmw->getCar() . $bmw->getPrice();
  echo '<br>';

  $samsung = new TV('Samsung', 'K550', 33990);
  echo $samsung->getTV() . $samsung->getPrice();
  echo '<br>';
  $lg = new TV('LG', 'LW9500', 7000);
  echo $lg->getTV() . $lg->getPrice();
  echo '<br>';

  $redPen = new Pen('красный');
  echo $redPen->getColor();
  echo '<br>';
  $greenPen = new Pen('зеленый');
  echo $redPen->getColor();
  echo '<br>';

  $duckBillie = new Duck();
  $duckBillie->name = 'Билли';
  echo $duckBillie->getDuckName();
  echo '<br>';
  $duckWillie = new Duck();
  $duckWillie->name = 'Вилли';
  echo $duckWillie->getDuckName();
  echo '<br>';
  $duckDillie = new Duck();
  $duckDillie->name = 'Дилли';
  echo $duckDillie->getDuckName();
  echo '<br>';

  $product = new Product('Кровать', 10000);
  echo $product->getProduct();
  echo '<br>';
  $product = new Product('Тумбочка', 3500);
  echo $product->getProduct();