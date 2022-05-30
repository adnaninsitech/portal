<?php include('../header.php'); 
$foodId = fooditemstatus();

//echo foodimage();

?>

<link rel="stylesheet" type="text/css" href="./assets/css/styles-dm.css">
<div class="container">

<?php if(isSuperAdmin($globaluserid)){ ?>
	<div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Food Management</h2>
            <div class="row">
                <div class="col-md-6">
               		<div class="form-group mt-2">
						<label>Upload Food Image And Fill Required Details</label>
                        <div id="drag-and-drop-zone" class="dm-uploader">
                            <h3 class="mb-2 mt-4 text-muted">Drag &amp; drop files here</h3>

                            <div class="btn btn-primary btn-block mb-4">
                                <span>Open the file Browser</span>
                                <input type="file" title='Click to add Files' />
                            </div>
                          </div>
					</div>
					<!-- <div class="form-group mt-2">
					</div> -->
                </div>
            </div>
                <form id="food_form">
                    <div id="finalfiles"></div>
                    
                        <!-- <div class="col-md-12 col-sm-12"> -->
                          <ul class="list-unstyled row" id="files">
                            <li class="text-muted text-center empty">No files uploaded.</li>
                          </ul>
                        <!-- </div> -->
                    
                    <input class="btn btn-primary mt-2" type="submit" value="Submit">
                </form>
                
            </div>
        </div>
    
<?php  } ?>
    <!-- <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Today's Menu</h2>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <?php 
                        
                        $start_time = (int)strtotime(date('d-m-Y')) - 1;
                        $end_time = $start_time + 86399;
                        $getTodaysMenu = getTodaysMenu($start_time,$end_time);
                        $menu_data = $getTodaysMenu->fetch_assoc();?>
                        <tr class="text-center">
                            <?php
                            if($getTodaysMenu->num_rows > 0){
                                $today_date = ($menu_data["schedule_date"] != NULL)?date('d-M-Y',$menu_data["schedule_date"]):'-';
                                $today_day = ($menu_data["schedule_date"] != NULL)?date('l',$menu_data["schedule_date"]):'-';
                                 echo '
                                <td><img src="./backend/'.$menu_data["image"].'" alt="food image" width="100" height="100"></td>
                                <td>'.$menu_data["name"].'</td>
                                <td>'.$today_date.'</td>
                                <td>'.$today_day.'</td>';
                            }else{
                                echo '<span class="alert alert-danger">No food found.</span>';
                            }
                            ?>
                        </tr>
                    </table>
                   
                </div>
            </div>
                
                
            </div>
        </div> -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Monthly Meal Menu</h2>
            <div class="row">
                <div class="col-md-12">
                	<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        	<tr class=" text-center ">
                                <th>#</th>
                                <!-- <th></th> -->
                                <th>Image</th>
                                <th>Meal</th>
                                 <th>Check</th>
                               <!-- <th>Date</th>
                                 <th>Day</th> -->
<?php if(isSuperAdmin($globaluserid)){ ?>
                                <th>Delete</th>
<?php } ?>
                            </tr>
                        </thead>
        				<tbody>
                                
        					<?php
        					// echo weekOfMonth(time());
        					$getFoodMenu = getFoodMenu();
                            //$myfood = fooditemstatus();



        					$num = 1;
        					foreach ($getFoodMenu as $this_food) {
        						$date = ($this_food["schedule_date"] != NULL)?date('d-M-Y',$this_food["schedule_date"]):'-';
        						$day = ($this_food["schedule_date"] != NULL)?date('l',$this_food["schedule_date"]):'-';
                                $todays_food = ($menu_data['id'] == $this_food['id'])? "bg-success" : "";
								echo '

								<tr class=" text-center '.$todays_food.' '.$this_food["food_key"].'">
									<td>'.$num.'</td>
                                   <td><img src="./backend/'.$this_food["image"].'" width="80" height="50" alt="food"></td>';

                             
                        if(isSuperAdmin($globaluserid)){
                            if($foodId == $this_food["food_key"]){ $check = "checked"; }else{ $check = "";}
                                        echo '<td>'.$this_food["name"].'</td>
                       <td><input type="radio" id="radio" name="radiobtn" value="check"  class="foodradio" rel="'.$this_food["food_key"].'"'.$check .'  /></td> ';

                                    }

                                    if(isSuperAdmin($globaluserid)){
                                        echo '<td><a href="javascript:;" food="'.$this_food["name"].'" rel="'.$this_food["food_key"].'" class="del-food"><i class="fas fa-times text-danger text-center"></i></a></td>';
                                    }
                                    echo '</tr>';        						
        						$num++;
        					}
        					?>

                            
        					
        				</tbody>
        			</table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<?php include('../include/datatables.php'); ?>






