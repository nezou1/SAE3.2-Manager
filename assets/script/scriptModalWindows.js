function addRessource() {
    const name = document.getElementById('ressourceName').value;
    const link = document.getElementById('ressourceLink').value;
    if (name && link) {
        const list = document.getElementById('ressourceList');
        const listItem = document.createElement('li');
        listItem.innerHTML = `<i class='bi bi-file-earmark'></i> <a href='${link}' target='_blank'>${name}</a>`;
        list.appendChild(listItem);
        document.getElementById('ressourceName').value = '';
        document.getElementById('ressourceLink').value = '';
        const modal = bootstrap.Modal.getInstance(document.getElementById('addRessourceModal'));
        modal.hide();
    }
}




function addGroupe() {
    // Récupérer les éléments du formulaire
    const nomInput = document.getElementById('nom_grp');
    const etudiantsInputs = document.querySelectorAll('input[name="etudiants[]"]');
    const nomError = document.getElementById('nom_grp_error');
    const etudiantsError = document.getElementById('etudiants_error');
    const globalError = document.getElementById('global_error');

    // Réinitialiser les messages d'erreur
    nomError.classList.add('d-none');
    etudiantsError.classList.add('d-none');
    globalError.classList.add('d-none');

    // Préparer les données du formulaire
    const formData = new FormData();
    formData.append('nom_grp', nomInput.value);
    formData.append('modifiable_par_etudiant', document.getElementById('modifiable_par_etudiant').checked ? '1' : '0');
    [...etudiantsInputs].forEach(input => {
        if (input.checked) {
            formData.append('etudiants[]', input.value);
        }
    });

    // Validation côté client
    let hasError = false;

    // Vérification du champ "nom du groupe"
    if (!nomInput.value.trim()) {
        nomError.textContent = "Le nom du groupe est obligatoire.";
        nomError.classList.remove('d-none');
        hasError = true;
    }

    // Vérification des étudiants sélectionnés (au moins 2)
    const selectedStudentsCount = [...etudiantsInputs].filter(input => input.checked).length;
    if (selectedStudentsCount < 2) {
        etudiantsError.textContent = "Au moins deux étudiants doivent être sélectionnés.";
        etudiantsError.classList.remove('d-none');
        hasError = true;
    }

    // Si une erreur est détectée, arrêter l'exécution
    if (hasError) {
        return;
    }

    // Envoi des données via Fetch
    fetch('../../modules/mod_sae/modele_sae.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message || "Groupe ajouté avec succès !");
            bootstrap.Modal.getInstance(document.getElementById('addGroupModal')).hide();
            
            // Réinitialisation du formulaire et des erreurs
            document.getElementById('addGroupForm').reset();
            nomError.classList.add('d-none');
            etudiantsError.classList.add('d-none');
            globalError.classList.add('d-none');
        } else {
            if (data.errors) {
                if (data.errors.nom_grp) {
                    nomError.textContent = data.errors.nom_grp;
                    nomError.classList.remove('d-none');
                }
                if (data.errors.etudiants) {
                    etudiantsError.textContent = data.errors.etudiants;
                    etudiantsError.classList.remove('d-none');
                }
            } else if (data.message) {
                globalError.textContent = data.message || "Une erreur inattendue est survenue.";
                globalError.classList.remove('d-none');
            }
        }
    })
    .catch(error => {
        console.error("Erreur:", error);
        globalError.textContent = "Une erreur est survenue lors de l'ajout du groupe.";
        globalError.classList.remove('d-none');
    });
}




function closeModalGroupe() {
    document.getElementById('nom_grp').value = '';
    document.getElementById('modifiable_par_etudiant').checked = false;
    document.querySelectorAll('input[name="etudiants[]"]').forEach(checkbox => (checkbox.checked = false));
}










function addDepot() {
    const name = document.getElementById('depotName').value;
    const date = document.getElementById('depotDate').value;
    if (name && date) {
        const list = document.getElementById('depotList');
        const listItem = document.createElement('li');
        listItem.innerHTML = `<i class='bi bi-box-arrow-in-down'></i> ${name} - Date limite: ${date}`;
        list.appendChild(listItem);
        document.getElementById('depotName').value = '';
        document.getElementById('depotDate').value = '';
        const modal = bootstrap.Modal.getInstance(document.getElementById('addDepotModal'));
        modal.hide();
    }
}

function addSoutenance() {
    // Récupération de toutes les valeurs des champs
    const nom_grp = document.getElementById('soutenance_nom_grp').value;
    const titre_sae = document.getElementById('soutenance_titre_sae').value;
    const description = document.getElementById('soutenance_description').value;
    const date_soutenance = document.getElementById('soutenance_dateSout').value;
    const lieu = document.getElementById('soutenance_lieu').value;
    const heure_debut = document.getElementById('soutenance_heure_debut').value;
    const heure_fin = document.getElementById('soutenance_heure_fin').value;

    // Récupérer les jurys sélectionnés
    const jurys = []; // Liste des jurys
    document.querySelectorAll('.jury-checkbox:checked').forEach(checkbox => {
        jurys.push(checkbox.value); // Ajouter l'email du jury sélectionné à la liste
    });

    if (nom_grp && titre_sae && description && date_soutenance && lieu && heure_debut && heure_fin && jurys.length > 0) {
        // Créer un objet FormData pour envoyer les données en POST
        const formData = new FormData();
        formData.append('soutenance_nom_grp', nom_grp);
        formData.append('soutenance_titre_sae', titre_sae);
        formData.append('soutenance_description', description);
        formData.append('soutenance_dateSout', date_soutenance);
        formData.append('soutenance_lieu', lieu);
        formData.append('soutenance_heure_debut', heure_debut);
        formData.append('soutenance_heure_fin', heure_fin);
        formData.append('soutenance_jurys', JSON.stringify(jurys));  // Convertir les jurys en JSON

        // Envoi des données via POST avec fetch
        fetch('../../modules/mod_sae/modele_sae.php', {
            method: 'POST',
            body: formData, // Utilisation de FormData pour envoyer les données
        })
        .then(response => response.json()) // Attente de la réponse en JSON
        .then(data => {
            // Gérer la réponse (ex: afficher un message de succès)
            if (data.success) {
                const list = document.getElementById('soutenanceList');
                const listItem = document.createElement('li');
                listItem.innerHTML = `<i class='bi bi-box-arrow-in-down'></i> ${nom_grp} - Date : ${date_soutenance}`;
                list.appendChild(listItem);
                
                // Réinitialiser les champs du formulaire
                document.getElementById('soutenance_nom_grp').value = '';
                document.getElementById('soutenance_titre_sae').value = '';
                document.getElementById('soutenance_description').value = '';
                document.getElementById('soutenance_dateSout').value = '';
                document.getElementById('soutenance_lieu').value = '';
                document.getElementById('soutenance_heure_debut').value = '';
                document.getElementById('soutenance_heure_fin').value = '';
                
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addSoutenanceModal'));
                modal.hide();
            } else {
                // Gérer l'échec
                alert('Une erreur est survenue lors de l\'enregistrement des données.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi:', error);
            alert('Une erreur est survenue.');
        });
    } else {
        // Message si les données sont manquantes
        alert('Veuillez remplir tous les champs et sélectionner au moins un jury.');
    }
}