<?php

require_once "../modules/mod_depot/depotController.php";

class ModDepot extends ModuleGenerique {
    public function __construct() {
        parent::__construct();
        $this->title = "Depot";
        $this->controleur = new ControleurDepot();
    }
}
?>
