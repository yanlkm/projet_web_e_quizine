<?php echo validation_errors(); ?>

<?php
 echo form_open('compte/connecter'); 
 ?>
    <label for="pseudo">Pseudo</label>
    <input type="input" name="pseudo" /><br />
    <label for="mdp">Mot de passe</label>
    <input type="input" name="mdp" /><br />
    <input type="submit" name="submit" value="Créer un compte" />

</form>