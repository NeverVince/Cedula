<thead>  
     <tr>  
          <td><b>ID</b></td>
          <td><b>Time Processed</b></td>
          <td><b>Name of Corporation</b></td>
          <td><b>Corporate Address</b></td>
          <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View</b></td>
     </tr>  
</thead>  
<?php  
     $con = mysqli_connect('localhost', 'root', '');
     mysqli_select_db($con, 'cedula');
     $query = "SELECT * FROM classc";
     $result=mysqli_query($con, $query);
     $sortTable="SELECT * FROM classc ORDER BY id DESC";
     $sortedTable = mysqli_query($con, $sortTable);     

     while($row = mysqli_fetch_array($sortedTable))  
     {  
     echo '  
     <tr>
          <td>'.$row["queueNo"].'</td>
          <td>'.$row["timeProcessed"].'</td>
          <td>'.$row["corporation"].'</td>
          <td>'.$row["addressOfCorporation"].'</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">👁️</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
     </tr>
     ';
     } 
?>

<script>  
$(document).ready(function(){  
     $('#class_c_data').DataTable();  
});
</script>