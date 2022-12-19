
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
                <a class="navbar-brand" href=<?php echo site_url("compte/backer");?>>Home Backup</a>
                
                    
               <?php if($compte->pro_role=='F')
    {
                        echo '<a class="navbar-brand" href='.site_url('compte/list_matcher').'>Matchs</a>';
                    }
                    
                   
                     if($compte->pro_role=='A')
                        {
                            echo "<a class='navbar-brand' href='".site_url('compte/com_gerer')."'>Gerer Comptes</a>";    
                        }
                        ?>
                        <a class="navbar-brand" href=<?php echo site_url('compte/informer');?>>Profil</a>
                      

                        <?php 
    if($compte->pro_role=='A')
    {
        //echo form_open('compte/deconnecter/'); 
        echo '<form method="post" accept-charset="utf-8" action="https://obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/index.php/compte/deconnecter">';
        echo '<input type="submit" name="submit" value="Déconnexion Admin" />';
        echo '</form>';
        
        
        
    }
    if($compte->pro_role == 'F') 
    {

            echo '<form method="post" accept-charset="utf-8" action="https://obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/index.php/compte/deconnecter">';
            echo '<input type="submit" name="submit" value="Déconnexion Formateur" />';
            echo '</form>';
        
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
                            <!-- Signup form-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- * * SB Forms Contact Form * *-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- This form is pre-integrated with SB Forms.-->
                            <!-- To make this form functional, sign up at-->
                            <!-- https://startbootstrap.com/solution/contact-forms-->
                            <!-- to get an API token!-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
<section class="testimonials text-center bg-light">
<div class="container">
<div class="container">
<h2>Informations de votre compte</h2>
<br />

<?php
echo '<h5> Votre pseudo : </h5> ';
echo '<h1>';
echo $this->session->userdata('username');
echo '</h1>';


echo '<table class="table">';
            echo '<thead class="thead-dark">';

            echo' <tr> <th scope="col">'.$title.'</th>
                    <th scope="col">Données</th>
                    </tr>';
            echo '</thead>';
            echo'<tbody>';
            
                        
                echo'<tr>';
                echo'<th scope="row">Nom</th>';
                echo'<td>';
                echo $fic->pro_nom;
                echo'</td>';
                echo'</tr>';
                echo'<tr>';
                echo'<th scope="row">Prénom</th>';
                echo'<td>';
                echo $fic->pro_prenom;
                echo'</td>';
                echo'</tr>';
                echo'<tr>';
                echo'<th scope="row">Date de création</th>';
                echo'<td>';
                echo $fic->pro_datecreation;
                echo'</td>';
                echo'</tr>';
                echo'<tr>';
                echo'<th scope="row">Rôle</th>';
                echo'<td>';
                echo $fic->pro_role;
                echo'</td>';
               
                echo'</tr>';
                echo'<tr>';
                echo'<th scope="row">#Identifiant</th>';
                echo'<td>';
                echo $fic->com_id;
                echo'</td>';
                echo'</tr>';
                
            
            echo' 
            </tbody>
            </table>';

            echo'<a href='.site_url("compte/modifier").'><button class="btn btn-outline-dark">Modifier votre compte</button></a>';
?>