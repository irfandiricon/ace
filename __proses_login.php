<?php
require_once '__setting.php';
$table_user = TABLE_USER;
$host = HOST;
$user = USERNAME;
$password = PASSWORD;
$db = DATABASE;

$con= mysqli_connect($host, $user, $password);
$connection = mysqli_select_db($con, $db);
$json = array();

$username = isset($_POST['username']) ? $_POST['username']:"";
$password = isset($_POST['password']) ? $_POST['password']:"";

$myusername=mysqli_real_escape_string($con, $username);
$mypassword= md5(mysqli_real_escape_string($con, $password));

$query="SELECT user_id, username, nama_lengkap, level, last_login, flag_aktif FROM $db.$table_user
  WHERE username='$myusername' and password='$mypassword'";

$ex_query= mysqli_query($con, $query);
$rows= mysqli_num_rows($ex_query);

if ($rows == 0){
    $pesan = "Login Gagal. Pastikan Username dan Password Anda Benar !";
    $isValid = 0;
    $json=array('isValid' =>0,'rows' => $pesan);
}else{
    $data = mysqli_fetch_assoc($ex_query);
    $flag_aktif = $data['flag_aktif'];
    if($flag_aktif=="N"){
        $pesan = "Maaf, Username Anda Sudah Tidak Aktif, Silahkan Hubungi Administrator !!!";
        $json=array('isValid' =>0,'rows' => $pesan);
    }else{
        session_start();
        $data_rows = mysqli_fetch_assoc($ex_query);
        $row['rows'] = $data_rows;
        $json=array('isValid' =>1,'rows' => $data);
    }
}

echo json_encode($json);
mysqli_close($con);
