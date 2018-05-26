<?php include_once '../Config/config.php'; 
if($user->is_logged_in())
{ 
    header('Location: programmer-helper.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="../Resources/logowanie.css" rel="stylesheet"> 
    <title>Logowanie & rejestracja</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>
 <body>
	<div id="container">
    <?php
    if(isset($_GET['action'])){ 
        $message = '<p class="error">Użytkownik '.$_GET['action'].'. Możesz się zalogować.</p>';
	           } 
	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if($user->login($username,$password)){ 

			//logged in return to index page

			header('Location: programmer-helper.php');
			exit;
		

		} else {
			$message = '<p class="error">Wrong username or password.</p>';
		}

	}//end if submit

	if(isset($message)){ echo $message; }
	?>
        
        
		<form method="post">
			
			<input type="text" placeholder="login" name="username" onfocus="this.placeholder=''" onblur="this.placeholder='login'" >
			
			<input type="password" name="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >
			
			<input type="submit" name="submit" value="Zaloguj się">
			
		</form>
    <div class="rejestracja">
        <a href="rejestracja.php">Rejestracja</a> <a href="index.php">Powrót</a> 
    </div>
	</div>
    
	

</body>
</html>