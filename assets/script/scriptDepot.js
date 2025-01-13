const dropArea = document.getElementById('drop-area');
const fileTable = document.getElementById('file-table');
const fileTableBody = document.getElementById('file-table-body');
const uploadForm = document.getElementById('upload-form');
const fileInput = document.getElementById('file-input');
const fileInputButton = document.getElementById('file-input-button');
let ressources = [];

// Glisser-déposer pour la zone de dépôt
dropArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropArea.classList.add('hover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('hover');
});

dropArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dropArea.classList.remove('hover');
    const files = event.dataTransfer.files;
    handleFiles(files);
});

// Glisser-Déposer pour le tableau
fileTableBody.addEventListener('dragover', (event) => {
    event.preventDefault();
    fileTableBody.classList.add('hover');
});

fileTableBody.addEventListener('dragleave', () => {
    fileTableBody.classList.remove('hover');
});

fileTableBody.addEventListener('drop', (event) => {
    event.preventDefault();
    fileTableBody.classList.remove('hover');
    const files = event.dataTransfer.files;
    handleFiles(files);
});

// Bouton Déposer une Ressource
fileInputButton.addEventListener('click', () => {
    fileInput.click(); // Ouvrir le sélecteur de fichiers
});

// Gérer les fichiers sélectionnés
fileInput.addEventListener('change', (event) => {
    const files = event.target.files;
    handleFiles(files);
});

// Gérer les fichiers déposés
function handleFiles(files) {
    for (let i = 0; i < files.length; i++) {
        ressources.push(files[i]);
        addFileToTable(files[i]);
    }
    dropArea.style.display = 'none';
    fileTable.style.display = 'table';
}

// Ajouter les fichiers au tableau
function addFileToTable(file) {
    const row = document.createElement('tr');
    const nameCell = document.createElement('td');
    const typeCell = document.createElement('td');
    const highlightCell = document.createElement('td');
    const actionCell = document.createElement('td');

    nameCell.textContent = file.name;
    typeCell.textContent = file.type;

    // Créer la case à cocher pour mettre en avant
    const highlightCheckbox = document.createElement('input');
    highlightCheckbox.type = 'checkbox';
    highlightCheckbox.className = 'highlight-checkbox';
    highlightCheckbox.dataset.fileName = file.name; // Stocker le nom du fichier pour référence

    highlightCell.appendChild(highlightCheckbox);

    // Créer le bouton de suppression
    const deleteButton = document.createElement('button');
    deleteButton.textContent = '✖';
    deleteButton.className = 'delete-button btn btn-link';
    deleteButton.onclick = () => {
        removeFileFromTable(row, file);
    };

    actionCell.appendChild(deleteButton);
    row.appendChild(nameCell);
    row.appendChild(typeCell);
    row.appendChild(highlightCell);
    row.appendChild(actionCell);
    fileTableBody.appendChild(row);
}

// Supprimer un fichier du tableau
function removeFileFromTable(row, file) {
    const index = ressources.indexOf(file);
    if (index > -1) {
        ressources.splice(index, 1);
    }
    fileTableBody.removeChild(row);
    if (fileTableBody.children.length === 0) {
        fileTable.style.display = 'none';
        dropArea.style.display = 'block';
    }
}

// Gérer la soumission du formulaire
uploadForm.addEventListener('submit', async (event) => {
    event.preventDefault(); // Empêche le rechargement de la page
    const formData = new FormData(uploadForm);

    
    for (let i = 0; i < ressources.length; i++) {
        formData.append('ressources[]', ressources[i]);
    }

    // Ajouter les cases à cocher au FormData
    const highlightCheckboxes = document.querySelectorAll('.highlight-checkbox');
    highlightCheckboxes.forEach((checkbox) => {
        const fileName = checkbox.dataset.fileName;
        const isChecked = checkbox.checked;
        formData.append(`highlight[${fileName}]`, isChecked); // Ajouter le nom du fichier et son état
    });

    // Envoyer les données au serveur
    const response = await fetch('http://localhost//SAE3.2-Manager/modules/mod_sae/controleur_sae.php', {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        console.log('Données envoyées avec succès');
        // Réinitialiser le formulaire et le tableau
        uploadForm.reset();
        fileTableBody.innerHTML = '';
        fileTable.style.display = 'none';
        dropArea.style.display = 'block';
        ressources = []; // Réinitialiser le tableau de fichiers
    } else {
        console.error('Erreur lors de l\'envoi des données');
    }
});