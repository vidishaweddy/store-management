<?php
class Sales {
   protected $mysqli;
   public $id = null;
   public $name = null;
	 public $date = null;
   public $price = null;
   public $quantity = null;

	 public function __construct( $data = array() ) {
     if( isset( $data['id'] ) ) $this->id = htmlentities( $data['id'] );
     if( isset( $data['name'] ) ) $this->name = htmlentities( $data['name'] );
		 if( isset( $data['date'] ) ) $this->date = htmlentities( $data['date'] );
     if( isset( $data['price'] ) ) $this->price = htmlentities( $data['price'] );
     if( isset( $data['quantity'] ) ) $this->quantity = htmlentities( $data['quantity'] );
     $this->mysqli = new mysqli(DB_HOST,DB_USER,"admin", "test_store");
	 }

   public function storeValues( $params ) {
		//store the parameters
		$this->__construct( $params );
	 }

   public function addData($name) {
     $success = false;
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $date = $this->date;
      $price = $this->price;
      $quantity = $this->quantity;
      $profit=$price-ceil($price * 0.9);
      $profit=$profit*$quantity;
      $total_price=$price*$quantity;
      $sql = "INSERT INTO sales(date, name, quantity, price, total, profit) VALUES('$date','$name','$quantity','$price','$total_price','$profit')";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   public function updateData() {
     $success = false;
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $id = $this->id;
      $name = $this->name;
      $date = $this->date;
      $price = $this->price;
      $quantity = $this->quantity;
      $profit=$price-ceil($price * 0.9);
      $profit=$profit*$quantity;
      $total_price=$price*$quantity;
      $sql = "UPDATE sales SET name='$name', date='$date',price='$price', profit='$profit', total='$total_price' WHERE id='$id'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   public function removeData() {
     $success = false;
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $id = $this->id;
      $sql = "DELETE FROM sales WHERE id='$id'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   public function getData($date=null) {
     $success = false;
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
       if($date != null) {
         $sql = "SELECT * from sales WHERE date LIKE '$date' ORDER BY date DESC";
       } else {
         $sql = "SELECT * FROM sales";
       }

      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   public function getSale($id) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
    try{
      $sql = "SELECT * FROM sales WHERE id='$id'";
      $valid = $conn->query($sql);

     $con = null;
     return $valid;
    }catch (Exception $e) {
      echo $e->getMessage();
      return false;
    }
   }

   public function sumProfit($date) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
    try{
      if($date != null) {
        $sql = "SELECT SUM(profit) AS total FROM sales WHERE date LIKE '$date' ORDER BY date DESC";
      } else {
        $sql = "SELECT SUM(profit) AS total FROM sales";
      }
      $valid = $conn->query($sql);

     $con = null;
     return $valid;
    }catch (Exception $e) {
      echo $e->getMessage();
      return false;
    }
   }

   public function sumTotalPrice($date) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
    try{
      if($date != null) {
        $sql = "SELECT SUM(total) AS total FROM sales WHERE date LIKE '$date' ORDER BY date DESC";
      } else {
        $sql = "SELECT SUM(total) AS total FROM sales";
      }
      $valid = $conn->query($sql);

     $con = null;
     return $valid;
    }catch (Exception $e) {
      echo $e->getMessage();
      return false;
    }
   }
 }
 ?>
