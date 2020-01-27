<?php
class Products {
   protected $mysqli;
   public $id = null;
   public $name = null;
	 public $type = null;
	 public $supplier = null;
   public $price = null;
   public $quantity = null;

	 public function __construct( $data = array() ) {
     if( isset( $data['id'] ) ) $this->id = htmlentities( $data['id'] );
     if( isset( $data['name'] ) ) $this->name = htmlentities( $data['name'] );
		 if( isset( $data['type'] ) ) $this->type = htmlentities( $data['type'] );
		 if( isset( $data['supplier'] ) ) $this->supplier = htmlentities( $data['supplier'] );
     if( isset( $data['price'] ) ) $this->price = htmlentities( $data['price'] );
     if( isset( $data['quantity'] ) ) $this->quantity = htmlentities( $data['quantity'] );
     $this->mysqli = new mysqli(DB_HOST,DB_USER,"admin", "test_store");
	 }

   // Init class method
   public function storeValues( $params ) {
		//store the parameters
		$this->__construct( $params );
	 }

   // Insert data method
   public function addData() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $name = $this->name;
      $type = $this->type;
      $supplier = $this->supplier;
      $price = $this->price;
      $quantity = $this->quantity;
      $sql = "INSERT INTO product(name, type, supplier, price, quantity) VALUES('$name','$type','$supplier','$price','$quantity')";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Update data method
   public function updateData() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $id = $this->id;
      $name = $this->name;
      $type = $this->type;
      $supplier = $this->supplier;
      $price = $this->price;
      $quantity = $this->quantity;
      $sql = "UPDATE product SET name='$name', type='$type', supplier='$supplier', price='$price', quantity='$quantity' WHERE id='$id'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Delete data method
   public function removeData() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $id = $this->id;
      $sql = "DELETE FROM product WHERE id='$id'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Get details of products with quantity less than 3
   // For notification purpose
   public function getRestock() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $sql = "SELECT * FROM product WHERE quantity <=3";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Get list of products and paginate it if input values exist
   public function getData($start=null,$per_page=null) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
       if($per_page != null) {
         $sql = "SELECT * FROM product limit $start, $per_page";
       } else {
         $sql = "SELECT * FROM product";
       }

      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Get product based on id
   public function getProduct($id) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
    try{
      $sql = "SELECT * FROM product WHERE id='$id'";
      $valid = $conn->query($sql);

     $con = null;
     return $valid;
    }catch (Exception $e) {
      echo $e->getMessage();
      return false;
    }
   }

   // Count number of products on database
   public function countData() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $sql = "SELECT COUNT(*) FROM product";
      $valid = $conn->query($sql);

			$con = null;
			return $valid->fetch_row()[0];
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return 0;
		 }
   }

   // Search method for product based on name or type
   public function searchData($search) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
      $sql = "SELECT * FROM product WHERE name LIKE '%$search%' or type LIKE '%$search%'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Get product based on class attribute
   public function searchById() {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try {
      $id=$this->id;
      $sql = "SELECT * FROM product WHERE id='$id' LIMIT 1";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

   // Update quantity of the product based on class attribute
   public function updateQty($qty) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
       if ($qty >= 0) {
         $id=$this->id;
         $sql = "UPDATE product SET quantity='$qty' WHERE id='$id'";
         $valid = $conn->query($sql);
         $con = null;
   			return $valid;
      } else {
        return false;
      }

		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }
 }
 ?>
