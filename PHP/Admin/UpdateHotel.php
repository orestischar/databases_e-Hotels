<!DOCTYPE html>

<?php
	session_start();
	require 'connectToDB.php';

	$Hotel_Group_ID = $Hotel_ID = $Stars = $Number_Of_Rooms = $Street = $Number = $Postal_Code = $City = "";
	$error = "";

	if(isset($_GET['Hotel_ID']) && is_numeric($_GET['Hotel_ID']) && $_GET['Hotel_ID'] > 0 && isset($_GET['Hotel_Group_ID']) && is_numeric($_GET['Hotel_Group_ID']) && $_GET['Hotel_Group_ID'] > 0 && isset($_GET['Number_Of_Rooms']) && is_numeric($_GET['Number_Of_Rooms']) && $_GET['Number_Of_Rooms'] > 0)
	{		
		
		$Hotel_ID = $_GET['Hotel_ID'];

		$_SESSION['Hotel_ID'] = $Hotel_ID;

		$Hotel_Group_ID = $_GET['Hotel_Group_ID'];

		$_SESSION['Hotel_Group_ID'] = $Hotel_Group_ID;

		$Number_Of_Rooms = $_GET['Number_Of_Rooms'];

		$_SESSION['Number_Of_Rooms'] = $Number_Of_Rooms;

		$query = "SELECT * FROM `Hotel` WHERE Hotel_ID = '$Hotel_ID' AND Hotel_Group_ID = '$Hotel_Group_ID' AND Number_Of_Rooms = '$Number_Of_Rooms'";


		/*$result = mysqli_query($mysql_connection,$query);
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.\n", $row_cnt);*/

		if (!($query_run = mysqli_query($mysql_connection, $query))) {
			$er = mysqli_error($mysql_connection);
			$error = "<div class='alert alert-danger alert-dismissable fade in'><strong>$er<strong>. </div>";
		}
		else
		{	
			$row = mysqli_fetch_assoc($query_run);
			$Stars  = $row["Stars"];
			$Street = $row["Street"];
			$Number = $row["Number"];
			$Postal_Code = $row["Postal_Code"];
			$City = $row["City"];
			header("Location: UpdateHotel.php#popup4");
		
		}
	}

	if(isset($_POST['submit']))
	{
		//isset()
		$Stars = isset($_POST['Stars']) ? $_POST['Stars'] : "";
		$Stars = !empty($_POST['Stars']) ? $_POST['Stars'] : "";

		//isset()
		$Street = isset($_POST['Street']) ? $_POST['Street'] : "";
		$Street = !empty($_POST['Street']) ? $_POST['Street'] : "";

		//isset()
		$Number = isset($_POST['Number']) ? $_POST['Number'] : "";
		$Number = !empty($_POST['Number']) ? $_POST['Number'] : "";

		//isset()
		$Postal_Code  = isset($_POST['Postal_Code']) ? $_POST['Postal_Code'] : "";
		$Postal_Code  = !empty($_POST['Postal_Code']) ? $_POST['Postal_Code'] : "";

		//isset()
		$City = isset($_POST['City']) ? $_POST['City'] : "";
		$City = !empty($_POST['City']) ? $_POST['City'] : "";

		$Hotel_ID = $_SESSION['Hotel_ID'];
		$Hotel_Group_ID = $_SESSION['Hotel_Group_ID'];
		$Number_Of_Rooms = $_SESSION['Number_Of_Rooms'];

		if (!is_numeric($Postal_Code))
		{
			$error = "<div class='alert alert-danger alert-dismissable fade in'> <strong>Ο Ταχυδρομικός Κώδικας δεν μπορεί να έχει χαρακτήρες<strong>. </div>";
		}

		$query = "UPDATE `Hotel` SET Stars ='$Stars', Street ='$Street', Number ='$Number', Postal_Code='$Postal_Code', City = '$City' WHERE Number_Of_Rooms = '$Number_Of_Rooms' AND Hotel_Group_ID ='$Hotel_Group_ID' AND Hotel_ID ='$Hotel_ID'";

		if (!mysqli_query($mysql_connection, $query)) {

			$er = mysqli_error($mysql_connection);
			$error = "<div class='alert alert-danger alert-dismissable fade in'><strong>$er<strong>.</div>";
		}
		else
		{

			mysqli_close($mysql_connection);

			//session_destroy();

			header("Location: UpdateHotel.php#popup2");
		}
	}
	
?>


