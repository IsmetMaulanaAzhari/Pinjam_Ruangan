document.addEventListener('DOMContentLoaded', function () {
    // Data peminjaman ruangan (contoh, ganti dengan data dari backend)
    const events = [
        {
            title: 'Ruangan A',
            start: '2025-04-23',
            extendedProps: {
                details: 'Peminjaman oleh John Doe dari 09:00 - 12:00 untuk rapat.'
            }
        },
        {
            title: 'Ruangan B',
            start: '2025-04-24',
            extendedProps: {
                details: 'Peminjaman oleh Jane Smith dari 13:00 - 15:00 untuk seminar.'
            }
        }
    ];

    // Inisialisasi FullCalendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        eventClick: function (info) {
            // Tampilkan pop-up dengan detail ruangan
            const details = info.event.extendedProps.details;
            $('#roomDetailsContent').html(`<p>${details}</p>`);
            $('#roomDetailsModal').modal('show');
        },
        dateClick: function (info) {
            // Tampilkan tanggal yang diklik
            alert('Tanggal yang diklik: ' + info.dateStr);
        }
    });

    calendar.render();
});