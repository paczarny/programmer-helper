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
        <a href="wyloguj.php">Wyloguj się</a>
    </div>
    <hr />
    
				<?php
			try {
                $stmt = $db->query('SELECT id_post, postTitle, postDesc, postDate FROM posts, post_details where posts.id_post_details=post_details.id_post_details ORDER BY id_post DESC ');
        while($row = $stmt->fetch()){
            
            echo '<div>';
                echo '<h1><a href="concretepost.php?id='.$row['id_post'].'">'.$row['postTitle'].'</a></h1>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postDesc'].'</p>';                
                echo '<p><a href="concretepost.php?id='.$row['id_post'].'">Read More</a></p>';                
            echo '</div>';

        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
		?>
   
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>