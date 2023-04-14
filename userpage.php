<?php
if($_COOKIE["username"]!="guru"){
 $t=$_COOKIE["username"];
 echo "<center>".$t."s adda</center>";
}
else{
    header("Location:index.php");
}
?>
 

<?php

if(isset($_POST["submit4"])){
    mymsgs($_COOKIE["username"]);
 
 }
 ?> 
<html>
    <head><title>userpage</title></head>
    <body>
       
        <br>
        <form action="" method="post">
            To: <br><input type="text" name="to"><br>
            Msg:<br><input type="text" name="msg"><br>
            <input type="submit" name="submit3" value="send msg"><br>
</form>
<hr>
<form action="" method="POST">
<input type="submit" name="submit4" value="see msgs"><br>
</form>
    </body>
    
</html>
<?php

//echo"in send function";
function send($to,$msg,$from){
$x=file_get_contents('json.json');
$y=json_decode($x,true);
$p=file_get_contents('msgs.json');
$q=json_decode($p,true);
$flag=0;
$data=[
    "username"=>$to,
    "from_user"=>$from,
    "msg"=>$msg
];

foreach($y as $b){
    if($b["username"]==$to){
        array_push($q,$data);
        file_put_contents("msgs.json",json_encode($q,JSON_PRETTY_PRINT));
        echo" foun user";
        $flag=1;
    }
}
if($flag==0){
    echo "user not existed";
}
else{
    echo "sent succefully";
}
}
function mymsgs($username){
$p=file_get_contents('msgs.json');
$q=json_decode($p,true);
$flag=0;
echo"<p> <b>msgs:</b><br>";
foreach($q as $u){
    if($u["username"]==$username){
        $flag=1;
        echo "from:";
        echo $u["from_user"];
        echo "<br>msg:";
        echo $u["msg"];
        echo"</p>";
    }
}
echo "<br>";
if($flag==0){
    echo "start chatting";
}
}
?>
<?php

if(isset($_POST["submit3"])){
    send($_POST['to'],$_POST['msg'],$_COOKIE["username"]);
 
 }
 ?>