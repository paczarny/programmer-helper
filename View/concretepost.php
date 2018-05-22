<?php include_once '../Config/config.php';


$stmt = $db->prepare('SELECT id_post, postTitle, postCont, postDate FROM posts, post_details where posts.id_post_details=post_details.id_post_details and id_post =:id_post');
$stmt->execute(array(':id_post' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['id_post'] == ''){
	header('Location: index.php');
	exit;
}

?>                  
<!DOCTYPE html>
<?php include_once 'header.php'; ?>
<html lang="en">
<body>
<div class="container">

        <h1  style="display: inline;">Programmer helper</h1>
        <div class="login" style="display: inline;">
            <?php
            if($user->is_logged_in()){
                echo "<a href='wyloguj.php'>Wyloguj się</a>";    
            }
            else{
                 echo "<a href='logowanie.php'>Logowanie & rejestracja</a>";
            }

            ?>
        <a href="logowanie.php"><span><?php$desc?></span></a>
        </div>
		<hr />
		<p><a href="index.php">Powrót</a></p>

        
		<?php	
            if (isset($_SESSION['not_logged']) && !empty($_SESSION['not_logged']))
			 {
				echo "Musisz się zalogować żeby skontaktować się z programistą.";
				unset($_SESSION['not_logged']);
			 }       
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
        $var=$row['id_post'];
        echo "<a href='kontakt.php?id=$var''>Kontakt</a>";
		?>

   
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>
