
        <!DOCTYPE html>
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
                <a class="navbar-brand" href=<?php echo site_url("accueil/afficher");?>>Home</a>
                <?php
                if($compte->pro_role == 'F') 
                {
                echo"<a class='navbar-brand' href='".site_url('compte/list_matcher')."'>Matchs</a>";
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
<section class="testimonials text-center bg-light" >

<div class="container" style="background-image: url(obiwan.univ-brest.fr/difal3/zlikemeya/v2/CodeIgniter/style/assets/img/cas.jpg);">
<div class="container">
<h2>Espace privé du site</h2>
<br />
<h2>Session ouverte ! Bienvenue
<?php
echo $this->session->userdata('username');
?> !
</h2>

<?php 

   
    
   


 
     ?>
        
        
        
        
        
    



                 </div>
        </div>
</section>