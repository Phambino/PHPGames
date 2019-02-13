<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";
	require_once "model/something.php";
	require_once "model/GuessGame.php";
	require_once "model/RPS.php";
	require_once "model/Frog.php";

	session_save_path("sess");
	session_start(); 

	$dbconn = db_connect();

	$errors=array();
	$view="";

	/* controller code */

	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}

	switch($_SESSION['state']){
		case "unavailable":
			$view="unavailable.php";
			if(isset($_REQUEST['logout'])) {
				session_destroy();
				session_start();
				$_SESSION['state'] = 'login';
				$view="login.php";
				break;
			}
			
			if(isset($_REQUEST['gg'])) {
				$_SESSION['GuessGame'] = new GuessGame();
				$_SESSION['state'] = 'gg';
				$view = "gg.php";
			}

			if(isset($_REQUEST['rps'])) {
				$_SESSION['RPS'] = new RPS();
				$_SESSION['state'] = 'rps';
				$view = "rps.php";
			}

			if(isset($_REQUEST['frogs'])) {
				$_SESSION['Frog'] = new Frog();
				$_SESSION['state'] = 'frog';
				$view = "frog.php";
			}

			if(isset($_REQUEST['userprofile'])) {
				$_SESSION['state'] = 'userprofile';
				$view = "userprofile.php";
			}

			if(isset($_REQUEST['gamestats'])) {
				$_SESSION['state'] = 'gamestats';
				$view = "gamestats.php";
			}

			break;
	
		case "logout":
			session_destroy();
			session_start();
			$_SESSION['state'] = 'login';
			break;

		case "login":
			// the view we display by default
			$view="login.php";
			if(isset($_REQUEST['new'])) {
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
			$query = "SELECT * FROM appuser WHERE username=$1 and password=$2;";
                	$result = pg_prepare($dbconn, "", $query);

                	$result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
                	if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['user']=$_REQUEST['user'];
				$_SESSION['state']='unavailable';
				$view="unavailable.php";
			} else {
				$errors[]="invalid login";
			}
			break;

                case "registration":
                        // the view we display by default
                        $view="registration.php";
 			if(isset($_REQUEST['new'])) {
                                $_SESSION['state'] = 'login';
                                $view="login.php";
                                break;
                        }

                        // check if submit or not
                        if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="register"){
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
                        $query = "SELECT * FROM appuser WHERE username=$1;";
                        $result = pg_prepare($dbconn, "", $query);

                        $result = pg_execute($dbconn, "", array($_REQUEST['user']));
                        if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
                                $errors[] = "User already exists";
				break;
                        } else {
				$query2 = "INSERT INTO appuser(username, password) VALUES($1, $2);";
				$result2 = pg_prepare($dbconn, "", $query2);
				$result2 = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
				$_SESSION['state'] = "login";
				$view = "login.php";
                        }
                        break;

		case "gg":
			// the view we display by default
			$view="gg.php";
                        if(isset($_REQUEST['back2'])) {
                                $_SESSION['state'] = 'unavailable';
                                $view = "unavailable.php";
                                break;
                        }

			// check if submit or not
			if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="guess"){
				break;
			}

			// validate and set errors
			if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
			if($_SESSION["GuessGame"]->getState()=="correct"){
				$_SESSION['state']="ggwin";
				$view="ggwin.php";
			}
			$_REQUEST['guess']="";

			break;

		case "ggwin":
			// the view we display by default
			$view="gg.php";
			if(isset($_REQUEST['back'])) {
				$_SESSION['state'] = 'unavailable';
				$view = "unavailable.php";
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

		case "rps":
			$view="rps.php";
			if(isset($_REQUEST['back'])) {
				$_SESSION['state'] = 'unavailable';
				$view = "unavailable.php";
				break;
			}
			if(isset($_REQUEST['rock'])) {
				$_SESSION['RPS']->makeGuess(0);
			} else if(isset($_REQUEST['paper'])) {
				$_SESSION['RPS']->makeGuess(1);
			} else if(isset($_REQUEST['scissors'])) {
				$_SESSION['RPS']->makeGuess(2);
			}
			
			break;

		case "frog":
			$view="frog.php";
                        if(isset($_REQUEST['back'])) {
                                $_SESSION['state'] = 'unavailable';
                                $view = "unavailable.php";
                                break;
                        }

			if(isset($_REQUEST['leftfrog1'])) {
				$_SESSION['Frog']->makeMove("leftfrog1");
			} else if(isset($_REQUEST['leftfrog2'])) {
				$_SESSION['Frog']->makeMove("leftfrog2");
			} else if(isset($_REQUEST['leftfrog3'])) {
                                $_SESSION['Frog']->makeMove("leftfrog3");
                        } else if(isset($_REQUEST['rightfrog3'])) {
                                $_SESSION['Frog']->makeMove("rightfrog3");
                        } else if(isset($_REQUEST['rightfrog2'])) {
                                $_SESSION['Frog']->makeMove("rightfrog2");
                        } else if(isset($_REQUEST['rightfrog1'])) {
                                $_SESSION['Frog']->makeMove("rightfrog1");
                        }

			break;

		case "userprofile":
			$view="userprofile.php";
                        if(isset($_REQUEST['back'])) {
                                $_SESSION['state'] = 'unavailable';
                                $view = "unavailable.php";
                                break;
                        }

                        // check if submit or not
                        if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="register"){
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
			break;

		case "gamestats":
			$view="gamestats.php";
                        if(isset($_REQUEST['back'])) {
                                $_SESSION['state'] = 'unavailable';
                                $view = "unavailable.php";
                                break;
                        }
			

			break;
	}
	require_once "view/$view";
?>
