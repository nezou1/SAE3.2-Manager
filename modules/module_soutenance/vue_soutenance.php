<?php

class VueSoutenance extends VueGenerique{

    public function __construct () {
		parent::__construct();
	}

    public function get_soutenances($soutenances) {
    ?>
        <section>
            <h1>Soutenances</h1>
            <table>
                <thead>
                    <tr>
                        <th>Groupe</th>
                        <th>Description<th>
                        <th>SAE<th>
                        <th>Date</th>
                        <th>De</th>
                        <th>À</th>
                        <th>Lieu</th>
                        <th>Jurys</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soutenances as $soutenance): ?>
                        <tr>
                            <td><?= htmlspecialchars($soutenance['nom_groupe']) ?></td>
                            <td><?= htmlspecialchars($soutenance['description']) ?></td>
                            <td><?= htmlspecialchars($soutenance['sae']) ?></td>
                            <td><?= htmlspecialchars($soutenance['dateSout']) ?></td>
                            <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                            <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                            <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                            <td>
                                <div class="jury-container">
                                    <button class="toggle-jurys">
                                        <?=htmlspecialchars($soutenance['jurys'][0])?>
                                    </button>
                                    <ul class="jury-list hidden">
                                        <?php foreach ($soutenance['jurys'] as $jury): ?>
                                            <li><?= htmlspecialchars($jury) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
<?php
    }        
        
}
?>