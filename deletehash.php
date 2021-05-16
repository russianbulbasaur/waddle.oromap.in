<?php
$email = $_POST['email'];
$password = $_POST['password'];
$hash=$_POST['hash'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '400';
}
else
{
$email=hash("sha256",$email);
$password=hash("sha256",$password);
$res=$con->query("SELECT passwrd FROM userx WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['passwrd'],$password)==0)
{
$res=$con->query("SELECT files FROM userx WHERE email='".$email."'");
$row=$res->fetch_assoc();
$num=$row['files']-1;
$con->query("UPDATE userx SET files=".$num." WHERE email='".$email."'");
$res=$con->query("SELECT id FROM globalindex WHERE indexes='".$hash."'");
$row=$res->fetch_assoc();
$id=$row['id'];
$con->query("DELETE FROM globalindex WHERE indexes='".$hash."'");
$con->query("DELETE FROM filenames WHERE id='".$id."'");
echo '200';
}
else
{
echo '401';
}
}
?>