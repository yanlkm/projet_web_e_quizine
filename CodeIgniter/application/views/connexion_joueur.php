<section class="testimonials text-center bg-light">

        <div class="container">

            <h1>
                <?php  
                     if($error==6)
                     {
                             echo ' <h1> Pseudo joueur déjà pris ! ';
                     }
                     if($error==7)
                     {
                             echo '<h1> Veuillez saisir le pseudo du joueur !';
                     }
                     


                    echo form_open('match/rejoindre/'.$code_m); 
                    echo'
                    <label for="num_joueur">Choisir votre pseudo</label><br />
                    <input type="input" name="num_joueur" /><br />
                    <br />
                    <input type="submit" name="submit" value="Valider votre pseudo" />';
                    echo' </form>';

                    ?>
                    </h1>
               
               <div class="container">

</section>