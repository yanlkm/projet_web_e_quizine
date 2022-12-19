<?php
if (($this->session->userdata('role'))!='F')
{
        redirect('compte/b_connecter');
}?>
<DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Start Bootstrap Theme</title>
        

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
                
                    
                    
                        <a class="navbar-brand" href=<?php echo site_url('compte/list_matcher');?>>Matchs</a>
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
<h2>Espace d'administration de vos matchs</h2>
<p></p>
<p></p><p></p><p></p>
<?php

            echo '<table class="table">';
            echo '<thead class="thead-dark">';

            echo' <tr> <th scope="col">#Identifiant</th>
                    <th scope="col">Titres quiz activés</th>
                    </tr>';
            echo '</thead>';
            echo'<tbody>';
            foreach($quiz as $n)
            {
                        
                echo'<tr>';
                echo'<th scope="row">'.$n['qui_id'].'</th>';
                echo'<td>';
                echo $n["qui_intitule"];
                echo'</td>';
                
                echo'</tr>';
            }
            echo' 
            </tbody>
            </table>';
            
                
?>
<?php

        echo '<h1>';
        echo '<form method="post" accept-charset="utf-8" action="https://obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/index.php/compte/finir_match_creer">';
        echo'<label for="num_match">Creer match</label><br />';
        echo'<br>';
        if($error==2)
        {
            echo ' <h5> Champ de titre de votre match non rempli ou mal rempli !</h5>';
        }
        if($error==3)
        {
            echo ' <h5> Echec création du match !</h5>';
        }
        echo 'Identifiant  du quiz  : ';
        echo '<select name="quiz" >';
        
        
        foreach($quiz as $n) 
        {
            echo '<OPTION>'.$n['qui_id'];
        }
        
    
        echo '</select>';
        echo' <br />';
        echo'<br>';
        echo 'Titre du match : ';
        echo'<br>';
        echo'<input type="text" name="titre" placeholder="Saisir titre" /><br />';
        echo'<br>'; 
        echo '<input type="submit" name="submit" value="valider" />';
        echo' </form>';
    ?>