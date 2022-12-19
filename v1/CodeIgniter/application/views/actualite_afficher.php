<section class="testimonials text-center bg-light">

        <div class="container">
<h1>
    <?php echo $titre;?>
</h1>
<br />
<?php

    if(isset($actu))
     {
        echo '<table class="table">';
        echo '<thead class="thead-dark">';

        echo' <tr> <th scope="col">Texte</th><th scope="col">'.$actu->act_intitule.'</th><th scope="col">Pseudo auteur</th> </tr>';
        echo '</thead>';
        echo'<tbody>';
        echo'<tr>';
        echo'<th scope="row">'.$actu->act_texte.'</th>';
        echo'<td>';
        echo $actu->act_date;
        echo'</td>';
        echo'<td>';
        echo $actu->com_pseudo;
        echo'</td>';
        echo'</tr>';
        echo' </tbody>
            </table>';
        
    }
    else 
    {
        echo "<br />";
        echo "pas d’actualité !";
    }
?>
</div>
</section>