<script type="text/javascript">
$(document).ready( function(){

});
</script>
<script type="text/javascript" src="./assets/js/jquery.dm-uploader.min.js"></script>
<script type="text/javascript" src="./assets/js/demo-config.js"></script>
<script type="text/javascript" src="./assets/js/demo-ui.js"></script>
<script type="text/html" id="files-template">
 <li class="media col-md-4">
    
    <img class="mr-3 mb-2 preview-img" width="100" src="https://danielmg.org/assets/image/noimage.jpg?v=v10" alt="Generic placeholder image">
    
    <div class="media-body mb-1">
      <p class="mb-2">
        <strong>%%filename%%</strong>
      </p>
      <div class="progress mb-2">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
          role="progressbar"
          style="width: 0%" 
          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        </div>
      </div>
       <div class="media-body mb-1">
            <label>Food Name</label>
                <input type="text" name="food_name[]" class="form-control" placeholder="e.g. Biryani" required="">
            <!-- <label class="mt-2">Date</label>
                <input type="date" name="schedule_date[]" min="<?php echo date('Y-m-d',time()); ?>" class="form-control" required=""> -->
        </div>
      <hr class="mt-1 mb-1" />
    </div>
  </li>
</script>

<script type="text/javascript">


 /*$(document).on('click',function(e){

   e.preventDefault();

   if(){

         $("#check").prop("checked", true);

   }


 });*/

    
                $(document).on('change','.foodradio',function(e){
                    
                    e.preventDefault();


                   var fkey = $(this).attr("rel");
                   


                    var url = "<?php echo $url . '/include/ajaxscript.php'; ?>";
                    var data = {fkey: fkey, call: "foodstatus" } ;

                    $.ajax({
                    type: "POST",
                    url: url,
                    data: data, // serializes the form's elements.
                        success: function(data)
                        {
                            //alert(data);
                            location.reload();
                        }
                    });

                  


                });
          
</script>

<script type="text/javascript">






/*$(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      alert($(this).attr('rel'));
    }
  });
});*/


    $(document).on('submit','#food_form',function(e){
        e.preventDefault();
        var form_data = $('#food_form').serialize();
        $.ajax({
           type: "POST",
           url: './include/ajax/ajax.php',
           data: form_data+"&add_food=add_food",
           success: function(res){
                location.reload();
           }
         });
    })
    $(document).on('click','.del-food',function(){
        var key = $(this).attr('rel');
        var food = $(this).attr('food');
        swal({
          title: "Are you sure?",
          text: "You want to this file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
             $.ajax({
                type: "POST",
                url: './include/ajax/ajax.php',
                data: {
                    key:key,
                    del_food:"del_food",
                },
                success: function(res){
                    if(res != "error"){
                        swal(food+" has been deleted from menu.", {
                          icon: "success",
                        });
                        $('.'+key).remove();
                    }else{
                        swal("Something wrong "+food+" not deleted.", {
                          icon: "error",
                        });
                    }
                }
             });   
          } else {
          }
        });
    })
</script>
</body>
</html>
