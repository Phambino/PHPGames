<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";
	require_once "model/something.php";
	require_once "model/GuessGame.php";
	require_once "model/RPS.php";
	require_once "model/Frogs.php";
	require_once "model/Profile.php";
	require_once "model/Allstats.php";

	session_save_path("sess");
	session_start(); 

	$dbconn = db_connect();

	$errors=array();
	$view="";
	$loggedin = "";

	/* controller code */

	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}

	switch($_SESSION['state']){
		case "login":
			// the view we display by default
			$view="login.php";

			if(isset($_REQUEST['regi'])) {
				$_SESSION['state'] = 'registration';
				$view="registration.php";
				break;
			}

			// check if submit or not
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
				break;
			}

			// validate and set errors
			if(empty($_REQUEST['user']))$errors[]='user is required';
			if(empty($_REQUEST['password']))$errors[]='password is required';
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			$query = "SELECT * FROM appuser WHERE userid=$1 and password=$2;";
			$result = pg_prepare($dbconn, "", $query);

			$result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
			if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['state']='allstats';
				$view="allstats.php";
				$loggedin = $_REQUEST['user'];

				// Create Profile for profile page and allstats page
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($loggedin));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Profile']= new Profile($row2['userid'], $row2['password'], $row2['email'], $row2['gender'], $row2['colour']);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
			} else {
				$errors[]="invalid login";
			}
			break;

		case "registration":
			$view="registration.php";
			if(isset($_REQUEST['log'])) {
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="register"){
				break;
			}

			// check empty forms
			if(empty($_REQUEST['user']))$errors[]='user is required';
			if(empty($_REQUEST['password']))$errors[]='password is required';
			if(empty($_REQUEST['email']))$errors[]='email is required';
			if(empty($_REQUEST['gender']))$errors[]='gender is required';

			if($_REQUEST['password'] != $_REQUEST['password2']) {
				$errors[]='password does not match';
			}

			if($_REQUEST['colour'] == "na") {
				$errors[]='colour is required';
			}

			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}

			// register new user
			$query = "SELECT * FROM appuser WHERE userid=$1;";
			$result = pg_prepare($dbconn, "", $query);

			$result = pg_execute($dbconn, "", array($_REQUEST['user']));
			if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$errors[] = "User already exists";
			} else {
				$query2 = "INSERT INTO appuser(userid, password, email, gender, colour, ggwin, rpswin, rpsloss, rpsdraw, frogwin) VALUES($1, $2, $3, $4, $5, 0, 0, 0, 0, 0);";
				$result2 = pg_prepare($dbconn, "", $query2);
				$result2 = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['gender'], $_REQUEST['colour']));
				$_SESSION['state'] = "login";
				$view = "login.php";
            }

			break;

		case "allstats":
			$view="allstats.php";
			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}

			break;

		case "gg":
			$view="gg.php";

			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}

			if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="guess"){
				break;
			}

			// validate and set errors
			if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary and update database
			$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
			if($_SESSION["GuessGame"]->getState()=="correct"){
				$w = $_SESSION['Allstats']->getggwin() + 1;

				if(!$dbconn){
					$errors[]="Can't connect to db";
					break;
				}
				$query = "UPDATE appuser SET ggwin=$1 where userid=$2;";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($w, $_SESSION['Profile']->getName()));

				$_SESSION['state']="won";
				$view="won.php";
			}
			$_REQUEST['guess']="";

			break;

		case "frogs":
			$view="frogs.php";

			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs']) || isset($_REQUEST['retry'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}
			
			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}

			if(isset($_REQUEST['leftfrog1'])) {
				$_SESSION['Frogs']->makeMove("leftfrog1");
			} else if(isset($_REQUEST['leftfrog2'])) {
				$_SESSION['Frogs']->makeMove("leftfrog2");
			} else if(isset($_REQUEST['leftfrog3'])) {
				$_SESSION['Frogs']->makeMove("leftfrog3");
			} else if(isset($_REQUEST['rightfrog3'])) {
				$_SESSION['Frogs']->makeMove("rightfrog3");
			} else if(isset($_REQUEST['rightfrog2'])) {
				$_SESSION['Frogs']->makeMove("rightfrog2");
			} else if(isset($_REQUEST['rightfrog1'])) {
				$_SESSION['Frogs']->makeMove("rightfrog1");
			}

			if($_SESSION["Frogs"]->getState()=="YOU WIN") {
				$w = $_SESSION['Allstats']->getfrogwin() + 1;

				if(!$dbconn){
					$errors[]="Can't connect to db";
					break;
				}
				$query = "UPDATE appuser SET frogwin=$1 where userid=$2;";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($w, $_SESSION['Profile']->getName()));
			}

			break;

		case "rps":
			$view="rps.php";

			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}


			if(isset($_REQUEST["rock"])) {
				$_SESSION['RPS']->makeGuess(0);
			} else if(isset($_REQUEST["paper"])) {
				$_SESSION['RPS']->makeGuess(1);
			} else if(isset($_REQUEST["scissors"])) {
				$_SESSION['RPS']->makeGuess(2);
			}

			// allstat change in db
			if($_SESSION["RPS"]->getState()=="you win!") {
				$w = $_SESSION['Allstats']->getrpswin() + 1;

				if(!$dbconn){
					$errors[]="Can't connect to db";
					break;
				}
				$query = "UPDATE appuser SET rpswin=$1 where userid=$2;";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($w, $_SESSION['Profile']->getName()));
			} else if($_SESSION["RPS"]->getState()=="you lose!") {
				$w = $_SESSION['Allstats']->getrpsloss() + 1;

				if(!$dbconn){
					$errors[]="Can't connect to db";
					break;
				}
				$query = "UPDATE appuser SET rpsloss=$1 where userid=$2;";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($w, $_SESSION['Profile']->getName()));
			} else if($_SESSION["RPS"]->getState()=="draw!") {
				$w = $_SESSION['Allstats']->getrpsdraw() + 1;

				if(!$dbconn){
					$errors[]="Can't connect to db";
					break;
				}
				$query = "UPDATE appuser SET rpsdraw=$1 where userid=$2;";
				$result = pg_prepare($dbconn, "", $query);
				$result = pg_execute($dbconn, "", array($w, $_SESSION['Profile']->getName()));
			}

			break;

		case "profile":
			$view="profile.php";

			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}

			// check empty boxes
			if(empty($_REQUEST['oldpassword']))$errors[]='Please specify old password';
			if(empty($_REQUEST['newpassword']))$errors[]='Please specify new password';
			if(empty($_REQUEST['email']))$errors[]='Please specify new email';
			if(empty($_REQUEST['gender']))$errors[]='Please specify new gender';

			if($_REQUEST['newpassword'] != $_REQUEST['newpassword2']) {
				$errors[]='Your new password does not match';
			}

			if($_REQUEST['colour'] == "na") {
				$errors[]='Please specify new colour';
			}

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}

			// check if old password is the same or else error
			$q3 = "SELECT * FROM appuser WHERE userid=$1;";
			$r3 = pg_prepare($dbconn, "", $q3);
			$r3 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
			$row3 = pg_fetch_array($r3, NULL, PGSQL_ASSOC);
			if($row3['password'] != $_REQUEST['oldpassword']) {
				$errors[]='Old password is incorrect';
			}
			if(!empty($errors))break;

			// Update all indicated values
			$q4 = "UPDATE appuser SET password=$1 WHERE password=$2;";
			$r4 = pg_prepare($dbconn, "", $q4);
			$r4 = pg_execute($dbconn, "", array($_REQUEST['newpassword'], $_SESSION['Profile']->getPassword()));

			$q4 = "UPDATE appuser SET email=$1 WHERE email=$2;";
			$r4 = pg_prepare($dbconn, "", $q4);
			$r4 = pg_execute($dbconn, "", array($_REQUEST['email'], $_SESSION['Profile']->getEmail()));

			$q4 = "UPDATE appuser SET gender=$1 WHERE gender=$2;";
			$r4 = pg_prepare($dbconn, "", $q4);
			$r4 = pg_execute($dbconn, "", array($_REQUEST['gender'], $_SESSION['Profile']->getGender()));

			$q4 = "UPDATE appuser SET colour=$1 WHERE colour=$2;";
			$r4 = pg_prepare($dbconn, "", $q4);
			$r4 = pg_execute($dbconn, "", array($_REQUEST['colour'], $_SESSION['Profile']->getColour()));

			$_SESSION['Profile'] = new Profile($_SESSION['Profile']->getName(), $_REQUEST['newpassword'], $_REQUEST['email'], $_REQUEST['gender'], $_REQUEST['colour']);

			break;

		case "won":
			// the view we display by default
			$view="gg.php";

			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}

			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state'] = 'gg';
				$view="gg.php";
				break;
			}

			if(isset($_REQUEST['allstats'])) {
				$query2 = "SELECT * FROM appuser WHERE userid=$1;";
				$r2 = pg_prepare($dbconn, "", $query2);
				$r2 = pg_execute($dbconn, "", array($_SESSION['Profile']->getName()));
				$row2 = pg_fetch_array($r2, NULL, PGSQL_ASSOC);
				$_SESSION['Allstats'] = new Allstats($row2['ggwin'], $row2['rpswin'], $row2['rpsloss'], $row2['rpsdraw'], $row2['frogwin']);
				$_SESSION['state'] = "allstats";
				$view="allstats.php";
				break;
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frogs']=new Frogs();
				$_SESSION['state'] = "frogs";
				$view="frogs.php";
				break;
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS']=new RPS();
				$_SESSION['state'] = "rps";
				$view="rps.php";
				break;
			}

			if(isset($_REQUEST['profile'])) {
				$_SESSION['state'] = "profile";
				$view="profile.php";
				break;
			}

			// check if submit or not
			if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="start again"){
				$errors[]="Invalid request";
				$view="won.php";
			}

			// validate and set errors
			if(!empty($errors))break;


			// perform operation, switching state and view if necessary
			$_SESSION["GuessGame"]=new GuessGame();
			$_SESSION['state']="gg";
			$view="gg.php";

			break;
			
	}
	
	require_once "view/$view";
?>
