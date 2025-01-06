<?php
session_start();

require_once "../config/config.php";

require_once PROJECT_ROOT . "/core/connexion.php";
require_once PROJECT_ROOT . "/core/site.php";
require_once PROJECT_ROOT . "/core/vue_generique.php";
require_once PROJECT_ROOT . "/core/vue_composant_generique.php";

require_once PROJECT_ROOT . "/modules/module_generique.php";

require_once PROJECT_ROOT . "/composants/composant_generique.php";
require_once PROJECT_ROOT . "/composants/menu/enseignants/composant_menu_enseignant.php";
require_once PROJECT_ROOT . "/composants/footer/composant_footer.php";

Connexion::initConnexion();
$site = new Site();
$site->exec_module();

$menu = new ComposantMenuEnseignant();
$footer = new ComposantFooter();

$module_html = $site->get_module()->get_affichage();
$module_title = $site->get_module()->get_title();
include_once PROJECT_ROOT . "/templates/template.php";

?>