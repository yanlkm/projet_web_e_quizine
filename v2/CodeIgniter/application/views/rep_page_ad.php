<?php
if (($this->session->userdata('role'))!='F')
{
        redirect('compte/b_connecter');
}
?>

<style>
.text-center {
 
 text-align: left !important;
             } 
</style> 
<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                         
                        
                        echo '<h2 class="mb-5">'.$titre.'</h2>';

                        
                                

                                                  
                echo "<h2 class='mb-5'>";
                
                foreach ($ligne as $non)
                {
                        if(!isset($traiter[$non['qui_intitule']])) 
                {     
                        $_idd=$non['qui_intitule'];
                                echo $non['qui_intitule']; 
                                echo '<br>';
                                echo '<br>';
                                echo 'CODE = '.$non['mat_id'];
                                echo '</h2>'; 
                                
                } 
                        $traiter[$non["qui_intitule"]]=1;
                        } 
                                
                
                        echo '<h5 class="mb-5">Scores des joueurs </h5>';  
                        
                        if($joueur != NULL) 

                        
                                
                                {
                                echo '<table class="table">';
                                echo '<thead class="thead-dark">';

                                echo' <tr> <th scope="col">Score (en %)</th>
                                        <th scope="col">Pseudos joueur</th>
                                        </tr>';
                                echo '</thead>';
                                echo'<tbody>';
                                foreach($joueur as $login)
                                {
                                                
                                        echo'<tr>';
                                        echo'<th scope="row">'.$login["jou_score"].'</th>';
                                        echo'<td>';
                                        echo $login["jou_pseudo"];
                                        echo'</td>';
                                        
                                        echo'</tr>';
                                }
                                echo' 
                                </tbody>
                                </table>';
                        }
                                else 
                                {
                                        echo '<h2 class="mb-5"> ! Aucun Joueur ayant participé ! </h2>';

                                }
                        

                        echo '</h2>';
                $mb=1;
                echo '<h1>
        </h1>';
        echo '<br>';
        echo '<h1> ';
        echo 'TOTAL SCORE MOYEN : ';
        if($res->moy!=NULL)
        {
        echo round($res->moy,1).'%';
        } 
        else 
        {
        echo '0%';
        } 
                                                 foreach ($ligne as $no)
                                                {
                                                        if($no['qui_rep']=='A')
                                                        {
                                                                $val=0;
                                                        }
                                                        else
                                                        {
                                                                $val=1;
                                                        }
                                                }
                                                
                                                echo '<br>' ;
                                                echo '<br>';
        if($val==0)
        { 
        
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
                                                        if($reste['rep_valide']!=1)
                                                        {$r='  X';}
                                                        if($reste['rep_valide']==1)
                                                        {$r=' Réponse correcte !';}

                                                        echo '<br>';
                                                        echo '<h6>';
                                                        echo 'Réponse '.$nb.' : '.$r; 
                                                        echo '</h6>';                                    
                                                        echo $reste['rep_libelle']; 
                                                        echo '<br>';
                                                        $nb=$nb+1;  
                                                }
                                                
                                        }
                                        $traite[$no["que_texte"]]=1;
                                }
                                
                                
                                
                } 
        }



        $mb=0;
        
        echo '</h1>';
        echo'
        <form method="post" accept-charset="utf-8" action="https://obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/index.php/compte/list_matcher"><h1></h1></label><br />';
        echo '<input type="submit" name="submit" value="Retour" />';

        echo' </form>';
                                        
                                        
                                      
                
                   
                ?>
                
        </div>
</section>