<?php include_once '../Config/config.php';
$stmt = $db->prepare('SELECT id_post, email, username, name, phone, surname, country, city FROM users, user_detail, addresses, posts where posts.id_post=users.id_user and users.id_user=user_detail.id_user_details and user_detail.id_address=addresses.id_address
and id_post =:id_post');
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
    
    
    <?php
    
    echo '<h1>Kontakt z użytkownikiem '.$row['username'].'</h1>';
    echo "<hr />";
    
    echo '<div>';

				echo '<p>'.'Imię : '.$row['name'].'</p>';				
                echo '<p>'.'Nazwisko : '.$row['surname'].'</p>';				
                echo '<p>'.'Adres e-mail : '.$row['email'].'</p>';				
                echo '<p>'.'Telefon : '.$row['phone'].'</p>';				
                echo '<p>'.'Państwo : '.$row['country'].'</p>';				
                echo '<p>'.'Miasto : '.$row['city'].'</p>';				
			    echo '</div>';
     
    $var=$row['id_post'];
    echo "<a href='concretepost.php?id=$var''>Powrót</a>";
    ?>



		
		
   
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>