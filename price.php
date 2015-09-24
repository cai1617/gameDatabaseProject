<?php

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
					htmlentities( '  ' );
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
    <!--<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>-->
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
              <h4>Price</h4>
			<form method="GET" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
			What are the prices of a game in different platforms ? 
			<br><br><br>
			Enter the name of a game: 
			<br>
 
			<input type="text" name="game" value="" />
			<input type="submit" />
			</form><br><br><br><br>
			For examples:
				<ul style="text-align:left">
			    	<li>Minecraft</li> 
                	<li>Flappy bird</li>                  
                    <li>Dragon Age</li>
                    <li>Dota 2</li>
                    <li>Silent Hill</li>
                </ul> 
			<p>
			
			
				<?php
				if ( isset( $_GET['game'] ) ){
					// SQL to Prepare
					$sql = null;
					if ( empty( $_GET['game'] ) )
					{
						$sql = 'Select g.g_name AS game_name, p.p_name AS platform, gp.price AS price' .
							   ' From game_on_platform gp' .
							   ' join platform p on gp.p_id = p.p_id' .
							   ' join game g on gp.g_id = g.g_id';
					}
					else
					{
						$sql = 'Select g.g_name AS game_name, p.p_name AS platform, gp.price AS price' .
							   ' From game_on_platform gp' .
							   ' join platform p on gp.p_id = p.p_id' .
							   ' join game g on gp.g_id = g.g_id'.
							   ' WHERE g.g_name LIKE ?';
					}
					
					htmlentities( $sql );
					

					//Preparing

					if ( !( $stmt = $mysqli->prepare( $sql ) ) ) 
					{
						echo htmlentities( "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error );
					}
// 					else
// 					{
// 						echo 'Success!';
// 					}

			

					if ( !is_null( $_GET['game'] ) )
					{
						//Binding parameter:
					
						if ( !$stmt->bind_param( "s", $_GET['game'] ) ) 
						{
							htmlentities( "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error );
						}
// 						else
// 						{
// 							echo 'Success!';
// 						}
					}

					//Executing:

					if ( !$stmt->execute() ) 
					{
						echo htmlentities( "Execute failed: (" . $stmt->errno . ") " . $stmt->error );
					}
// 					else
// 					{
// 						echo 'Success!';
// 					}
					
					
				}	// end of "if ( isset( $_GET['game'] ) )"
				?>

          </aside>   
            
         <!--This is the section for right column-->    
    	<section class="right_column">
			<p>
  				
				<?php
				if ( isset( $_GET['game'] ) ){
					echo "<h4 style='text-align:left'>Results</h4>";
					$game_name = null;
					$platform_name = null;
					$price_value = null;
					$stmt->bind_result( $game_name, $platform_name,$price_value );
					
				
					echo"<table border='1' style='text-align: center ;width:70% ;border-collapse: collapse' >
					<tr>
					<th style='background-color: gray;color: white'>Game</th>
					<th style='background-color: gray;color: white'>platform</th>
					<th style='background-color: gray;color: white'>Price</th>
					</tr>";

					while ( $stmt->fetch() )
					{
						echo ( '<tr><td>' .htmlentities( $game_name ) .
								'</td><td>' . htmlentities( $platform_name ).
								'</td><td>$ ' . htmlentities( $price_value ).
								'</td></tr>'  );
					}
					
					echo '</table>';
					
// 					while ( $stmt->fetch() )
// 					{
// 						echo ( '&lt;' . htmlentities( $game_name ) . '&gt; ' . htmlentities( $platform_name ).'&lt;' .  htmlentities( $price_value ). '&gt; ' );
// 						echo '<br />';
// 					}
					
					$stmt->close();
				} // end of  "if ( isset( $_GET['game'] ) )"	
				?>
				




			</p>
  		 </section>
         
 
   	     
    	<!--the third part:This is the footer-->    
        <footer>
            <hr>    
            <p class="no_margin">Copyright&copy;2015 <a style="color:#ffffff" href="mailto:caix@wit.edu">caix@wit.edu</a></p>
        </footer>  
  </div>

</body>
</html>
