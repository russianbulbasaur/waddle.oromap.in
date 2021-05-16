<?php
$email = $_POST['email'];
$password = $_POST['password'];
$email=hash("sha256",$email);
$password=hash("sha256",$password);
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '400';
}
else
{
$res=$con->query("SELECT passwrd FROM userx WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['passwrd'],"")==0)
{
$x=0;
$con->query("INSERT INTO userx(email,passwrd,files,maxfiles) VALUES('".$email."','".$password."','".$x."','0')");
echo "200";
}
else
{
if(strcmp($row['passwrd'],$password)==0)
{
echo '200';
}
else
{
echo '401';
}
}
}
?>