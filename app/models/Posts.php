<?php
//przygotuj zapytanie
class Posts{
    public function showPosts($_db, $id=null)
    {
        if(!$id==null)
        {
            $query='SELECT id_post, postTitle, postDesc, postCont, postDate FROM posts, post_details where posts.id_post=post_details.id_post_details AND id_post='.$id.' ORDER BY id_post DESC';
        }
        else
        {
            $query='SELECT id_post, postTitle, postDesc, postDate FROM posts, post_details where posts.id_post=post_details.id_post_details ORDER BY id_post DESC'; 
        }        
        
         try{
        $stmt = $_db->prepare($query);
        $stmt->execute();   
        } 
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    
        return $stmt;
    }
}