<style>
.text-center {
 
 text-align: left !important;
             } 
</style> 
<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                         
                        
                       

                        
                                

                                                  
                                                 echo "<h2 class='mb-5'>";
                                                 
                                                        
                                                                      
                                                        
                                                         
                                                         
                                                         
        
                                                                
                                                                        
                                                                        
                                                                

                                                         echo '</h2>';
                                                        $mb=1;
                                                        echo '<h1>
                                                </h1>';
                                                echo '<br>';
                                                echo '<h1> ';
                                                echo 'TOTAL DE  VOTRE SCORE : ';
                                                
                                                echo round($score,1).'%';
                                             $val=1;
                                                foreach ($info as $no)
                                                {
                                                        if($no['qui_rep']=='A')
                                                        {
                                                                $val=0;
                                                        }
                                                }
                                               echo '<br>' ;
                                               echo '<br>';
                                              
                                               if($val==0)
                                               { 
                                                echo '<button class="btn btn-outline-success" onclick="maFonction()">Voir les réponses</button>';
                                               echo '<div id="maDIV" style="display:none;">';
                                               foreach ($info as $no)
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
                                                                
                                                                foreach($info as $reste)
                                                                {
                                                                        if(strcmp($_id,$reste['que_id'])==0)
                                                                        {
                                                                            if($reste['rep_valide']!=1)
                                                                            {$r='  X';}
                                                                            if($reste['rep_valide']==1)
                                                                            {$r=' Réponse correcte !';}

                                                                                echo '<br>';
                                                                                echo '<h4>';
                                                                                echo 'Réponse '.$nb.' : '.$r.''; 
                                                                                echo '<h5>';                                    
                                                                                echo $reste['rep_libelle']; 
                                                                                echo '</h5>';
                                                                                 
                                                                               
                                                                                $nb=$nb+1;  
                                                                        }
                                                                        
                                                                }
                                                                $traite[$no["que_texte"]]=1;
                                                        }
                                                        
                                                        
                                                        
                                

                                                     }
                                                     
                                                      echo '</div>';

                                                  
                                                    


                                                        echo '<script>
                                                        function maFonction() {
                                                          var div = document.getElementById("maDIV");
                                                          if (div.style.display === "none") {
                                                            div.style.display = "block";
                                                          } else {
                                                            div.style.display = "none";
                                                          }
                                                        }
                                                          </script>
                                                            ';
                                                     
                                                    }
                                                    
                                                            else 
                                                     {
                                                        echo '<br>';
                                                        echo 'L\'auteur a prévu de ne pas partager les réponses aux questions du quiz';
                                                    }
                                                                        
                                                $mb=0;
                                                
                                        
                                        
                                      
                
                   
                ?>
                
        </div>
</section>