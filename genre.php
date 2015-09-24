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
    <script language=JavaScript>  
    function do_this(){

        var checkboxes = document.getElementsByName('genre[]');
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
            <h1>Game DB Project</h1>
                
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
          
            <h4>Genre </h4>
			<form style="text-align: left" method="GET" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
			The popularities and rating of games under the genre of:<br><br>
			<table style="width:100%">
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Survival_horror">Survival horror</td>
    				<td><input type="checkbox" name="genre[]" value="Action">Action</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Adventure">Adventure</td>
    				<td><input type="checkbox" name="genre[]" value="Survival">Survival</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Puzzle">Puzzle</td>
    				<td><input type="checkbox" name="genre[]" value="Sandbox">Sandbox</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Shooter">Shooter</td>
    				<td><input type="checkbox" name="genre[]" value="RPG">RPG</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Simulation">Simulation</td>
    				<td><input type="checkbox" name="genre[]" value="Sports">Sports</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="Strategy">Strategy</td>
    				<td><input type="checkbox" name="genre[]" value="Fighting">Fighting</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="hack_n_slash">Hack 'n slash</td>
    				<td><input type="checkbox" name="genre[]" value="real_time_strategy">real-time strategy</td>		
  				</tr>
    				<tr>
    				<td><input type="checkbox" name="genre[]" value="maze">Maze</td>
    				<td><input type="checkbox" name="genre[]" value="platformer">Platformer</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="stealth">Stealth</td>
    				<td><input type="checkbox" name="genre[]" value="party">Party</td>		
  				</tr>
  				</tr>
    				<tr>
    				<td><input type="checkbox" name="genre[]" value="board_card">Board/card</td>
    				<td><input type="checkbox" name="genre[]" value="educational">Educational</td>		
  				</tr>
  				<tr>
    				<td><input type="checkbox" name="genre[]" value="tile_based">Tile-based</td>
    				<td></td>		
  				</tr>
  				<tr>
  					<td></td>
  					<td></td>
  				</tr>
  				<tr>
    				<td><input type="checkbox" id="toggle" value="select" onClick="do_this()" /> <b> Select All </b> </td>
    				<td><input type="submit" /></td>		
  				</tr>
			</table>
			
<!-- 
			<input type="checkbox" name="genre[]" value="Survival_horror">Survival horror<br>    
			<input type="checkbox" name="genre[]" value="Action">Action
			<input type="checkbox" name="genre[]" value="Adventure">Adventure<br>
			<input type="checkbox" name="genre[]" value="Survival">Survival
			<input type="checkbox" name="genre[]" value="Puzzle">Puzzle<br>
			
			<input type="checkbox" name="genre[]" value="Sandbox">Sandbox
			<input type="checkbox" name="genre[]" value="Shooter">Shooter<br>
			<input type="checkbox" name="genre[]" value="RPG">RPG
			<input type="checkbox" name="genre[]" value="Simulation">Simulation<br>
			<input type="checkbox" name="genre[]" value="Sports">Sports
			
			<input type="checkbox" name="genre[]" value="Strategy">Strategy<br>
			<input type="checkbox" name="genre[]" value="Fighting">Fighting
			<input type="checkbox" name="genre[]" value="hack_n_slash">hack 'n slash<br>
			<input type="checkbox" name="genre[]" value="real_time_strategy">real-time strategy
			<input type="checkbox" name="genre[]" value="maze">maze<br>

			<input type="checkbox" name="genre[]" value="platformer">platformer
			<input type="checkbox" name="genre[]" value="stealth">stealth<br>
			<input type="checkbox" name="genre[]" value="party">party
			<input type="checkbox" name="genre[]" value="board_card">board/card<br>
			<input type="checkbox" name="genre[]" value="educational">educational
			<input type="checkbox" name="genre[]" value="tile_based">tile-based<br>
			<br>	
			<input type="checkbox" id="toggle" value="select" onClick="do_this()" />Select All
			<input type="submit" />			
 -->
			</form>
			

			
			<?php
				
					if ( isset( $_GET['genre'] ) )
					{
						// SQL to Prepare
						$sql_p = null;
						if ( empty( $_GET['genre']  ) )
							{
								$sql_p = 'SELECT ge.gen_name AS Genra, count(*) AS number_of_purchases,  FORMAT(SUM(gp.price),2) AS Revenue, AVG(cgp.rating) AS Average_Rating' .
							   			' From customer_buy_gp cgp' .
							   			' Join game_on_platform gp on cgp.gp_id = gp.gp_id' .
							   			' Join game g on gp.g_id = g.g_id'.
							   			' Join game_genra gg on g.g_id = gg.game_id'.
							   			' Join genra ge on gg.genra_id = ge.g_id'.
							   			' GROUP BY ge.g_id'.
							   			' ORDER BY Revenue DESC';
							}
							


						else
						{
							if(isset($_GET['genre']) != 0 ) {
						 		$str_var = array();
						 		for($x = 0; $x < count($_GET['genre']); $x++){
						 				$str_var[] = '?';
						 		}
						 		$str_var = '(' . implode(',', $str_var) . ')';
						 
							 			  
							  	$sql_p = 'SELECT ge.gen_name AS Genra, count(*) AS number_of_purchases, SUM(gp.price) AS Revenue, format(AVG(cgp.rating),2) AS Average_Rating' .
							   			' From customer_buy_gp cgp' .
							   			' Join game_on_platform gp on cgp.gp_id = gp.gp_id' .
							   			' Join game g on gp.g_id = g.g_id'.
							   			' Join game_genra gg on g.g_id = gg.game_id'.
							   			' Join genra ge on gg.genra_id = ge.g_id'.
							   			' WHERE ge.gen_name in ' . $str_var .
							   			' GROUP BY ge.g_id'.
							   			' ORDER BY Revenue DESC';					 
						 
						 
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
							for($x = 0; $x < count($_GET['genre']); $x++){
								$params[0] .= 's';
								$params[] = $_GET['genre'][ $x ];
							}
							$refs = array();
							for($x = 0; $x <= count($_GET['genre']); $x++){
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
				 
				 if ( isset( $_GET['genre'] ) ){
				 	echo "<p style='text-align:left'><b>Results</b></p>";
					$genre  = null;
					$purchases = null;
					$revenue = null;
					$ave_rating = null;
					$stmt->bind_result( $genre, $purchases,$revenue,$ave_rating);
					
					echo "<table border='1' style='width:90% ;text-align: center ;border-collapse: collapse' >
					<tr>
					<th style='background-color: gray;color: white'>Genre</th>
					<th style='background-color: gray;color: white'>The Number of Purchases</th>
					<th style='background-color: gray;color: white'>Total Revenue</th>
					<th style='background-color: gray;color: white'>Average Rating</th>
    				</tr>";
					while ( $stmt->fetch() )
					{
						echo ( '<tr><td>' . htmlentities( $genre ) .
							  '</td><td>' . htmlentities( $purchases ).
							  '</td><td>$ ' . htmlentities( $revenue ).
							  '</td><td>' . htmlentities( $ave_rating ).
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
