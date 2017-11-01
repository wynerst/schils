<?php
//panggil file suggestion_box_config.php untuk menghubung ke server
include('suggestion_box_config.php');
 
//menangkap data dari form
$name_suggestion = $_POST['name_suggestion'];
$email = $_POST['email'];
$phone_numb = $_POST['phone_numb'];
$topic = $_POST['topic'];
$description = $_POST['description'];
$date = $_POST['date'];

 
//menyimpan data ke database
$query = mysql_query("insert into suggestion_box values('', '$name_suggestion', '$email','$phone_numb', '$topic', '$description', '$date')") or die(mysql_error());
 
if ($query) {
    header('location:index.php?p=suggestion_box_success');
}
?>