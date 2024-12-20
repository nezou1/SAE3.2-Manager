<?php
session_start();

require_once "core/connexion.php";
require_once "core/site.php";
require_once "core/vue_generique.php";
require_once "core/vue_composant_generique.php";

require_once "modules/module_generique.php";

require_once "composants/composant_generique.php";
require_once "composants/footer/composant_footer.php";

Connexion::initConnexion();
$site = new Site();
$site->exec_module();

$menu = $site->get_menu();
$footer = new ComposantFooter();

$module_html = $site->get_module()->get_affichage();
include_once "template.php";

?>