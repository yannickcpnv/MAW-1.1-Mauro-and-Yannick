<?php

ob_start();
?>

    <header class="dashboard error">
        <section class="container">
            <p><i class="fas fa-question fa-lg"></i></p>
            <h1>404<br>Not Found</h1>
        </section>
    </header>

<?php
$content = ob_get_clean();
require 'views/includes/layout.php';
