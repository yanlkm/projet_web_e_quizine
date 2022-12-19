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
if($error==1)
{
    echo ' <h1> quiz choisi vide ! veuiller en choisir un autre !</h1>';
}
echo '<h1>';
echo 'Creer votre match : ';
echo "<a href=".base_url()."index.php/compte/match_creer>";
echo "<button type='button' class='btn btn-lg btn-primary' disabled>";
echo '<i class="bi bi-plus-circle-dotted"></i>';
echo "</button>";
echo'</a>';
echo'</h1>';
            if(empty($list))
            {
                
                    echo   '
                        <div class="panel-group">
                        <div class="panel panel-default">
                        <div class="panel-body"><h1> Aucun match disponible !</h1></div>
                        </div>
                        </div>     
                        ';
            }
            if(!empty($list))
            {
                

            echo '<table class="table table-hover">';
            echo '<thead class="thead-dark">';

            echo' <tr>   <th scope="col">Image</th> 
                        <th scope="col">#</th>
                        <th scope="col">Titre Quiz</th>
                        <th scope="col">Etat du quiz</th>
                        <th scope="col">Auteur du quiz</th>
                        <th scope="col">Code</th>
                        <th scope="col">Titre match</th>
                        <th scope="col">Date et heure début</th>
                        <th scope="col">Date et heure fin</th>
                        <th scope="col">Activation</th>
                        <th scope="col">Auteur match</th>
                        <th scope="col">Gerer</th>

                    </tr>';
            echo '</thead>';
            echo'<tbody>';
            
            
                    
                            foreach($list as $n)
                            { 

                                echo'<tr>';
                                echo'<td>';
                                echo "<img src='".base_url()."/style/assets/img/".$n['qui_image']."'  class='img-thumbnail'>";
                                echo'</td>';

                                echo'<td>';
                                echo $n['qui_id'];
                                echo'</td>';
                                
                                if($n["nb_q"]>0)
                                {
                                    $val1='Complet';
                                } 
                                 if($n["nb_q"]==0){
                                    $val1='Quiz incomplet';}
                                    
                                    echo "<td>";
                                    echo $n["qui_intitule"];
                                    echo'</td>';
                                    echo'<td>';
                                        echo $val1;
                                    echo'</td>';
                                    
                                    
                                    echo'<td>';
                                        echo $n['Auteur_quiz'];
                                    echo'</td>';
                                
                                    
                            
                                    if($n["mat_activation"]=='A')
                                    {
                                        $val='Activé';}
                                        
                                    if($n["mat_activation"]=='D'){
                                        $val='Désactivé';}
                                        if($n["mat_activation"]==NULL){
                                            $val='';}

                                    echo "<td><a href=".base_url()."index.php/compte/matcher/".$n['mat_id'].">";
                                    echo $n["mat_id"];
                                    echo'</a></td>';
                                    
                                    if($n["mat_datefin"]==NULL)
                                    {
                                        $dat='En cours';
                                    }
                                    if($n["mat_datefin"]!=NULL)
                                    {
                                        $dat=$n["mat_datefin"];
                                    }

                                    echo'<td>';
                                    echo $n["mat_intitule"];
                                echo'</td>';
                                
                                echo'<td>';
                                    echo $n["mat_datedebut"];
                                echo'</td>';
                                echo'<td>';
                                    echo $dat;
                                echo'</td>';
                                echo'<td>';
                                    echo $val;
                                echo'</td>';
                                echo'<td>';
                                    echo $n['Auteur_match'];
                                echo'</td>';
                                echo "<td>";
                                if($compte->com_pseudo == $n['Auteur_match'])
                                
                                {
                                    if($n['mat_activation']=='A')
                                {     
                                    
                                        echo "<a class='btn btn-ptimary btn-delete' href=".base_url()."index.php/compte/match_desactiver/".$n['mat_id'].">";
                                        echo '<i class="bi bi-check-circle-fill"></i>';
                                        echo'</a>';}
                                if($n['mat_activation']=='D')
                                {
                                    
                                    echo "<a class='btn btn-ptimary btn-delete' href=".base_url()."index.php/compte/match_activer/".$n['mat_id'].">";
                                    echo '<i class="bi bi-check-circle"></i>';
                                    echo'</a>';}

                                        $date = date('Y-m-d H:i:s');
  
                                            echo "<a class='btn btn-ptimary btn-delete' href=".base_url()."index.php/compte/match_razer/".$n['mat_id'].">";
                                            echo '<i class="bi bi-arrow-counterclockwise"></i>';
                                            echo'</a>';
                                            
                                            

                                        
                                    
                                            echo "<a class='btn btn-ptimary btn-delete' href=".base_url()."index.php/compte/match_super/".$n['mat_id'].">";
                                            echo '<i class="bi bi-trash2-fill"></i>';
                                            echo'</a>';
                                }
                            
                                    else 
                                    {
                                        echo '<i class="bi bi-exclamation-triangle"></i>';
                                    }
                                    



                                
                                
                                        
                                        echo'</td>';
                            
                            echo'</tr>';
                    
                            }
                    
                    
            
            echo' 
                </tbody>
                </table>';
    
            }
                   
                ?>