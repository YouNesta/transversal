
    <?php

    if (isset($_SESSION['flashBag'])) {
        foreach ($_SESSION['flashBag'] as $type => $flash) {
            foreach ($flash as $key => $message) {
                echo '<div class="'.$type.'" role="'.$type.'" >'.$message.'</div>';
                // un fois affiché le message doit être supprimé
                unset($_SESSION['flashBag'][$type][$key]);
            }
        }
    }
    ?>
    <div>
    <h1>Bienvenue sur le site</h1>
    <h1 class="logo">Evenir</h1>
    <h2>Le site adapté a tout les evenements</h2></div>