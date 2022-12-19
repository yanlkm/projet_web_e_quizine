<section class="testimonials text-center bg-light">

        <div class="container">
<div class="container">

<?php 
                       
                        

?>
                                        <?php
                                        echo form_open('compte/connecter'); 
                                        ?>                
                                         <h1>
                                       <?php
                                        echo'
                                        <label for="num_match">Connexion compte</label><br />';
                                        echo'<br>';
                                        if($error==2)
                                        {
                                                echo '<h1> Couple pseudo/mot de passe inexistant ' ;
                                                echo'<br>';

                                        }
                                        if($error==1)
                                        {
                                                echo '<h1> Au moins un champ vide ou contenant des caractères spéciaux ';
                                                echo'<br>';
                                                
                                        }
                                        echo'<input type="input" name="pseudo" placeholder="Saisir un pseudo" /> <br />';
                                        echo'<br>';

                                        echo'<input type="password" name="mdp" placeholder="Saisir mote de passe" /><br />';
                                        echo'<br>';
                                        echo '<input type="submit" name="submit" value="valider" />';
                                        echo' </form>';
                                         ?>

                    </h1>
                    </div>
        </div>
</section>