<section class="testimonials text-center bg-light">

<div class="container">




<?php
 echo form_open('connexion/nouveau'); 
 ?>
 
                <?php  
                       
                       echo '<form>';
                        echo form_label('Pseudo :');
                        $champ1=array('name'=>'num_match',
                        'required'=>'required');
                        echo form_input($champ1);

                       
                        ?>
                        <input type="submit" name="submit" value="Créer un compte" />
                        </form>
                         
                         <a class="btn btn-primary" href='<?php echo site_url("accueil/afficher") ?>' role="button">Link</a>
                
</div>
</section>