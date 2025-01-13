
const dropdown = document.getElementById('multiSelectDropdown');
const options = document.getElementById('dropdownOptions');
const placeholder = document.getElementById('placeholder_intervenants');

// Fonction pour envoyer les données au fichier PHP
function sendIntervenantsData(intervenants) {
    const formData = new FormData();

    intervenants.forEach((intervenant) => {
        formData.append('intervenants[]', intervenant); // On envoie les intervenants sous forme de tableau
    });

    fetch('http://localhost//SAE3.2-Manager/modules/mod_sae/controleur_sae.php', {
        method: 'POST',
        body: formData
    });
}

// Gestion des choix sélectionnés
options.addEventListener('change', (e) => {
    const checkboxes = options.querySelectorAll('input[type="checkbox"]');
    const selectedValues = [];

    // Vider le contenu actuel
    dropdown.innerHTML = '';

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
        selectedValues.push(checkbox.value);

        // Créer un badge pour chaque sélection
        const badge = document.createElement('span');
        badge.className = 'badge custom-badge me-2';
        badge.textContent = checkbox.value;

        // Ajouter un bouton pour retirer la sélection
        const removeButton = document.createElement('button');
        removeButton.className = 'btn-close btn-close-white ms-1';
        removeButton.style.fontSize = '0.8em';
        removeButton.addEventListener('click', () => {
            checkbox.checked = false;
            badge.remove();
            updatePlaceholder();
        });

        badge.appendChild(removeButton);
        dropdown.appendChild(badge);
        }
    });

    updatePlaceholder();
});

// Mise à jour du texte par défaut
function updatePlaceholder() {
    if (dropdown.innerHTML.trim() === '') {
        placeholder.style.display = 'inline';
        placeholder.textContent = 'Sélectionner';
    } else {
        placeholder.style.display = 'none';
    }
}