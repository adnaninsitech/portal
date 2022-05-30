<?php include('../header.php'); 

$department = getAllDepartment();

?>
<style>
.group-table{width:67%; margin:0 auto; padding:30px 0 60px;}
.group-table tbody { background-color: #fff; }
.group-table table{width:100%;}
.group-table tr{width:100%;}
.group-table tr:first-child td{background:#000; font-size:14px; font-weight:bold; color:#FFF;}
.group-table tr td{ border:1px solid #dddddd; font-family: 'Segoe UI';color:#666666;font-size:14px;font-weight: normal; padding:7px 15px;}
.group-table tr td a { color: #000; }
</style>

    <div class="group-table">
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%">Department</td>
          <td width="50%" style="text-align: center;">Users</td>
        </tr>
        
        <?php foreach($department as $dept){ ?>
<tr>
	<td><a href="../portal/users?k=<?php echo $dept["departmentkey"]; ?>"><?php echo $dept["departmentname"]; ?></a> </td>
	<td  style="text-align: center;"><?php echo totalDepartmentStrength($dept["departmentkey"]); ?></td>
	</tr>
 <?php } ?>

        

      </table>
    </div>


<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<?php include('../include/datatables.php'); ?>
<script type="text/javascript">
$(document).ready( function(){

});
</script>

</body>
</html>