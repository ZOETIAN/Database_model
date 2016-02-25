<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PPTS</title>
    <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class = "site">
<?php
if (empty($_POST)):
?>
	<form action=<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]);
?> method="post">
		<div class = "logo">
			<a href="topp.php"><img src="media/logo.jpg" alt="logo"/></a>
		</div>
			
		<div id="nav">
			<ul id="menu">
				<li><a href="login.php">Log in/out</a></li>		
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
			
			
			<label for="sortBy">Sort By</label>
			<select id="sortBy" name="sortBy">
				<option value=" "> </option>
				<option value="buoy_id">Buoy ID</option>
				<option value="date">Date</option>
				<option value="time">Time</option>
				<option value="int_temp">Inner-Temp</option>
				<option value="ext_temp">Exter-Temp</option>
				<option value="depth">Depth</option>
			</select>
			<label for="sortDirection">Sort Direction</label>
			<select id="sortDirection" name="sortDirection">
				<option value=""></option>
				<option value="ascending">Ascending Order</option>
				<option value="descending">Descending Order</option>
			</select>
		
		<br/>
		<br/>
		<div>
			<h4>Include:</h4>
			<br/>
			<label><input type="checkbox" name="date">Date</label>
			<label><input type="checkbox" name="depth">Depth</label>			
			<label><input type="checkbox" name="time">Time</label>
			<label><input type="checkbox" name="light">Light</label>
			<label><input type="checkbox" name="int_temp">Int-Temp</label>
			<label><input type="checkbox" name="ext_temp">Ext-Temp</label>
			<label><input type="checkbox" name="buoy_id">Buoy ID</label>
			<label><input type="checkbox" name="ptt">PTT</label>
			<label><input type="checkbox" name="latitude">Latitude</label>
			<label><input type="checkbox" name="longitude">Longitude</label>																																																					
		</div>
		<br/>
		<br/>
		<div>
			<input type="submit" value="Search" class="search">
		</div>
	</form>
