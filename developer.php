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
              <h4>Developer </h4>

			<form  style="text-align: left" method="GET" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
			How much experience for game developers? <br> <br>
			
			<input type="radio" name="developer" value="10">Top 10 developers<br>
			<input type="radio" name="developer" value="20">Top 20 developers<br>
			<input type="radio" name="developer" value="50">Top 50 developers<br>
			<br>
			<input type="radio" name="developer" value="80"><b>All developers</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" />
			</form>
			
			<?php
				
				if ( isset( $_GET['developer'] ) )
				{
					//SQL to Prepare
					$sql = null;
					if ( empty( $_GET['developer'] ) )
					{
						$sql = 'SElECT p.f_name AS First_Name, p.l_name AS Last_Name, rcd_f.games_b AS gamesB, rcd_f.teams, format(rcd_f.rev_contr,2) AS Revenue_Contribution, p.email AS Email' .
							   ' FROM ( SELECT count(DISTINCT rev_contri_d.gp_id) as games_b, ssn, SUM(teams) as teams, sum(rev_contr) AS rev_contr' .
							   ' FROM(SELECT gp_dev_freq.gp_id AS gp_id, gp_dev_freq.e_ssn AS ssn,gp_dev_freq.times AS teams, gp_dev_freq.times*gp_ave_rev.ave_rev AS rev_contr' .							   
							   ' FROM ( SELECT wt.gp_id, gp.gp_name, wt.e_ssn, count(*) as times FROM work_on_team wt join game_on_platform gp on wt.gp_id = gp.gp_id GROUP BY wt.gp_id,wt.e_ssn) AS gp_dev_freq' .
							   ' JOIN ( SELECT  gp_dev_Count.gp_id AS gp_id,  gp_rev.revenue/ gp_dev_Count.num_dev AS ave_rev' .							   
							   ' FROM( SELECT wt.gp_id,gp.gp_name,count(*) as num_dev FROM work_on_team wt join game_on_platform gp on wt.gp_id = gp.gp_id GROUP BY gp.gp_id) AS gp_dev_Count' .
							   ' JOIN ( SELECT gp.gp_id, gp.gp_name, SUM(gp.price) AS revenue FROM game_on_platform gp join customer_buy_gp cgp on gp.gp_id = cgp.gp_id GROUP BY gp.gp_id) AS gp_rev' .							   
							   ' ON gp_dev_Count.gp_id = gp_rev.gp_id) AS gp_ave_rev' .
							   ' ON gp_dev_freq.gp_id = gp_ave_rev.gp_id ) AS rev_contri_d' .							   
							   ' GROUP BY rev_contri_d.ssn) AS rcd_f' .
							   ' JOIN person p ON rcd_f.ssn = p.ssn' .							   
							   ' ORDER BY rcd_f.rev_contr DESC, gamesB DESC, teams DESC';
					}
					else
					{
						$sql = 'SElECT p.f_name AS First_Name, p.l_name AS Last_Name, rcd_f.games_b AS gamesB, rcd_f.teams, format(rcd_f.rev_contr,2) AS Revenue_Contribution, p.email AS Email' .
							   ' FROM ( SELECT count(DISTINCT rev_contri_d.gp_id) as games_b, ssn, SUM(teams) as teams, sum(rev_contr) AS rev_contr' .
							   ' FROM(SELECT gp_dev_freq.gp_id AS gp_id, gp_dev_freq.e_ssn AS ssn,gp_dev_freq.times AS teams, gp_dev_freq.times*gp_ave_rev.ave_rev AS rev_contr' .							   
							   ' FROM ( SELECT wt.gp_id, gp.gp_name, wt.e_ssn, count(*) as times FROM work_on_team wt join game_on_platform gp on wt.gp_id = gp.gp_id GROUP BY wt.gp_id,wt.e_ssn) AS gp_dev_freq' .
							   ' JOIN ( SELECT  gp_dev_Count.gp_id AS gp_id,  gp_rev.revenue/ gp_dev_Count.num_dev AS ave_rev' .							   
							   ' FROM( SELECT wt.gp_id,gp.gp_name,count(*) as num_dev FROM work_on_team wt join game_on_platform gp on wt.gp_id = gp.gp_id GROUP BY gp.gp_id) AS gp_dev_Count' .
							   ' JOIN ( SELECT gp.gp_id, gp.gp_name, SUM(gp.price) AS revenue FROM game_on_platform gp join customer_buy_gp cgp on gp.gp_id = cgp.gp_id GROUP BY gp.gp_id) AS gp_rev' .							   
							   ' ON gp_dev_Count.gp_id = gp_rev.gp_id) AS gp_ave_rev' .
							   ' ON gp_dev_freq.gp_id = gp_ave_rev.gp_id ) AS rev_contri_d' .							   
							   ' GROUP BY rev_contri_d.ssn) AS rcd_f ' .
							   ' JOIN person p ON rcd_f.ssn = p.ssn ' .							   
							   ' ORDER BY rcd_f.rev_contr DESC, gamesB DESC, teams DESC '.
							   ' LIMIT ? ';
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
					if ( !is_null( $_GET['developer'] ) )
					{
						if ( !$stmt->bind_param( "i", $_GET['developer'] ) ) 
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
				 
				 if ( isset( $_GET['developer'] ) ){
				 	echo "<p style='text-align:left'><b>Results</b></p>";
					$f_name  = null;
					$l_name = null;
					$game_b = null;
					$teams = null;
					$revenue_c = null;
					$email = null;
					$stmt->bind_result( $f_name, $l_name,$game_b,$teams,$revenue_c,$email);
					
					echo "<table border='1' style='width:100% ;text-align: center ;border-collapse: collapse' >
					<tr>
					<th style='background-color: gray;color: white'>First Name</th>
					<th style='background-color: gray;color: white'>Last Name</th>
					<th style='background-color: gray;color: white'>Games built</th>
					<th style='background-color: gray;color: white'>Teams</th>
					<th style='background-color: gray;color: white'>Revenue Contribution</th>
					<th style='background-color: gray;color: white'>Email Address</th>
    				</tr>";
					while ( $stmt->fetch() )
					{
						echo ( '<tr><td>' . htmlentities( $f_name ) .
							  '</td><td>' . htmlentities( $l_name ).
							  '</td><td>' . htmlentities( $game_b ).
							  '</td><td>' . htmlentities( $teams ).
							  '</td><td>$ ' . htmlentities( $revenue_c ).
							  '</td><td>' . htmlentities( $email ).
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
