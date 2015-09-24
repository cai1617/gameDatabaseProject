<?php

	///////////////////////////////////////////////////
	// CHANGE THESE VALUES
	///////////////////////////////////////////////////
	
	define( 'DB_SERVER', 'wesleycaicom.ipagemysql.com' );
	define( 'DB_USER',   'real_games1234' );
	define( 'DB_PW',     'real_games1234' );
	define( 'DB_NAME',   'real_games1234' );
	
	///////////////////////////////////////////////////

	$mysqli = new mysqli( DB_SERVER, DB_USER, DB_PW, DB_NAME );
				$connected = false;
				if ( $mysqli->connect_errno ) 
				{
					echo htmlentities( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error );
				}
				else
				{
					htmlentities( 'Success!' );
					$connected = true;
				}
				
// 				var_dump( $_GET );
// 				var_dump( $_GET['game'] );
// 				var_dump( $_GET['company'] );
// 				var_dump( $_GET['platform'] );
// 				var_dump( $_POST );
				
				
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Xiaoyong Cai">
	<title>index</title>
	<meta name="description" content="WIT COMP355 GameProject">
	<meta name="keywords" content="WIT,COMP355,GameProject">
	<link rel="shortcut icon" href="http://faviconist.com/icons/22c4997b370f5bbbeec24150507f98ef/favicon.ico" />
	<link href="main.css" rel="stylesheet" type="text/css">
    <script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") 
    
    function do_this(){

        var checkboxes = document.getElementsByName('platform[]');
        var button = document.getElementById('toggle');

        if(button.value == 'select'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'select';
        }
    }
    </script>
</head>

