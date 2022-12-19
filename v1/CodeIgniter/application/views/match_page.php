
<style>
.text-center {
 
 text-align: left !important;
             } 
</style> 
<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                         
                        
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

                                                                                echo '<h1>';
                                                                                echo '<br>';
                                                                                echo 'Question n°'.$mb.' :';
                                                                                echo '</h1>';
                                                                                
                                                                                $_id=$no['que_id'];
                                                                                echo '<h5>';
                                                                                echo $no['que_texte'];
                                                                                echo '</h5>';
                                                                                        $mb=$mb+1;
                                                                                
                                                                                foreach($ligne as $reste)
                                                                                {
                                                                                        if(strcmp($_id,$reste['que_id'])==0)
                                                                                        {
                                                                                                echo '<br>';
                                                                                                echo '<h6>';
                                                                                                echo 'Réponse '.$nb.' : '; 
                                                                                                echo '</h6>';                                    
                                                                                                echo $reste['rep_libelle']; 
                                                                                                echo '<br>';
                                                                                                $nb=$nb+1;  
                                                                                        }
                                                                                        
                                                                                }
                                                                                $traite[$no["que_texte"]]=1;
                                                                        }
                                                                        
                                                                        
                                                                        
                                                }
                                                $mb=0;
                                        }
                                        
                                      
                
                   
                ?>
                
        </div>
</section>