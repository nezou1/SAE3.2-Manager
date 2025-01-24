<!DOCTYPE html>
<html lang="fr">
<head>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        #calendar {
            height: 600px;
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .fc-daygrid-day-number {
            font-size: 1rem;
            color: #333;
        }
        .fc-day-today {
            background-color: #d9e6d2 !important;
        }
    </style>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>