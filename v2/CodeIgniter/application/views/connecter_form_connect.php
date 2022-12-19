<h2>Espace d'administration</h2>
<br />
<h2>Session ouverte ! Bienvenue
<?php
echo $this->session->userdata('username');
if($compte[0]['pro_role']=='F')
{
    echo '<button type="button" class="btn btn-primary">Déconnecter Admin</button>';
    echo 'bite';
}


?> 
</h2>
