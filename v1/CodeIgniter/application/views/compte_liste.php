<h1>
    <?php
     echo $titre;
     ?>
</h1>
<br />
<?php 
    if($pseudos != NULL) 
    {
        $nb=1;
            echo '<table class="table">';
            echo '<thead class="thead-dark">';

            echo' <tr> <th scope="col">#</th>
                    <th scope="col">'.$titre.''.$nbc->nb.'</th>
                    </tr>';
            echo '</thead>';
            echo'<tbody>';
            foreach($pseudos as $login)
            {
                        
                echo'<tr>';
                echo'<th scope="row">'.$nb.'</th>';
                echo'<td>';
                echo $login["com_pseudo"];
                echo'</td>';
                $nb=$nb+1;
                echo'</tr>';
            }
            echo' 
            </tbody>
            </table>';
    }

            else {
                echo "<br />";
                echo   '
                <div class="panel-group">
                <div class="panel panel-default">
                <div class="panel-body"><h1> Aucune compte !</h1></div>
                </div>
                </div>     
                ';

            }
?>