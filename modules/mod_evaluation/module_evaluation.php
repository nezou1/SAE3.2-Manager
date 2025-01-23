<?php

require_once "evaluationController.php";

class ModEvaluation extends ModuleGenerique {

    public function __construct () {
        parent::__construct();
        $this->title = "Evaluation";
        $this->controleur = new EvaluationController();
    }
}
?>