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
					echo htmlentities( ' ' );
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
              <h4 style="color:#000"></h4><br><br>
              <p style="text-align:justify">Game DB helps keep track of games and any related info regarding games.
			  For the benefits of any company interested in keeping track of their competition and any customer interested in searching a good deal.</p> 
			 <font size="2"> 	
			  		<p style="text-align:left">A customer can use this program to search: </p>
			  		<ul style="text-align:justify;padding-left:0;list-style-position: inside;">
  					<li>what games of a company had made</li>
  					<li>what a game would cost on different platforms</li>
					</ul> 
					<p style="text-align:left">A company can use this program to know:</p>
			  		<ul style="text-align:justify;padding-left:0;list-style-position: inside;">
  					<li>which platforms to develop for</li>
  					<li>what genre of games is the most popular</li>
  					<li>which game developers has more experience.</li>
					</ul> 
			  <font>

          </aside>   
            
         <!--This is the section for right column-->    
    	<section class="right_column">
           		<img src="src/New_Super_Mario_Bros.jpg" width="500" height="400" usemap="#Map">

  		 </section>
         
 
   	     
    	<!--the third part:This is the footer-->    
        <footer>
            <hr>    
            <p class="no_margin">Copyright&copy;2015 <a style="color:#ffffff" href="mailto:caix@wit.edu">caix@wit.edu</a></p>
        </footer>  
  </div>

</body>
</html>
