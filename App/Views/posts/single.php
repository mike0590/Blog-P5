<?php

$title = 'Article';

ob_start();

if (isset($message) AND $message == 2) { ?>
  <h2>Cet Article n'existe pas !</h2>
  <h3><a href="index.php?p=home">Page d'Accueil</a></h3> <?php
  die();
}

echo '<p>' .$post -> chapo(). '</p></br>';
echo '<h1>' .$post -> title(). '</h1></br>';
echo $post -> content(). '</br></br>';
?>

<div class="row">
  <div class="hidden-xs hidden-sm col-md-6">
   <?php 
   if ($post -> dateUpdate() !== '00/00/0000 - 00h00') {
     echo '<p style="float: left">Dernière Modification : ' .$post -> dateUpdate(). '</p></br></br></br>';
   }
   ?>
  </div>
  <div class="hidden-xs hidden-sm col-md-6"> <?php
    echo '<p style="float: right;">' .$post -> dateT(). '</p></br>';
    echo '<p style="float: right; position: relative; left: 80px;">' .$post -> username. '</p></br></br></br>';
    ?>
  </div>
</div>
<div class="visible-xs visible-sm">
  <?php 
   if ($post -> dateUpdate() !== '00/00/0000 - 00h00') {
     echo '<p style="float: left">Dernière Modification : ' .$post -> dateUpdate(). '</p></br></br></br>';
   }
    echo '<p style="float: right;">' .$post -> dateT(). '</p></br>';
    echo '<p style="float: right; position: relative; left: 80px;">' .$post -> username. '</p></br></br></br>';
   ?>
</div>

 <div class="media mb-4 hidden-xs hidden-sm" style="width: 60%;">
        <?php

        if (isset($message) AND $message == true) { ?>
         <div class=" lol alert alert-success align" role="alert">Message envoyé</div>
       <?php }
       elseif (isset($message) AND $message == false) { ?>
         <div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
       <?php }

         if ($visitor -> userLogged()){ ?>

          <div class="card my-4">
            <h5 class="card-header">Laissez un Commentaire:</h5>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <textarea name="content" class="form-control" rows="3"></textarea></br>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
            </div>
          </div>

        <?php }
        else{ ?>

        <div class="card my-2" style="width:300px;">
            <h5 class="card-header">Votre Pseudo</h5></br>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <input type="text" name="pseudo" class="form-control"></input></br>
                  <h5 class="card-header">Votre mot de pass:</h5><br>
                  <input type="password" name="pass" class="form-control"></input>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
              </form>
            </div>
        </div>
          
       <?php } ?>
        
        </br></br><h4 style="text-align: center">Commentaires</h4>
  </div>
   <div class="media mb-4 visible-xs visible-sm">
        <?php

        if (isset($message) AND $message == 1) { ?>
         <div class=" lol alert alert-success align" role="alert">Message envoyé</div>
       <?php }
       elseif (isset($message) AND $message == 0) { ?>
         <div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
       <?php }

         if ($visitor -> userLogged()){ ?>

          <div class="card my-4">
            <h5 class="card-header">Laissez un Commentaire:</h5>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <textarea name="content" class="form-control" rows="3"></textarea></br>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
            </div>
          </div>

        <?php }
        else{ ?>

        <div class="card my-2" style="width:300px;">
            <h5 class="card-header">Votre Pseudo</h5></br>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <input type="text" name="pseudo" class="form-control"></input></br>
                  <h5 class="card-header">Votre mot de pass:</h5><br>
                  <input type="password" name="pass" class="form-control"></input>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
              </form>
            </div>
        </div>
          
       <?php } ?>
        
        </br></br><h4 style="text-align: center">Commentaires</h4>
  </div>


  <?php 
 
    foreach ($comment as $comment) { ?>
      <h5 class="mt-0"><?php echo $comment -> username; ?></h5>
        <div class="row">
          <div class="col-sm-6">
            <p><?php echo $comment -> content(); ?></p>
          </div>
          <div class="col-sm-6">
            <p><?php echo $comment -> dateT(); ?></p>
          </div>
        </div></br></br>
      <?php
      }
  ?>
  
          
<?php
$content = ob_get_clean();

