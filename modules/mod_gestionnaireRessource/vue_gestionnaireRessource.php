<?php

class VueGestionnaireRessource extends VueGenerique {

    public function __construct() {
        parent::__construct();  
    }

    public function get_gestionnaireRessource() {
        
        
    }

    public function afficherRessources($ressources) {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('search').addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const ressources = document.querySelectorAll('.ressource');
                    ressources.forEach(ressource => {
                        const fileName = ressource.querySelector('p').textContent.toLowerCase();
                        if (fileName.includes(searchValue)) {
                            ressource.style.display = '';
                        } else {
                            ressource.style.display = 'none';
                        }
                    });
                });
            });
        </script>
        <div class="container mt-5">
            <div class="search-bar mb-4">
                <input class="form-control" type="text" id="search" placeholder="Search for files...">
            </div>
            <div class="ressources">
                <?php foreach ($ressources as $ressource): ?>
                    <div class="ressource">
                        <img src="icon.png" alt="File Icon">
                        <p><?php echo htmlspecialchars($ressource['nom']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="file-upload mt-4">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileToUpload">Ajouter un fichier:</label>
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Télécharger</button>
                </form>
            </div>
        </div>
        <?php
    }


    
}
