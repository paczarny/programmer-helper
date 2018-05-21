<?php include_once '../Config/config.php'; 
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>

<!DOCTYPE html>
<?php include_once 'header.php'; ?>
<html lang="en">
<body>
<div class="container">
        
    <h1  style="display: inline;">Programmer helper</h1>
    <div class="login" style="display: inline;">
        <a href="wylogowanie.php">Wyloguj się</a>
    </div>
    <hr />

		<?php
			/*try {
                Show some posts from db
				$stmt = $db->query('SELECT ...');
					


				

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}*/
		?>
   
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>