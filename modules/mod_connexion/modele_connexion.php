<?php

class ModeleConnexion {
    private $pdo;

    

    public function getUserByEmail($email) {
        $query = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
