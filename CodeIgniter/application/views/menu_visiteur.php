<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                         
                        
                        echo '<h2 class="mb-5">'.$titre.'</h2>';
                        if(empty($news))
                         {
                                
                                 echo   '
                                        <div class="panel-group">
                                        <div class="panel panel-default">
                                        <div class="panel-body"><h1> Aucune actualité pour le moment</h1></div>
                                        </div>
                                        </div>     
                                        ';
                         }
                         else 
                        {

                                echo '<table class="table table-hover">';
                                echo '<thead class="thead-dark">';
        
                               echo' <tr> <th scope="col">Auteur</th>
                                          <th scope="col">Titre</th>
                                          <th scope="col">Contenu</th>
                                          <th scope="col">Date</th>
                                        </tr>';
                                echo '</thead>';
                                echo'<tbody>';
                                
                                
                                        
                                                foreach($news as $n)
                                                { 
                                                        
                                                echo'<tr>';
                                                echo'<th scope="row">'.$n["com_pseudo"].'</th>';
                                                echo "<td><a href=".base_url()."index.php/actualite/afficher/".$n['act_id'].">";
                                                    echo $n["act_intitule"];
                                                echo'</a></td>';
                                                echo'<td>';
                                                    echo $n["act_texte"];
                                                echo'</td>';
                                                echo'<td>';
                                                    echo $n["act_date"];
                                                echo'</td>';
                                                
                                                echo'</tr>';
                                        
                                                }
                                        
                                        
                               
                               echo' 
                                    </tbody>
                                    </table>';
                        }
                        
                
                   
                ?>
                <div class="container">
                </br>
                        <h1>
                       
                <?php 
                        if($error==1)
                        {
                                echo ' <h1> code inexistant ! veuillez fournir un code fourni par votre formateur ! ';
                        }
                        if($error==2)
                        {
                                echo ' <h1> Match désactivé ou terminé! ';;
                        }
                        if($error==3)
                        {
                                echo ' <h1> Quiz désactivé ! ';;
                        }

                        if($error==4)
                        {
                                echo ' <h1> Match non démarré ! ';
                        }
                        if($error==5)
                        {
                                echo ' <h1>Code match non saisi ou saisi avec des caractères invalides';
                        }
                        

                         if(empty($nb_match)) 
                         
                                       
                                        {
                                        echo '<h1> AUCUN MATCH POUR LE MOMENT </h1>';
                                                        
                                        }
                                        else {
                                        echo form_open('accueil/verifier'); 
                                        echo'
                                        <label for="num_match">Code</label><br />
                                        <input type="input" name="num_match" /><br />
                                        
                                        <input type="submit" name="submit" value="Rejoindre" />';
                                         echo' </form>';
                                        }

                      
                        ?>
                        
                 
                        </h1>
                </div>
        </div>
</section>