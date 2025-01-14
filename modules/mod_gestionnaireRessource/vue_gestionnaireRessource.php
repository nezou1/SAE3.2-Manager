<?php

class VueGestionnaireRessource extends VueGenerique {

    public function __construct() {
        parent::__construct();  
    }

    public function get_gestionnaireRessource() {
        
        
    }

    public function afficherRessources($ressources) {
        echo '<div class="search-bar">';
        echo '<input type="text" id="search" placeholder="Search for files...">';
        echo '</div>';
        echo '<div class="ressources">';
        foreach ($ressources as $ressource) {
            echo '<div class="ressource">';
            echo '<img src="icon.png" alt="File Icon">';
            echo '<p>' . htmlspecialchars($ressource) . '</p>';
            echo '</div>';
        }
        echo '</div>';
    }


    
}
