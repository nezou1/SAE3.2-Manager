function addRessource(event) {

    event.preventDefault();
    resetErrors();
    let isValid = true;
  
    // Vérification du nom de la ressource
    const ressourceName = document.getElementById('ressourceName');    
    if (ressourceName.value.trim() === '') {
        showError('ressourceNameError', 'Veuillez entrer un nom pour la ressource');
        isValid = false;
    }
  
    // Vérification du fichier
    const ressourceFile = document.getElementById('ressourceFile');
    if (ressourceFile.files.length === 0) {
      isValid = false;
      showError('ressourceFileError', 'Veuillez sélectionner un fichier.');
      isValid = false;
    }
  
    if (isValid) {
        document.getElementById('ressourceForm').submit();
    }
}

function addDepot(event) {
    event.preventDefault();
    resetErrors();

    let isValid = true;

    // Validation de la description
    const description_depot = document.getElementById('description_depot').value;
    if (description_depot.trim() === '') {
        showError('description_depot_error', 'La description du dépôt est requise.');
        isValid = false;
    }

    // Validation de la date
    const date_depot = document.getElementById('date_depot').value;
    if (date_depot.trim() === '') {
        showError('date_depot_error', 'La date du dépôt est requise.');
        isValid = false;
    }

    if (isValid) {
        document.getElementById('depotForm').submit();
    }
}


    // Fonction pour gérer les erreurs du formulaire
function addGroupe(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    resetErrors();

    let isValid = true;

    const nomGrp = document.getElementById('nom_grp').value;
    if (nomGrp.trim() === '') {
        showError('nom_grp_error', 'Le nom du groupe est requis.');
        isValid = false;
    }

    const selectedEtudiants = document.querySelectorAll('input[name="etudiants[]"]:checked');
    if (selectedEtudiants.length < 2) {
        showError('etudiants_error', 'Veuillez ajouter au moins deux étudiants au groupe.');
        isValid = false;
    }

    if (isValid) {
        document.getElementById('addGroupForm').submit();
    }
}


// Fonction pour afficher les messages d'erreur
function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.classList.remove('d-none');
}

// Fonction pour réinitialiser les messages d'erreur
function resetErrors() {
    const errorElements = document.querySelectorAll('.text-danger');
    errorElements.forEach(element => {
        element.textContent = '';
        element.classList.add('d-none');
    });
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