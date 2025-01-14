document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#etudiantTable tr');
    rows.forEach(row => {
        const nom = row.cells[0].textContent.toLowerCase();
        const prenom = row.cells[1].textContent.toLowerCase();
        if (nom.includes(searchValue) || prenom.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});