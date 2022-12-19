
<style>
.text-center {
 
 text-align: left !important;
             } 
</style> 
<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                $fin=strlen(current_url());
                $debut = 94; 
                $pseudo = substr(current_url(),$debut,$fin);
                echo '<h1> Votre Pseudo : '.$pseudo;
                echo '</h1>';

                         
                        
                        echo '<h2 class="mb-5">'.$titre.'</h2>';

                        if(!isset($ligne))
                         {
                                
                                 echo   '
                                        <div class="panel-group">
                                        <div class="panel panel-default">
                                        <div class="panel-body"><h1> Aucun match pour le moment</h1></div>
                                        </div>
                                        </div>';
                         }
                         else 
                        {  
                                

                        
                        echo "<h2 class='mb-5'>";
                        
                        foreach ($ligne as $non)
                        {
                                if(!isset($traiter[$non['qui_intitule']])) 
                        {     
                                $_idd=$non['qui_intitule'];
                                $id=$non['qui_id'];
                                        echo $non['qui_intitule']; 
                                        echo '</h2>'; 
                                        
                        } 
                                $traiter[$non["qui_intitule"]]=1;
                                } 
                                        
                        
                                
                        $mb=1;   
                
                        foreach ($ligne as $no)
                        {
                                                $nb=1; 
                        if(!isset($traite[$no['que_texte']])) 
                        {
                                if($no['que_activation']=='A')
                         {


                                echo '<h1>';
                                echo '<br>';
                                echo 'Question n°'.$mb.' :';
                                echo '</h1>';
                                
                                $_id=$no['que_id'];
                                echo '<h5>';
                                echo $no['que_texte'];
                                echo '</h5>';
                                        $mb=$mb+1;
                                        echo '<form method="post" accept-charset="utf-8" action="https://obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/index.php/match/compter/'.$id.'">';
                                echo '<div class="container">';
                                foreach($ligne as $reste)
                                {
                                        if(strcmp($_id,$reste['que_id'])==0)
                                        {
                                                
                                                echo '<br>';
                                                echo '<h6>';
                                                echo 'Réponse '.$nb.' : '; 
                                                echo '</h6>';                                  
                                                echo'<label><input type="radio" id="'.$reste['rep_id'].'" name="'.$reste['que_id'].'" value="'.$reste['rep_id'].'" />'.$reste['rep_libelle'].'</label>' ;
                                                
                                                
                                                echo '<br>';
                                                

                                                $nb=$nb+1; 
                                                
                                                 
                                        }
                                        
                                }
                                echo '</div>';
                                $traite[$no["que_texte"]]=1;
                        }
                                        
                }                 
                                        
                       }      
                        
                        echo '<br>'; 
                        echo '<input type="hidden" READONLY id="pseudo" name="pseudo" value="'.$pseudo.'"/>';
                        echo '<br>'; 
                        echo '<br>'; 
                        if($ligne[0]['mat_datefin']==NULL)
                        {
                           echo '<input type="submit" name="submit" value="Enregistrer vos réponses" />';     
                        }
                        
                        echo '</form>';
$mb=0;
        }
                                        
                                      
                
                   
                ?>
                
        </div>
</section>