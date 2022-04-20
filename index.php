<?php
	require_once 'class.calendar.php';
	$phpCalendar = new PHPCalendar ();
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CUML : Reservation Rooms</title>
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link href="style.css" type="text/css" rel="stylesheet" />
		<!--<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/jquery.validate.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>!-->

		<style>
			body{
				font-family: Arial;
				text-align: center;
			}

			tr, td{
				padding: 1rem .5rem;
				border: 1px solid #ccc;
			}

			thead{
				background: #333;
				color: #fff;
			}

			button{
				padding:  1rem 1.5rem;
				background: blue;
				text-transform: uppercase;
				color: #fff;
				border: none;
				border-radius: 10px;
				cursor: pointer;
				outline: none;
			}
		</style>
	</head>

	<script>
		$(document).ready(function(){
   				
				loadRoomdata();
				//loadBook();
				$(document).on("click", '.prev', function(event) { 
					var month =  $(this).data("prev-month");
					var year =  $(this).data("prev-year");
					getCalendar(month,year);
				});
				$(document).on("click", '.next', function(event) { 
					var month =  $(this).data("next-month");
					var year =  $(this).data("next-year");
					getCalendar(month,year);
				});
				$(document).on("blur", '#currentYear', function(event) { 
					var month =  $('#currentMonth').text();
					var year = $('#currentYear').text();
					getCalendar(month,year);
				});
   		});

		function loadRoomdata()
		{
			var dataget;
			var keyword = "null";
			$.ajax({  
			    url:"roomlist.php",
			    method:"GET",  
			    data:{keyword:keyword},  
			          success:function(result){  
			              	var content = '';
			              	var book_keyword = "";
			              	var book_id = "";

			          		var obj = jQuery.parseJSON(result);
			          		if(obj)
			          		{
			          			//alert(obj);
			          			dataget = obj;

			          			$.each(dataget, function(key, val) {
			          				$("#plist").append('<option value="'+val.room_id+'">'+val.name+'</option>');
			          			});
			          		}else{
			          			alert("Empty");
			          		}
			          }  
			    });
		}

		function SearchTime()
		{
			var roomid;

			roomid = $("#plist").val();

			//alert(roomid);

				var keyword = roomid;
				var bookdate = sdate;
				var no = 0;
				var dataget;
				$.ajax({  
			          url:"timelist.php",
			          method:"GET",  
			          data:{keyword:keyword},  
			          success:function(result){  
			              	var content = '';

			          		var obj = jQuery.parseJSON(result);
			          		if(obj)
			          		{
			          			//alert(obj);
			          			dataget = obj;

			          			$.each(dataget, function(key, val) {

			          					if(val.room_id == roomid)
			          					{
			          						content = content + '<tr>';
				          					//content = content + '<td>'+val.keyword+'</td>';
				          					//content = content + '<td><a href="javascript:loadBook4(\''+val.keyword+'\')">'+val.name+'</a></td>';
				          					//content = content + '<td><a href="javascript:loadBook4('+book_keyword+')">'+val.name+'</a></td>';
				          					content = content + '<td>'+val.slot_id+'</td>';
											content = content + '<td>'+val.time_start+'-'+val.time_end+'</td>';
											content = content + '</tr>';
			          					}
			          					
			          			});
			          		}else{
			          			alert("Empty");
			          		}
			          		$('#info').html(content);
			          }  
			    });
		}

		function SearchTimeII()
		{
			var roomid;
			var sdate;

			roomid = $("#plist").val();
			sdate = $("#bookdate").val();

			//alert(sdate);
			//alert(roomid);

				var keyword = roomid;
				var bookdate = sdate;
				var no = 0;
				var dataget;
			if(sdate != ""){
				//alert(sdate);
				$.ajax({  
			          url:"checkroom.php",
			          method:"GET",  
			          data:{keyword:keyword, bookdate:bookdate},  
			          success:function(result){  
			          		//alert(result);
			              	var content = '';

			          		var obj = jQuery.parseJSON(result);
			          		if(obj)
			          		{
			          			//alert(obj);
			          			dataget = obj;

			          			content = content + '<div class="btn-group">';
			          			$.each(dataget, function(key, val) {

			          						//content = content + '<tr>';
				          					//content = content + '<td>'+val.keyword+'</td>';
				          					//content = content + '<td><a href="javascript:loadBook4(\''+val.keyword+'\')">'+val.name+'</a></td>';
				          					//content = content + '<td><a href="javascript:loadBook4('+book_keyword+')">'+val.name+'</a></td>';
				          					//content = content + '<td>'+val.slot_id+'</td>';
											//content = content + '<td>'+val.time_start+'-'+val.time_end+'</td>';
											//content = content + '</tr>';

			          					content = content + '<button class="w3-btn w3-red" onclick="ClearReserve()">Not Available</button>';
			          			});
			          			content = content + '</div>';
			          		}else{
			          			alert("Empty");
			          		}
			          		$('#info').html(content);
			          }  
			    });
			}else{
				alert("Please input date!");
			}
				
		}

		function getCalendar(month,year){
			$("#body-overlay").show();
			$.ajax({
				url: "calendar-ajax.php",
				type: "POST",
				data:'month='+month+'&year='+year,
				success: function(response){
					setInterval(function() {$("#body-overlay").hide(); },500);
					$("#calendar-html-output").html(response);	
				},
				error: function(){} 
			});
			
		}

		function ClearReserve()
		{
			//alert("Clear");
			document.getElementById('BookModal').style.display='block';
		}

		function ClearReserve()
		{
			//alert("Clear");
			document.getElementById('BookModal').style.display='block';
		}

		function ClearValue()
		{
			document.getElementById('BookModal').style.display='none';
		}
	</script>

	<body>
		<h3>CUML : Reservation Rooms</h3>
		<p>&nbsp;</p>
		<form method="post">
			Room : 
			<select class="form-control" id="plist"></select>
			&nbsp;&nbsp;&nbsp;
			<label for="bookdate">Date:</label>
  			<input type="date" id="bookdate" name="bookdate">
			</input>&nbsp;&nbsp;<button type="button" onclick="SearchTimeII()">Search</button>
		</form>
		<div class="w3-row">
			<div class="w3-container w3-quarter">
		    	<table width="100%">
					<tbody id="info">
					
					</tbody>
				</table>
		  	</div>
		  	<div class="w3-container w3-threequarter">
		  		<!--<div id="bookinfo"></div>
		    	<table width="100%">
					<tbody id="bookinfo">
					
					</tbody>
				</table>!-->
		    	<!--<button type="button" onclick="loadBook()">Change Content</button>!-->
		    	<div id="body-overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>
				<div id="calendar-html-output">
				<?php
				//$calendarHTML = $phpCalendar->getCalendarHTML();
				//echo $calendarHTML;
				?>
				</div>
		  	</div>
		</div>

		<!-- Modal Book Data -->
      <div id="BookModal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      
          <div class="w3-center"><br>
            <span onClick="ClearValue();" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
          </div>
          <div class="w3-container w3-section">
          		<p><h4><i class="fa fa-wrench w3-large" style="color:#030"></i>&nbsp;&nbsp;<b>Confirm to cancel ? </b></h4></p>
          </div>
    
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          	<button onClick="ClearValue();" type="button" class="w3-button w3-green">Yes</button>&nbsp;&nbsp;&nbsp;
            <button onClick="ClearValue();" type="button" class="w3-button w3-red">No</button>
          </div>
    
        </div>
      </div>
     <!-- End Update Modal -->
	</body>
</html>