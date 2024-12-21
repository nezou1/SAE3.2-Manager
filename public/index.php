<?php
session_start();

require_once "C:/wamp64/www/SAE3.2-Manager/core/connexion.php";
require_once "C:/wamp64/www/SAE3.2-Manager/core/site.php";
require_once "C:/wamp64/www/SAE3.2-Manager/core/vue_generique.php";
require_once "C:/wamp64/www/SAE3.2-Manager/core/vue_composant_generique.php";

require_once "C:/wamp64/www/SAE3.2-Manager/modules/module_generique.php";

require_once "C:/wamp64/www/SAE3.2-Manager/composants/composant_generique.php";
require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/responsable/composant_menu_responsable.php";
require_once "C:/wamp64/www/SAE3.2-Manager/composants/footer/composant_footer.php";

Connexion::initConnexion();
$site = new Site();
$site->exec_module();

$menu = new ComposantMenuResponsable();
$footer = new ComposantFooter();

$module_html = $site->get_module()->get_affichage();
include_once "C:/wamp64/www/SAE3.2-Manager/templates/template.php";

?>