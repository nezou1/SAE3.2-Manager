console.log("Script chargé !");

function createCalendar(year, month) {
    const calendarBody = document.getElementById('calendar-body');
    const calendarTitle = document.getElementById('calendar-title');
    console.log("Création du calendrier pour :", month, year); // Log pour vérifier la fonction

    if (!calendarBody || !calendarTitle) {
        console.error("Élément du calendrier introuvable !");
        return;
    }

    calendarBody.innerHTML = '';
    const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    const currentDate = new Date();
    const firstDay = new Date(year, month, 1).getDay();
    const lastDay = new Date(year, month + 1, 0).getDate();

    calendarTitle.textContent = `${monthNames[month]} ${year}`;

    const weekDays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    weekDays.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.style.fontWeight = 'bold';
        dayElement.style.textAlign = 'center';
        calendarBody.appendChild(dayElement);
    });

    for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement('div');
        calendarBody.appendChild(emptyDiv);
    }

    for (let day = 1; day <= lastDay; day++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.classList.add('day');

        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
            dayElement.classList.add('current-day');
        }

        calendarBody.appendChild(dayElement);
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    createCalendar(today.getFullYear(), today.getMonth());
});
