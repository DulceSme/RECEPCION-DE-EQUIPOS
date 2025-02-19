<?php
 $errors = array();

 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." No puede estar en blanco.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total ){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('d/m/Y g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}
/*--------------------------------------------------------------*/
/* SQL PASSWORD
/*--------------------------------------------------------------*/
function encrypt_password($password) {
  $encryption_key = 'miClaveDeEncriptacion'; // Clave secreta (debe ser la misma para desencriptar)
  $encrypted_password = openssl_encrypt(
      $password,
      'AES-128-ECB',
      $encryption_key,
      0
  );
  return $encrypted_password;
}


function decrypt_password($encrypted_password) {
  $encryption_key = 'miClaveDeEncriptacion'; // Misma clave usada en la encriptación
  $decrypted_password = openssl_decrypt(
      $encrypted_password,
      'AES-128-ECB',
      $encryption_key,
      0
  );
  
  return $decrypted_password ?: 'Error al desencriptar';
}

function find_all_passwords() {
  global $db;
  $sql = "SELECT id, app,usuario, AES_DECRYPT(contrasena, 'miClaveDeEncriptacion') AS contrasena, ultimo_login FROM contrasenas";
  return find_by_sql($sql);
}




function find_highest_selling_product() {
  global $con; // Asegúrate de que la variable de conexión está disponible

  $sql = "SELECT nombre_producto, SUM(price) AS total_vendido 
          FROM sales 
          GROUP BY nombre_producto 
          ORDER BY total_vendido DESC 
          LIMIT 1";

  $result = mysqli_query($con, $sql);
  
  if ($result && mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result);
  }
  
  return null; // Si no hay ventas, devuelve null
}



include_once __DIR__ . '/config.php';
?>


