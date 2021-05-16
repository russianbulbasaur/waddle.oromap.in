<?php
$filename=$_POST['filename'];
$size=$_POST['size'];
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
$res=$con->query("SELECT files,maxfiles FROM userx WHERE email='".$email."'");
$row=$res->fetch_assoc();
$max=$row['maxfiles']+1;
$num=$row['files']+1;
$con->query("UPDATE userx SET files=".$num.",maxfiles='".$max."' WHERE email='".$email."'");
$con->query("INSERT INTO globalindex(id,indexes) VALUES('".$email.$max."','".$hash."')");
$res=$con->query("INSERT INTO filenames(id,filename,size) VALUES('".$email.$max."','".$filename."','".$size."')");
echo '200';
}
else
{
echo '401';
}
}
?>