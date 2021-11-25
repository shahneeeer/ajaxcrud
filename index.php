<?php
include("connection.php");
?>

<!doctype html>
<html lang="en">
  <head>
  <?php include("head.php") ?>
    <style>
        .mar{
            margin-top: 6%;
        }
    </style>
  </head>
  <body>
      <div class="container mar">
 
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="text" class="form-control" id="email" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" class="form-control" id="name">
  </div>
  <div class="mb-3">
    <label class="form-label">Degree</label>
    <input type="text" class="form-control" id="degree" >
  </div>
  <div class="mb-3">
    <label class="form-label">Designation</label>
    <input type="text" class="form-control" id="design" >
  </div>
  <input type="hidden" id="nid">
  <input type="button" class="btn btn-success" id="btn" value="submit">
  <input type="button" value="Update" id="update" class="btn btn-success"/><br><br>
  <table class="table">
    <tr>
      <th>sr.no</th>
      <th>Email</th>
      <th>Name</th>
      <th>Degree</th>
      <th>Designation</th>
      <th>Actions</th>
    </tr>
    <?php
    $sel= mysqli_query($con,"select * from ajax");
    if(mysqli_num_rows($sel)>0){
      $sn=1;
      while($arr=mysqli_fetch_assoc($sel)){
        ?>
        <tr>
          <td><?php echo $sn ?></td>
          <td><?php echo $arr['email'] ?></td>
          <td><?php echo $arr['name'] ?></td>
          <td><?php echo $arr['degree'] ?></td>
          <td><?php echo $arr['designation'] ?></td>
          <td><a href="javascript:void(0)" class="btn btn-primary edit" data-id="<?= $arr['id']; ?>">EDIT</a>
          <a href="javascript:void(0)" class="btn btn-danger delete" data-id="<?= $arr['id']; ?>">DELETE</a></td>
        </tr>
        <?php
        $sn++;
      }
      
    }
    ?>
  </table>

      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
          //ADD USER
          $(document).ready(function(){
              $('#btn').click(function(){
                  var email=$('#email').val();
                  var name=$('#name').val();
                  var degree=$('#degree').val();
                  var designation=$('#design').val();
                  var formdata={email:email,uname:name,degree:degree,designation:designation,btn:'btn'}
          
                  $.ajax({
                      type:"POST",
                      url:"ajaxsql.php",
                      data:formdata,
                      success:function(data){
                        alert(data)
                        window.location.reload();//refresh
                      }
                  })
              })
              //Delete user
              $(".delete").click(function(){
                if(confirm("Do you want to delete ?")==true){
                var id=$(this).data('id');
                
                $.ajax({
                    type:"POST",
                    url:"ajaxsql.php",
                    data:{delid:id},
                    success:function(data){
                        alert(data);
                        window.location.reload();
                       
                    }
                })
            }
            })
            //edit user:to show the data in the fields
            $(".edit").click(function(){
              var id=$(this).data('id');
              $.ajax({
                    type:"POST",
                    url:"ajaxsql.php",
                    data:{editid:id},
                    dataType:'json',
                    success:function(data){
                      $('#email').val(data.email);  
                      $('#name').val(data.name);  
                      $('#degree').val(data.degree);  
                      $('#design').val(data.designation);  
                      $('#nid').val(data.id);   
                    }
                })
            })
            //update user
            $("#update").click(function(){
              var email=$('#email').val();
                  var name=$('#name').val();
                  var degree=$('#degree').val();
                  var designation=$('#design').val();
                  var id=$('#nid').val();
                  var formdata={email:email,uname:name,degree:degree,designation:designation,id:id,update:'update'}
                  $.ajax({
                      type:"POST",
                      url:"ajaxsql.php",
                      data:formdata,
                      success:function(data){
                        alert(data)
                      $('#email').val("");  
                      $('#name').val("");  
                      $('#degree').val("");  
                      $('#design').val("");  
                      $('#nid').val(""); 
                      window.location.reload();
                      }
                  })
                  
              
            })
          })
      </script>
<?php include("foot.php") ?>
  </body>
</html>
