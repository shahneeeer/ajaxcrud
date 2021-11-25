<?php
//insert the data
include("connection.php");
if(!empty($_POST['email']) && !empty($_POST['uname']) && !empty($_POST['degree']) && !empty($_POST['designation']) && !empty($_POST['btn']) )
{
    $email=$_POST['email'];
    $name=$_POST['uname'];
    $degree=$_POST['degree'];
    $designation=$_POST['designation'];
    if(mysqli_query($con,"insert into ajax(email,name,degree,designation) values('$email','$name','$degree','$designation')")){
        echo "user added";
    }
    else{
        echo "user not added";
    }
}
//Delete user
if(!empty($_POST['delid']))
{
    $id=$_POST['delid'];
    if(mysqli_query($con,"delete from ajax where id=$id")){
        echo "User deleted";
    }
    else{
        echo "user not deleted";
    }
}
//edit user
if(!empty($_POST['editid']))
{
    $id=$_POST['editid'];
  $sel=  mysqli_query($con,"select * from ajax where id=$id");
  $data=mysqli_fetch_assoc($sel);
  if($data){
      echo json_encode($data);
  }
}
//update user
if(!empty($_POST['email']) && !empty($_POST['uname']) && !empty($_POST['degree']) && !empty($_POST['designation']) && !empty($_POST['id']) && !empty($_POST['update']) )
{
    $email=$_POST['email'];
    $name=$_POST['uname'];
    $degree=$_POST['degree'];
    $designation=$_POST['designation'];
    $id=$_POST['id'];
    if(mysqli_query($con,"update ajax set email='$email',name='$name',degree='$degree',designation='$designation' where id=$id")){
        echo "user updated";
    }
    else{
        echo "user not updated";
    }
}



?>