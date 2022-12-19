<section class="testimonials text-center bg-light">

        <div class="container">


                <?php  
                         
                        $nb=1;
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

                                echo '<table class="table">';
                                echo '<thead class="thead-dark">';
        
                               echo' <tr> <th scope="col">#</th>
                                          <th scope="col">Titre</th>
                                          <th scope="col">Contenu</th>
                                          <th scope="col">Date</th>
                                        </tr>';
                                echo '</thead>';
                                echo'<tbody>';
                                
                                
                                        
                                                foreach($news as $n)
                                                { 
                                                        
                                                echo'<tr>';
                                                echo'<th scope="row">'.$nb.'</th>';
                                                echo'<td>';
                                                echo $n["act_intitule"];
                                                echo'</td>';
                                                echo'<td>';
                                                echo $n["act_texte"];
                                                echo'</td>';
                                                echo'<td>';
                                                echo $n["act_date"];
                                                echo'</td>';
                                                $nb=$nb+1;
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
                 <a class="btn btn-primary" href='<?php echo site_url("nouveau/connexion") ?>' role="button"> Connexion </a>
                        </h1>
                </div>
        </div>
</section>

                