<?php
else:
?>
<?php
    $user     = "root";
    $host     = "localhost";
    $password = "";
    $database = "topp";
    
    $cxn = mysql_connect($host, $user, $password, $database);
	mysql_select_db($database);
    if (!$cxn) {
		echo"<div class = 'logo'>
					<a href='topp.php'><img src='media/logo.jpg' alt='logo'/></a>
				</div>
			
				<div id='nav'>
					<ul id='menu'>
						<li><a href='login.php'>Log in/out</a></li>		
						<li><a href='contact.php'>Contact</a></li>
					</ul>	
				</div>";
        echo "Could not connect to server</br>";
        trigger_error(mysql_error(), E_USER_ERROR);
		
    } else {
		echo"<div class = 'logo'>
					<a href='topp.php'><img src='media/logo.jpg' alt='logo'/></a>
			</div>
			
				<div id='nav'>
					<ul id='menu'>
						<li><a href='login.php'>Log in/out</a></li>		
						<li><a href='contact.php'>Contact</a></li>
					</ul>	
				</div>";
        echo "Connection established<br/><br/>";
    }
    
    $query = "SELECT * FROM reading";
    
    // Time for getting our post variables and then build a query!
    if ($_POST["sortBy"]) {
        $query .= " ORDER BY " . $_POST["sortBy"];
        
        if ($_POST["sortDirection"]) {
            if ($_POST["sortDirection"] == "ascending") {
                $query .= " ASC";
            } else if ($_POST["sortDirection"] == "descending") {
                $query .= " DESC";
            }
        }
    }
    
    $result = mysql_query($query, $cxn);
    
    if (!$result) {
        echo "Could not execute query: $query\n";
		echo"Sorry, you may need to retry again!<br/><br/>";
		echo"<div><a href='topp.php'><input type='button' value='Return'></a></div>";
        trigger_error(mysql_error(), E_USER_ERROR);
    } else {
        echo "Query: $query executed<br/><br/>";
    }
    
    $num_rows = mysql_num_rows($result);
    
    if ($num_rows <= 0) {
        echo "No data found in the query.<br />";
    } else {
        $isDate      = false;
        $isTime      = false;
        $isBuoyid    = false;
        $isptt       = false;
        $isDepth     = false;
        $isIntTemp   = false;
        $isExtTemp   = false;
        $isLight     = false;
        $isLatitude  = false;
        $isLongitude = false;
        
        
        
        // Check which columns were selected
        If (isset($_POST['date']) && $_POST['date'] == "on") {
            $isDate = true;
        }
        
        if (isset($_POST['depth']) && $_POST['depth'] == "on") {
            $isDepth = true;
        }
        
        if (isset($_POST['time']) && $_POST['time'] == "on") {
            $isTime = true;
        }
        
        if (isset($_POST['light']) && $_POST['light'] == "on") {
            $isLight = true;
        }
        
        if (isset($_POST['int_temp']) && $_POST['int_temp'] == "on") {
            $isIntTemp = true;
        }
        
        if (isset($_POST['ext_temp']) && $_POST['ext_temp'] == "on") {
            $isExtTemp = true;
        }
        
        if (isset($_POST['buoy_id']) && $_POST['buoy_id'] == "on") {
            $isBuoyid = true;
        }
        
        if (isset($_POST['ptt']) && $_POST['ptt'] == "on") {
            $isptt = true;
        }
        
        if (isset($_POST['latitude']) && $_POST['latitude'] == "on") {
            $isLatitude = true;
        }
        
        if (isset($_POST['longitude']) && $_POST['longitude'] == "on") {
            $isLongitude = true;
        }
        
        // We will build a table to output data - yay tables
        $output = "<table>";
        
        $output .= "<tbody>";
		 $output .= "<tr>";
		if ($isDate == true) {
                $output .= "<td>" ."Date" . "&nbsp;"."</td>";
            }
            
            if ($isTime == true) {
                $output .= "<td>" . "Time" . "&nbsp;". "</td>";
            }
            
            if ($isBuoyid == true) {
                $output .= "<td>" ."buoy_id". "&nbsp;" . "</td>";
            }
            
            if ($isptt == true) {
                $output .= "<td>" . "ptt" . "&nbsp;". "</td>";
            }
            
            if ($isDepth == true) {
                $output .= "<td>" . "depth" . "&nbsp;". "</td>";
            }
            
            if ($isIntTemp == true) {
                $output .= "<td>" . "int_temp" . "&nbsp;". "</td>";
            }
            
            if ($isExtTemp == true) {
                $output .= "<td>" . "ext_temp" . "&nbsp;". "</td>";
            }
            
            if ($isLight == true) {
                $output .= "<td>" . "light". "&nbsp;" . "</td>";
            }
            
            if ($isLatitude == true) {
                $output .= "<td>" . "latitude" . "&nbsp;". "</td>";
            }
            
            if ($isLongitude == true) {
                $output .= "<td>" . "longitude" . "&nbsp;". "</td>";
            }
			$output .= "</tr>";
        while ($row = mysql_fetch_assoc($result)) {
            $query .= "<>br/<tr>";
            if ($isDate == true) {
                $output .= "<td>" .$row["date"] . "&nbsp;"."</td>";
            }
            
            if ($isTime == true) {
                $output .= "<td>" . $row["time"] . "&nbsp;". "</td>";
            }
            
            if ($isBuoyid == true) {
                $output .= "<td>" . $row["buoy_id"]. "&nbsp;" . "</td>";
            }
            
            if ($isptt == true) {
                $output .= "<td>" . $row["ptt"] . "&nbsp;". "</td>";
            }
            
            if ($isDepth == true) {
                $output .= "<td>" . $row["depth"] . "&nbsp;". "</td>";
            }
            
            if ($isIntTemp == true) {
                $output .= "<td>" . $row["int_temp"] . "&nbsp;". "</td>";
            }
            
            if ($isExtTemp == true) {
                $output .= "<td>" . $row["ext_temp"] . "&nbsp;". "</td>";
            }
            
            if ($isLight == true) {
                $output .= "<td>" . $row["light"]. "&nbsp;" . "</td>";
            }
            
            if ($isLatitude == true) {
                $output .= "<td>" . $row["latitude"] . "&nbsp;". "</td>";
            }
            
            if ($isLongitude == true) {
                $output .= "<td>" . $row["longitude"] . "&nbsp;". "</td>";
            }
            $output .= "</tr>";//////////////////////
        }
        $output .= "</tbody></table>";
        
        echo $output;
    }
    
    echo "<br /><div><a href='topp.php'><input type='button' value='Return'></a></div>";
	
?>
<?php
endif;
?>
</div>
</body>	
</html>
