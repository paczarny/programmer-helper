<?php include_once '../Config/config.php'; 

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
		<form>
			
			<input type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" >
			
			<input type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >
			
			<input type="submit" value="Zaloguj się">
			
		</form>
    <div class="rejestracja">
        <a href="rejestracja.php">Rejestracja</a> 
    </div>
	</div>
    
	

</body>
</html>