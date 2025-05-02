document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/api/calendar/events',
        selectable: true,
        select: function(info) {
            var title = prompt('Enter Event Title:');
            if (title) {
                var eventData = {
                    title: title,
                    start_date: info.startStr,
                    end_date: info.endStr
                };

                fetch('/api/calendar/events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(eventData)
                })
                .then(response => response.json())
                .then(data => {
                    calendar.refetchEvents();
                })
                .catch(error => {
                    alert('Failed to save event.');
                    console.error('Error:', error);
                });
            }
            calendar.unselect();
        }
    });

    calendar.render();
});
