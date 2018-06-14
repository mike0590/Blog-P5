<?php

ob_start();

echo '<h1>' .$post -> title. '</h1></br>';
echo $post -> content. '</br></br>';
echo '<p style="float: right;">' .$post -> date. '</p></br>';
echo '<p style="float: right; position: relative; left: 75px;">' .$post -> author. '</p></br></br></br>';
?>

 <div class="media mb-4" style="width: 60%;">
        <?php
        if ($visitor -> userLogged()){
          echo $comments -> returnCommentBox();
        }
        else{
          echo $comments -> returnLogin();
        } ?>
        
        </br></br><h4 style="text-align: center">Commentaires</h4>
     
      <?php 

      		foreach ($comment as $comment) { ?>
      			
      			  <h5 class="mt-0"><?php echo $comment -> visitor_username; ?></h5>
              <p><?php echo $comment -> content; ?></p>
              <p style="float: right;"><?php echo $comment -> date; ?></p></br></br>
           
      		<?php
      	}
    ?>
              
	</div>
          
<?php
$content = ob_get_clean();