<body>
  <div id="Body_div">
        <!--the first part:This is the header-->
        <header>   	
            <h1>Game Project</h1>
                
          <nav>
            <h4 style="color:#ffffff">Wesley Cai, Schyler Weiss</h4>
           		<ul id="navMenu">
                	<li><a href="index.php"> Home - </a> </li>                  
                    <li><a href="price.php"> Price - </a></li>
                    <li><a href="company.php"> Company - </a></li>
                    <li><a href="platform.php">Platform - </a></li>
                   <li><a href="developer.php">Developer - </a></li>
                    <li><a href="genre.php">Genre</a></li>
                </ul>          
           </nav>
       <hr>
  	   </header>

	        <!--it was article before,left column-->   
          <aside>
              <h4>Platform</h4>
			<form  style="text-align: left" method="GET" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
			How many customers own these platforms below ? <br> <br>
			
			<input type="checkbox" name="platform[]" value="Window">Windows<br>
			<input type="checkbox" name="platform[]" value="Mac OS">Mac OS<br>
			<input type="checkbox" name="platform[]" value="IOS">IOS<br>
			<input type="checkbox" name="platform[]" value="Android">Android<br>
			<input type="checkbox" name="platform[]" value="PSP">PSP<br>
			<input type="checkbox" name="platform[]" value="PS">PS<br>
			<input type="checkbox" name="platform[]" value="Wii">Wii<br>
			<input type="checkbox" name="platform[]" value="WiiU">WiiU<br>
			<input type="checkbox" name="platform[]" value="Game Cube">Game Cube<br>
			<input type="checkbox" name="platform[]" value="XBox">XBox<br>
			<br>
			<input type="checkbox" id="toggle" value="select" onClick="do_this()" /><b>Select All</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" />
			</form>

			
			
			<?php
				
					if ( isset( $_GET['platform'] ) )
					{
						// SQL to Prepare
						$sql_p = null;
						if ( empty( $_GET['platform']  ) )
							{
								$sql_p = 'SELECT game_made.p_name AS platform, game_made.num_games AS games, num_bought_rev.bought, format(num_bought_rev.revenue,2) AS revenue , num_user.The_number_of_user AS users' .
							   			' FROM( Select gp.p_id,p.p_name, count(*)AS num_games From  game_on_platform gp join platform p on gp.p_id = p.p_id GROUP BY gp.p_id) game_made' .
							   			' Left Join ( Select p.p_id, count(*) as Bought, sum(gp.price) AS revenue FROM customer_buy_gp cgp join game_on_platform gp on cgp.gp_id = gp.gp_id' .
							   			' join platform p on gp.p_id = p.p_id GROUP BY p.p_id) num_bought_rev on game_made.p_id = num_bought_rev.p_id'.
							   			' Left Join(SELECT p.p_id, count(*) AS The_number_of_user FROM customer_own_device cod join platform p on cod.p_id = p.p_id'.
							   			' GROUP BY p.p_id) num_user ON game_made.p_id = num_user.p_id'.
							   			' ORDER BY num_bought_rev.revenue DESC, num_bought_rev.bought DESC,game_made.num_games DESC';
							}
						else
						{
							if(isset($_GET['platform']) != 0 ) {
						 		$str_var = array();
						 		for($x = 0; $x < count($_GET['platform']); $x++){
						 				$str_var[] = '?';
						 		}
						 		$str_var = '(' . implode(',', $str_var) . ')';
								$sql_p = 'SELECT game_made.p_name AS platform, game_made.num_games AS games, num_bought_rev.bought, format(num_bought_rev.revenue,2) AS revenue , num_user.The_number_of_user AS users' .
							   			' FROM( Select gp.p_id,p.p_name, count(*)AS num_games From  game_on_platform gp join platform p on gp.p_id = p.p_id GROUP BY gp.p_id) game_made' .
							   			' Left Join ( Select p.p_id, count(*) as Bought, sum(gp.price) AS revenue FROM customer_buy_gp cgp join game_on_platform gp on cgp.gp_id = gp.gp_id' .
							   			' join platform p on gp.p_id = p.p_id GROUP BY p.p_id) num_bought_rev on game_made.p_id = num_bought_rev.p_id'.
							   			' Left Join(SELECT p.p_id, count(*) AS The_number_of_user FROM customer_own_device cod join platform p on cod.p_id = p.p_id'.
							   			' GROUP BY p.p_id) num_user ON game_made.p_id = num_user.p_id'.
							   			' WHERE game_made.p_name IN ' . $str_var .
							   			' ORDER BY num_bought_rev.revenue DESC, num_bought_rev.bought DESC,game_made.num_games DESC';
							   			
// 							   	$sql_p = 'SELECT p.p_name AS Device, count(*) AS The_number_of_user' .
// 							   			' FROM customer_own_device cod' .
// 							   			' join platform p on cod.p_id = p.p_id' .
// 							   			' WHERE p.p_name in ' . $str_var .
// 							  			' GROUP BY p.p_id'.
// 							 			' ORDER BY The_number_of_user DESC';						 
						 
								}

							}

	
 	


							htmlentities( $sql_p );
							
							
							// Preparing
							if ( !( $stmt = $mysqli->prepare( $sql_p ) ) ) 
								{
									echo htmlentities( "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error );
								}
// 							else
// 								{
// 									echo 'Success!';
// 							}
							
							// Binding parameter
							
							$params = array( 0=>'' );
							for($x = 0; $x < count($_GET['platform']); $x++){
								$params[0] .= 's';
								$params[] = $_GET['platform'][ $x ];
							}
							$refs = array();
							for($x = 0; $x <= count($_GET['platform']); $x++){
								$refs[ $x ] = &$params[ $x ];
							}
					
							if ( !call_user_func_array( array( $stmt, 'bind_param' ), $refs ) )
							{
								echo htmlentities( "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error );
							}
// 							else
// 							{
// 								echo 'Success!';
// 							}
							
							// Executing
							if ( !$stmt->execute() ) 
							{
								echo htmlentities( "Execute failed: (" . $stmt->errno . ") " . $stmt->error );
							}
// 							else
// 							{
// 								echo 'Success!';
// 							}
							
								
							
						}

						
			
				?>


			


          </aside>   
            
         <!--This is the section for right column-->    
         
         
    	<section class="right_column">
     	   		
				<?php
				 
				 if ( isset( $_GET['platform'] ) ){
				 	echo "<p style='text-align:left'><b>Results</b></p>";
					$platform_name  = null;
					$games_p  = null;
					$num_bought  = null;
					$total_revenue  = null;
					$num_users = null;
					$stmt->bind_result( $platform_name, $games_p,$num_bought,$total_revenue ,$num_users);
					
					echo "<table border='1' style='width:90% ;text-align: center ;border-collapse: collapse' >
					<tr>
					<th style='background-color: gray;color: white'>Platform</th>
					<th style='background-color: gray;color: white'>Games</th>
					<th style='background-color: gray;color: white'>Purchases</th>
					<th style='background-color: gray;color: white'>Revenue</th>
					<th style='background-color: gray;color: white'>Users</th>
    				</tr>";
					while ( $stmt->fetch() )
					{
						echo ( '<tr><td>' . htmlentities( $platform_name ) .
							  '</td><td>' . htmlentities( $games_p ).
							  '</td><td>' . htmlentities( $num_bought ).
							  '</td><td>' . htmlentities( $total_revenue ).
							  '</td><td>' . htmlentities( $num_users ).
							  '</td></tr>' );
					}
					echo "</table>";
					$stmt->close();
				}
				?>

  		 </section>
         
 
   	     
    	<!--the third part:This is the footer-->    
        <footer>
            <hr>    
            <p class="no_margin">Copyright&copy;2015 <a style="color:#ffffff" href="mailto:caix@wit.edu">caix@wit.edu</a></p>
        </footer>  
  </div>

</body>
</html>
