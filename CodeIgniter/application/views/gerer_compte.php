<?php
if (($this->session->userdata('role'))!='A')
{
        redirect('compte/b_connecter');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>QUIZ-IN</title>
        

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/style/assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo base_url(); ?>/style/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <!-- ################################################################################################ -->
            <ul class="container">
                <a class="navbar-brand" href=<?php echo site_url("accueil/afficher");?>>Home</a>
                <?php
                if($compte->pro_role == 'F') 
                {
                echo"<a class='navbar-brand' href='".site_url('compte/list_matcher')."'> Matchs</a>";
                }
                ?>
                    

                        <?php 
                        if($compte->pro_role=='A')
                        {
                            echo "<a class='navbar-brand' href='".site_url('compte/com_gerer')."'>Gerer Comptes</a>";    
                        }
                        ?>
                        <a class="navbar-brand" href=<?php echo site_url('compte/informer');?>>Profil</a>
                      

                     <?php 
    if($compte->pro_role=='A')
    {
        echo form_open('compte/deconnecter/'); 
        
        echo '<input type="submit" name="submit" value="Déconnexion Admin" />';
        
        
        
    }
    if($compte->pro_role == 'F') 
    {

        echo form_open('compte/deconnecter'); 
        
        echo '<input type="submit" name="submit" value="Déconnexion Formateur" />';
        
    }
    ?>
             


            </ul>
        </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h2 class="mb-5">
                            <style>
                            .h2 {
                              text-align: right !important;
                                           }
                             </style> 
                             ESPACE PRIVÉ DU SITE</h2>
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
<section class="testimonials text-center bg-light">

<div class="container">
<div class="container">
<h2>Espace d'administration de tous les comptes !</h2>
<br />
<h2>
<?php
echo $this->session->userdata('username');
?> !
</h2>
<?php 

    if($compte->pro_role=='A')
    {
        if($pseudos != NULL) 
        
      {
          $nb=1;
            echo '<table class="table">';
            echo '<thead class="thead-dark">';

            echo' <tr> <th scope="col">#</th>
                    <th scope="col">'.$nbc.'</th>
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
                <div class="panel-body"><h1> Aucun autre compte!</h1></div>
                </div>
                </div>     
                ';

            }
        }
    
   


 
     ?>
                      </div>
        </div>
</section>