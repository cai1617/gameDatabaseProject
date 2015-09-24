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
    <script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
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
              <h4>Company</h4>
			<form method="GET" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
			What games of this company make ?
			<br><br><br>
			Enter the name of a company: <input type="text" name="company" value="" />
			<input type="submit" />
			</form><br><br><br><br>
			For examples:
				<ul style="text-align:left">
					<li>Sony</li>
                    <li>Nintendo</li>
                    <li>Apple</li>
                    <li>Microsoft</li>
                </ul> 
			
			
			
			<?php
				if ( isset( $_GET['company'] ) )
				{
					//SQL to Prepare
					$sql = null;
					if ( empty( $_GET['company'] ) )
					{
						$sql = 'SELECT c.c_name as Company,g.g_name as Game_name , p.p_name as Platform, gp.price AS Price' .
							   ' FROM game_on_platform gp' .
							   ' join game g  on gp.g_id = g.g_id' .
							   ' join platform p on gp.p_id = p.p_id'.
							   ' join company c on gp.company = c.c_id'.
							   ' ORDER BY c.c_name ';
					}
					else
					{
						$sql = 'SELECT c.c_name as Company,g.g_name as Game_name , p.p_name as Platform, gp.price AS Price' .
							   ' FROM game_on_platform gp' .
							   ' join game g  on gp.g_id = g.g_id' .
							   ' join platform p on gp.p_id = p.p_id'.
							   ' join company c on gp.company = c.c_id'.
							   ' WHERE c.c_name LIKE ? '.
							   ' ORDER BY c.c_name ';
					}
				
					
					htmlentities( $sql );
					
					//Preparing
					if ( !( $stmt = $mysqli->prepare( $sql ) ) ) 
					{
						htmlentities( "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error );
					}
// 					else
// 					{
// 						echo 'Success!';
// 					}
					
					//Binding parameter
					if ( !is_null( $_GET['company'] ) )
					{
						if ( !$stmt->bind_param( "s", $_GET['company'] ) ) 
						{
							htmlentities( "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error );
						}
// 						else
// 						{
// 							echo 'Success!';
// 						}
						
					}
					//Executing
					if ( !$stmt->execute() ) 
					{
						htmlentities( "Execute failed: (" . $stmt->errno . ") " . $stmt->error );
					}
// 					else
// 					{
// 						echo 'Success!';
// 					}
					
				
				}
				
				
			
			?>

          </aside>   
            
         <!--This is the section for right column-->    

         
     	<section class="right_column">
				<?php
				if ( isset( $_GET['company'] ) ){
 					echo "<h4 style='text-align:left'>Results</h4>";
					$company_name = null;
					$game_name = null;
					$platform_name = null;
					$price_value = null;
					$stmt->bind_result($company_name ,$game_name, $platform_name,$price_value );
					
					echo"<table border='1' style='width:80% ;text-align: center ;border-collapse: collapse' >
					<tr>
					<th style='background-color: gray;color: white'>Company</th>
					<th style='background-color: gray;color: white'>Game</th>
					<th style='background-color: gray;color: white'>Platform</th>
					<th style='background-color: gray;color: white'>Price</th>
					</tr>";
 					while ( $stmt->fetch() )
 					{
 						echo ( '<tr><td>' . htmlentities( $company_name )  .
 								'</td><td>' . htmlentities( $game_name )  .
 								'</td><td>' .  htmlentities( $platform_name ) .
 								'</td><td>$ ' .  htmlentities( $price_value ).
 								'</td></tr>'  );
 					}
 					echo "</table>";
					$stmt->close();
				
				} // end of "if ( isset( $_GET['company'] ) )"
				
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
