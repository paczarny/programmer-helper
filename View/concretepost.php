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

		<h1>Programmer helper</h1>
		<hr />
		<p><a href="index.php">Powrót</a></p>


		<?php	
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
