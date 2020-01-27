<?php
class Users {
   protected $mysqli;
   public $id = null;
   public $name = null;
	 public $username = null;
	 public $password = null;
	 public $salt = "2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824"; //hello

	 public function __construct( $data = array() ) {
     if( isset( $data['id'] ) ) $this->id = htmlentities( $data['id'] );
     if( isset( $data['name'] ) ) $this->name = htmlentities( $data['name'] );
		 if( isset( $data['username'] ) ) $this->username = htmlentities( $data['username'] );
		 if( isset( $data['password'] ) ) $this->password = htmlentities( $data['password'] );
     $this->mysqli = new mysqli(DB_HOST,DB_USER,"admin", "test_store");
	 }

	 public function storeValues( $params ) {
		//store the parameters
		$this->__construct( $params );
	 }

     public function storeUname( $username ) {
         //store the parameters
         if( isset( $username ) ) $this->username = htmlentities( $username );
     }

	 public function userLogin() {
		 $success = false;
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
       $username = $this->username;
       $password = hash("sha256", $this->password . $this->salt);
			 $sql = "SELECT name FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
       $valid = $conn->query($sql);
			if( $valid ) {
				$success = true;
			}

			$con = null;
      $valid = mysqli_fetch_array($valid)['name'];
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return $success;
		 }
	 }

	 public function register($photo) {
		$correct = false;
    $conn = $this->mysqli;

    if ($conn->connect_errno) {
      echo $conn->connect_error;
      exit();
    }
		try {
      $username = $this->username;
      $password = hash("sha256", $this->password . $this->salt);
      $name = $this->name;
      $query = $conn->query("INSERT INTO user(username, password, name, photo) VALUES('$username', '$password', '$name', '$photo')");
      if ($query === TRUE) {
        return "Welcome ".$password."<br/>Registration Successful <br/> <a href='index.php'>Login Now</a>";
      } else {
        return "Something is wrong. Please try again later!";
      }

		 } catch( Exception $e ) {
       return $e->getMessage();
     }
	 }

   // Update data method
   public function updateData($photo) {
     $conn = $this->mysqli;

     if ($conn->connect_errno) {
       echo $conn->connect_error;
       exit();
     }
		 try{
       $id = $this->id;
       $username = $this->username;
       $name = $this->name;
      $sql = "UPDATE user SET name='$name', username='$username', photo='$photo' WHERE id='$id'";
      $valid = $conn->query($sql);

			$con = null;
			return $valid;
		 }catch (Exception $e) {
			 echo $e->getMessage();
			 return false;
		 }
   }

     public function changepass() {
       $conn = $this->mysqli;
         try {
           $username = $this->username;
           $password = hash("sha256", $this->password . $this->salt);
           $sql = "UPDATE user SET password='$password' WHERE username='$username'";
           $query = $conn->query($sql);

           return "Success";
         }catch( Exception $e ) {
           return $e->getMessage();
         }
     }

     public function has_letters() {
         return preg_match( '/[a-zA-Z]/', $this->password );
     }

     public function has_numbers() {
         return preg_match( '/\d/', $this->password );
     }

     public function has_special_chars() {
         return preg_match('/[^a-zA-Z\d]/', $this->password);
     }
     public function encrypt_decrypt($action,$string) {
         $output = false;

         $encrypt_method = "AES-256-CBC";
         $secret_key = 'Test secret key';
         $secret_iv = 'Test secret iv';

         // hash
         $key = hash('sha256', $secret_key);

         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hash('sha256', $secret_iv), 0, 16);

         if( $action == 'encrypt' ) {
             $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
             $output = base64_encode($output);
         }
         else if( $action == 'decrypt' ){
             $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
         }

         return $output;
     }
     public function log_out()
     {
         setcookie('username','',time() - 300);
         setcookie('id','',time() - 300);
         echo '<script> window.location.href="index.php"</script>';
     }
     public function checkattempt()
     {
       $conn = $this->mysqli;
         $success = 0;
         try{
             $username = $this->username;
             $sql = "SELECT count(*) FROM loginattempt WHERE username = $username AND date > DateTime('now','-5 minutes') LIMIT 1";
             $query =$conn->query($sql);
             $valid = $query;

             if( $valid ) {
                 $success = true;
             }

             $con = null;
             return $valid;
         }catch (Exception $e) {
             return $e->getMessage();
             //return $success;
         }
     }
     public function addattempt() {
         $correct = false;
         $conn = $this->mysqli;
         try {
             $username = $this->username;
             $sql = "INSERT INTO loginattempt(username, date) VALUES($username, DateTime('now'))";
             $query = $conn->query($sql);
             return "success";
         }catch( Exception $e ) {
             return $e->getMessage();
         }
     }
     public function getUsers($start=null,$per_page=null)
     {
       $conn = $this->mysqli;
         $success = null;
         try{
           if($per_page != null) {
             $sql = "SELECT * FROM user limit $start, $per_page";
           } else {
             $sql = "SELECT * FROM user";
           }
          $query = $conn->query($sql);
          return $query;
         }catch (Exception $e) {
             echo $e->getMessage();
             return $success;
         }
      }

     public function searchData($search) {
       $conn = $this->mysqli;

       if ($conn->connect_errno) {
         echo $conn->connect_error;
         exit();
       }
  		 try{
        $sql = "SELECT * FROM user WHERE name LIKE '%$search%' or username LIKE '%$search%'";
        $valid = $conn->query($sql);

  			$con = null;
  			return $valid;
  		 }catch (Exception $e) {
  			 echo $e->getMessage();
  			 return false;
  		 }
     }

     public function countData() {
       $conn = $this->mysqli;

       if ($conn->connect_errno) {
         echo $conn->connect_error;
         exit();
       }
  		 try{
        $sql = "SELECT COUNT(*) FROM user";
        $valid = $conn->query($sql);

  			$con = null;
  			return $valid->fetch_row()[0];
  		 }catch (Exception $e) {
  			 echo $e->getMessage();
  			 return 0;
  		 }
     }

     public function getUser($id) {
       $conn = $this->mysqli;

       if ($conn->connect_errno) {
         echo $conn->connect_error;
         exit();
       }
  		 try{
        $sql = "SELECT * FROM user WHERE id='$id'";
        $valid = $conn->query($sql);

  			$con = null;
  			return $valid;
  		 }catch (Exception $e) {
  			 echo $e->getMessage();
  			 return false;
  		 }
     }

     public function changePhoto($photo, $id) {
       $conn = $this->mysqli;

       if ($conn->connect_errno) {
         echo $conn->connect_error;
         exit();
       }

       try {
         $sql = "UPDATE user SET photo=$photo where id=$id";
         $query = $conn->query($sql);
         return $query;
       }catch( PDOException $e ) {
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
        $sql = "DELETE FROM user WHERE id='$id'";
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