<html>
	<head>
		<title> Project in Databases Course, Spring 2017-2018</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
		<meta name="Author" content="Georgiou Dimitrios, Chardouvelis Orestis, Eleftheriou Sofia" />
		<meta name="description" content="The main menu page for the project" />
		<meta name="keywords" content="project, databases" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style2.css" />
    </head>
	<body>
	<?php require 'connectToDB.php'; ?>
		<div class = "header-layer">
			<h1> Επιχειρησιακή Βάση Δεδομένων για την εταιρεία HO-HOteleies Services </h1>
			<h2 style="text-align:center"> <em> Welcome to our Database! <em>Insert, Delete and Update Database as you wish </h2>
			<div class="typewriter"><h2> Κεντρικό μενού επιλογών </h2></div>
		</div>
		<ul class = "pre-medium-layer">
			<li class = "menu"> <a href = ""> Εισαγωγή στη Βάση Δεδομένων </a> </li>
			<li class = "menu"> <a href = ""> Ενημέρωση της Βάσης Δεδομένων </a></li>
			<li class = "menu"> <a href = ""> Διαγραφή από τη Βάση Δεδομένων </a> </li>
		</ul>
		<div class="medium-layer">
			<img src= "ho_ho.jpg" class = "image"></img>
				<div class="infos">
					<strong><p></p>
					<p></p>
					<p></p>
					<p></p>
					<h2 style="text-align:center">Εξαμηνιαία εργασία</h2>
					<p>National Technical University of Athens</p>
					<p>School of Electrical & Computer Engineering</p>
					<p><u>Course</u>: Databases </p>
					<p><u>Database Project</u></p>
					<ul class ="ul-names">
						<li class="li-names">Georgiou Dimitrios 03115106</li>
						<li class="li-names">Chardouvelis Georgios-Orestis 03115100</li>
						<li class="li-names">Eleftheriou Sofia 03114795</li>
					</ul>
					<p>TEAM 99</p>
					<p><p></strong>
				</div>
		</div>
		<div class ="bottom-layer">
			<p>&copy; Η παρούσα ιστοσελίδα αποτελεί εξαμηνιαία εργασία για το μάθημα <strong>Βάσεις Δεδομένων</strong> του <strong>6ου Εξαμήνου</strong> της σχολής ΣΗΜΜΥ του Εθνικού Μετσοβίου Πολυτεχνείου για το έτος <strong>2017-2018</strong>.<br><br>
			</p>
		</div>
	<div id = "popup2" class="overlay">
		<div class="popup">
			<?php 
				echo $error;
				$Hotel_ID = $_SESSION['Hotel_ID'];
				
			?>
			<h2>Do you want to update the email address or the phone number?</h2><br>
			<a class="close" href="index.php"><button type="button" id="delete">X</button></a>
			<div class="content">
				<a href="UpdateHotelEmailAddress.php?Hotel_ID=<?php echo $Hotel_ID;?>"><button type="submit" name="Email_Address" class="submit blue" id="H_Email_Address">Update Email</button></a>
				<a href="UpdateHotelPhoneNumber.php?Hotel_ID=<?php echo $Hotel_ID;?>"><button type="submit" name="Phone_Number" class="submit blue" id="H_Phone_Number">Update Phone</button></a>
				<form method="post" action="index.php" id = "homepageimage">
					<button type="submit" id = "homepageimage_pointer" ><img src= "home.png" alt="Smiley face" height="33" width="33"></img></button>
				</form>
			</div>

		</div>
	</div>
	<div id="popup3" class="overlay">
		<div class="popup">
			<?php echo $error;?>
			<?php
		    	$result = mysqli_query($mysql_connection,"SELECT * FROM `Hotel`");
		    	
		    ?>
			<h2 style = "font-size: 20px;">Choose the Hotel of a specific Hotel Group,fill the following form and press submit to update the chosen row!</h2><br><br><br>
			<a class="close" href="index.php"><button type="button" id="delete"><h2>X</h2></button></a>


			<div class="content">
				<nav class="dropdown">
					<button onclick="myFunction()" class="dropbtn">Choose a Hotel to Update</button>
				  	<div id="myDropdown" class="dropdown-content show">
					    <input type="text" placeholder="Search..." id="myInput" onkeyup="filterFunction()">
					    	<div id = "scroll">
					    	<?php
					    		echo('<table class = "scroll_list"><tr><th>Hotel ID</th><th>Hotel Group ID</th><th>Number of Rooms</th><th>Stars</th><th>Street</th><th>Number</th><th>Postal Code</th><th>City</th></tr>');
					    		
						    	while($row = mysqli_fetch_array($result))
								{
									echo ('<tr><td style="background-color : #808080;"><a href="UpdateHotel.php?Hotel_ID=' . $row['Hotel_ID']. '&Hotel_Group_ID=' . $row['Hotel_Group_ID'] . '&Number_Of_Rooms=' . $row['Number_Of_Rooms'].'">' . $row['Hotel_ID'] .'</td><td style="background-color : #808080;">' . $row['Hotel_Group_ID'] .'</td><td style="background-color : #808080;">'. $row['Number_Of_Rooms'] .'</td><td>' . $row['Stars'] .'</td><td>'.$row['Street'] .'</td><td>'. $row['Number'] . '</td><td>'  . $row['Postal_Code'] . '</td><td>'  . $row['City'] . '</td></tr>');

								}
								echo('</table>');

							?>
							</div>
				  	</div>
				</nav>
			
				<label for="Hotel_ID">Hotel ID 🔒</label><br>
				<input type="int" name="Hotel_ID" disabled><br>

		 		<label for="Hotel_Group_ID">Hotel Group ID 🔒</label><br>
				<input type="int" name="Hotel_Group_ID" disabled><br>

				<label for="Number_Of_Rooms">Number of Rooms 🔒</label><br>
				<input type="int" name="Number_Of_Rooms" disabled><br>

				<label for="Stars">Stars:</label><br>
				<input type="int" name="Stars" placeholder="Hotel's Stars..." disabled><br>
				
				<label for="Street">Street Name:</label><br>
				<input  type="text" name="Street" placeholder="Hotel's Street Name..." disabled><br>

				<label for="Number">Street Number:</label><br>
				<input type="text" name="Number" placeholder="Hotel's Street Number..." disabled><br>

				<label for="City">City:</label><br>
				<input type="text" name="City" placeholder="City..." required><br>

				<label for="Postal_Code">Postal Code:</label><br>
				<input type="int" name="Postal_Code" placeholder="Postal Code..." disabled><br>


				<form method="post" action="index.php" class = "homepageimage1">
    					<button type="submit" id = "homepageimage_pointer" ><img src= "home.png" alt="Smiley face" height="33" width="33"></img></button>
				</form>
			</div>
		</div>
	</div>
	<div id="popup4" class="overlay">
		<div class="popup">
			<div class = "content">
				<h2>Fill the following form and press submit to update the chosen row!</h2><br><br><br>
				<a class="close" href="index.php"><button type="button" id="delete"><h2>X</h2></button></a>

				<form  action = "UpdateHotel.php" method="post">
				 		<label for="Hotel_ID">Hotel ID 🔒</label><br>
						<input style = "color:red; opacity:1;" type="int" name="Hotel_ID" value="<?php echo $_SESSION['Hotel_ID'];?>" disabled><br>

						<label for="Hotel_Group_ID">Hotel Group ID 🔒</label><br>
						<input style = "color:red; opacity:1;" type="int" name="Hotel_Group_ID" value="<?php echo $_SESSION['Hotel_Group_ID'];?>" disabled><br>

						<label for="Number_Of_Rooms">Number Of Rooms 🔒</label><br>
						<input style = "color:red; opacity:1;" type="int" name="Number_Of_Rooms" value="<?php echo $_SESSION['Number_Of_Rooms'];?>" disabled><br>

						<label for="Stars">Stars:</label><br>
						<input  type="int" maxlength="1" name="Stars" placeholder="Hotel's Stars...<?php echo $Stars;?>" required><br>

						<label for="Street">Street Name:</label><br>
						<input type="text" name="Street" placeholder="Hotel's Street Name<?php echo $Street;?>" required><br>

						<label for="Number">Street Number:</label><br>
						<input type="text" name="Number" placeholder="Hotel's Street Number<?php echo $Number;?>"><br>

						<label for="City">City:</label><br>
						<input type="text" name="City" placeholder="City...<?php echo $City;?>" required><br>

						<label for="Postal_Code">Postal Code:</label><br>
						<input type="int" name="Postal_Code" placeholder="Postal Code...<?php echo $Postal_Code;?>" required><br>


						<button type="submit" name="submit" class="submit" id="submit">Submit</button>
				</form>
				<form method="post" action="index.php" class = "homepageimage2">
					<button type="submit" id = "homepageimage_pointer" ><img src= "home.png" alt="Smiley face" height="33" width="33"></img></button>
				</form>
			</div>

		</div>
	</div>


	<script>
	/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
	function myFunction() {
	    document.getElementById("myDropdown").classList.toggle("show");
	}

	function filterFunction() {
	    var input, filter, ul, li, a, i;
	    input = document.getElementById("myInput");
	    filter = input.value.toUpperCase();
	    div = document.getElementById("myDropdown");
	    a = div.getElementsByTagName("tr");
	    for (i = 0; i < a.length; i++) {
	        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
	            a[i].style.display = "";
	        } else {
	            a[i].style.display = "none";
	        }
	    }
	}
	$(document).ready(function() {

	    $('.scroll_list tr').click(function() {
	        var href = $(this).find("a").attr("href");
	        if(href) {
	            window.location = href;
	        }
	    });

	});
	
	</script>

	</body>

</html>
