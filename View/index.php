<?php include_once '../Config/config.php'; 
if($user->is_logged_in())
{ 
    header('Location: programmer-helper.php'); 
}
        

    $select='id_post, postTitle, postDesc, postDate';
    $from='posts INNER JOIN post_details ON posts.id_post_details=post_details.id_post_details';
    $order='id_post DESC'; 
    $stmt=$user->select($select, $from, NULL, $order);
    $rows=$stmt->fetchAll();

?>

<!DOCTYPE html>
<?php include_once 'header.php'; ?>
<html lang="en">
<body>
<div class="container">
        
    <h1  style="display: inline;">Programmer helper</h1>
    <div class="login" style="display: inline;">
        <a href="logowanie.php">Logowanie & rejestracja</a>
    </div>
    <hr />
    
    

		<?php 
    
    

            foreach ($rows as $row){
            echo '<div>';
                echo '<h1><a href="concretepost.php?id='.$row['id_post'].'">'.$row['postTitle'].'</a></h1>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postDesc'].'</p>';                
                echo '<p><a href="concretepost.php?id='.$row['id_post'].'">Read More</a></p>';                
            echo '</div>';

            }

		?>
   
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>