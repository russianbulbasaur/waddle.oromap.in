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
while($x<=$max)
{
$res=$con->query("SELECT filename,size FROM filenames WHERE id='".$email.$x."'");
$row=$res->fetch_assoc();
if(strcmp($row['size'],"")==0)
{

}
else
{
$json=$json."'".$u."' : '".$row['filename']."','".$u."size' : '".$row['size']."',";
$res=$con->query("SELECT indexes FROM globalindex WHERE id='".$email.$x."'");
$row=$res->fetch_assoc();
$json=$json."'".$u."hash' : '".$row['indexes']."'";
if($u!=$num)
{
$json=$json.",";
}
$u=$u+1;
}
$x=$x+1;
}
$json=$json.'}';
}
echo $json;
}
else
{
echo '401';
}
}
?>