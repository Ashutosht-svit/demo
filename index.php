<?php include("get_country.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>AJAX Assignment</title>
		<script src="jquery.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
		<style type="text/css">
			.sel-size{
				width: 200px;
			}
			.div-align{
				margin-left: 500px;
			}
			.txt-align{
				text-align: center;
				color: darkcyan;
			}
		</style>
	</head>
	<body>
		<div class="card-body txt-align">
			<h2>Country, State and City Dropdwon</h2>
		</div>
		<div class="card-body div-align">
			<form method="POST" action="">
				<div class="form-group">
					<label for="country">Country:</label>
					<select name="country" id="country" class="form-control sel-size">
						<option value="">--Select Country--</option>
						<?php if (mysqli_num_rows($result) > 0) {
						 		while($row = mysqli_fetch_assoc($result)) {?>
						<option value="<?php echo $row['id'];?>"><?php echo $row['country_name']; ?></option>
							<?php }
						}?>
					</select>
				</div>
				<div class="form-group">
					<label for="state">State:</label>
					<select name="state" id="state" class="form-control sel-size">

					</select>
				</div>
				<div class="form-group">
					<label for="city">City:</label>
					<select name="city" id="city" class="form-control sel-size"></select>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#country").on("change",function(){
					var country_id = $("#country").val();
					if(country_id == ""){
						$("#state").empty();
						$("#city").empty();
					}else{
						$.ajax({
							url: "get_state.php",
							type: "POST",
							data: {country_id: country_id,
									type: "state" },
							dataType: "json",
							success: function(res){
								if(res){
									$("#state").empty();
									$('#state').append($('<option>').val("").text("--Select State--"));
									$.each(res,function(key,value){
	          							$("#state").append('<option value="'+value.id+'">'+value.state_name+'</option>');
	        						});
								} 
							}
						});
					}
				});
				$("#state").on("change",function(){
					var state_id = $("#state").val();
					if(state_id == ""){
						$("#city").empty();
					}else{
						$.ajax({
							url: "get_state.php",
							type: "POST",
							data: {state_id: state_id,
									type: "city" },
							success: function(res){
								$("#city").empty();
								$('#city').append($('<option>').val("").text("--Select City--"));
								if(res){
									for(var i=0; i<res.length;i++){
	 									$('#city').append($('<option>').val(res[i].id).text(res[i].city_name));
	 								}
								}
							}
						});
					}
				});
			});
		</script>
	</body>
</html>