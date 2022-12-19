<?php
                        if(empty($list))
                         {
                                
                                        echo   '
                                        <div class="panel-group">
                                        <div class="panel panel-default">
                                        <div class="panel-body"><h1> Aucun match ni quiz disponible !</h1></div>
                                        </div>
                                        </div>     
                                        ';
                         }

                         if(!empty($list))
                        {       
                                echo '<table class="table">';
                                echo '<thead class="thead-dark">';
                    
                                echo' <tr> <th scope="col">Gerer votre match</th>
                                        <th scope="col">Données</th>
                                        </tr>';
                                echo '</thead>';
                                echo'<tbody>';
                                
                                            
                                    echo'<tr>';
                                    echo'<th scope="row">Nom</th>';
                                    echo'<td>';
                                    echo $list->mat_id;
                                    echo'</td>';
                                    echo'</tr>';
                                    echo'<tr>';
                                    echo'<th scope="row">Prénom</th>';
                                    echo'<td>';
                                    echo $list->mat_id;
                                    echo'</td>';
                                    echo'</tr>';
                                    echo'<tr>';
                                    echo'<th scope="row">Date de création</th>';
                                    echo'<td>';
                                    echo $list->mat_id;
                                    echo'</td>';
                                    echo'</tr>';
                                    echo'<tr>';
                                    echo'<th scope="row">Rôle</th>';
                                    echo'<td>';
                                    echo $list->mat_id;
                                    echo'</td>';
                                   
                                    echo'</tr>';
                                    echo'<tr>';
                                    echo'<th scope="row">#Identifiant</th>';
                                    echo'<td>';
                                    echo $list->mat_id;
                                    echo'</td>';
                                    echo'</tr>';
                                    
                                
                                echo' 
                                </tbody>
                                </table>';
                                        
                                        
                               
                        }