<?php
include 'dashboard.php';
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    

    $conn = mysqli_connect($servername,$username,$password,$dbname);


$flag=0;
$update=0;

if(isset($_POST['submit']))
{
  $date=date("Y-m-d");
   
  $records=mysqli_query($con,"select * from  attendance_records where date='$date'  ");
  $num=mysqli_num_rows($records);

  if($num)
  {
    foreach($_POST['attandence_status'] as $id=>$attandence_status)
    {
    $emp_name=$_POST['emp_name'][$id];
    $emp_id=$_POST['emp_id'][$id];
    $date=date("Y-m-d");

    $result=mysqli_query($conn,"update attendance_records set emp_name='$emp_name',emp_id='$emp_id',attandence_status='$attandence_status',date='$date' where date='$date' AND emp_name='$emp_name' ");
    if($result)
    {
    $update=1;
    }


          } 

  }
  else
  {
    foreach($_POST['attandence_status'] as $id=>$attandence_status)
    {
    $emp_name=$_POST['emp_name'][$id];
    $emp_id=$_POST['emp_id'][$id];
    $date=date("Y-m-d");

    $result=mysqli_query($conn,"insert into attendance_records(emp_name,emp_id,attandence_status,date)values('$emp_name','$emp_id','$attandence_status','$date')");
    if($result)
    {
    $flag=1;
    }


          }
        }
}


?>

<div class="panel panel-default">

    <div class="panel panel-heading">
        <h2>
        <a class="btn btn-success" href="add1.php">ADD EMPLOYEE </a>
        <a class="btn btn-info pull-right" href="view_all1.php">VIEW ALL </a>
        </h2>
        <?php if($flag) { ?>

        <div class="alert alert-success">
      ATTENDENCE DATE INSERT SUCCESSFULLY
        </div>
        <?php   } ?>

        <?php if($update) { ?>

<div class="alert alert-success">
      EMPLOYEE ATTENDENCE UPDATED SUCCESSFULLY
</div>
<?php   } ?>


        <h3><div class="well text-center">date:<?php echo date("Y-m-d"); ?>  </div></h3>
    </div>

    <div class="panel panel-body">

    <form action="index1.php" method="POST">

    <table class="table table-striped">
        <tr>

    <th>serial number</th><th>employee name</th><th>employee id</th><th>attandence status</th>

        </tr>

    <?php $result=mysqli_query($con,"select * from attendence");
    $serialnumber=0;
    $counter=0;


    while($row=mysqli_fetch_array($result))
    {
    $serialnumber++;


    

    ?>

<tr>
<td> <?php echo $serialnumber;  ?>  </td>
<td> <?php echo $row['emp_name'];  ?> 
<input type="hidden" value="<?php echo $row['emp_name'];  ?>" name="emp_name[]">
  </td>
<td> <?php echo $row['emp_id'];  ?>  
<input type="hidden" value="<?php echo $row['emp_id'];  ?>" name="emp_id[]">
  </td>

<td>
  <?php if(isset($_POST['attandence_status'][$counter]) && isset($_POST['attandence_status'][$counter])  ) ?>
<input type="radio" name="attandence_status[<?php echo $counter; ?>]" value="present"
<?php if(isset($_POST['attandence_status'][$counter]) && $_POST['attandence_status'][$counter]=="present")  { 
  echo "checked=checked";
}
?>

required >present 
<input type="radio" name="attandence_status[<?php echo $counter; ?>]" value="absent"
<?php if(isset($_POST['attandence_status'][$counter]) && $_POST['attandence_status'][$counter]=="absent")  { 
  echo "checked=checked";
}
?>



required>absent
</td> 

</tr>
     <?php
     $counter++;

    }
     ?>

</table>

<input type="submit" name="submit" value="submit" class="btn btn-primary">







    </form>
    </div>






</div>