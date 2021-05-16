<?php
$email = $_POST['email'];
$password = $_POST['password'];
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
$res=$con->query("SELECT files,maxfiles FROM userx WHERE email='".$email."'");
$row=$res->fetch_assoc();
$num=$row['files'];
if($num==0)
{
$json="{ 'filecount' : '0' }";
}
else
{
$max=$row['maxfiles'];
$json="{ 'filecount' : '".$num."',";
$x=1;
$u=1;
$res=$con->query("SELECT id FROM filenames WHERE size='75291'");
$row=$res->fetch_assoc();
echo $row['id'];
}
}
else
{
echo '401';
}
}
?>