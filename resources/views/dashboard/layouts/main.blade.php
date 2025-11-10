<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<<<<<<< HEAD
    <title>{{ $title }} | Universitas Sultan Ageng Tirtayasa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/LOGO_ORIGINAL.png') }}">
=======
    <title>{{ $title }} | Universitas Teknokrat Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/UNIVERSITAS TEKNOKRAT.png') }}">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
<<<<<<< HEAD
        <div class="col-navbar d-none d-xl-block" style="position: fixed; width: 240px; height: 100vh; padding: 0; left: 0; top: 0; z-index: 1000;">
=======
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7

            @include('dashboard.partials.sidebar')

        </div>


<<<<<<< HEAD
        <div class="col-12" style="padding: 0;">
            <div class="main-content-wrapper">
                @include('dashboard.partials.navbar')

                @yield('container')
            </div>
=======
        <div class="col-12 col-xl-9">
            @include('dashboard.partials.navbar')

            @yield('container')

>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
        </div>
    </div>




<<<<<<< HEAD
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
=======
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active')
            })
            e.closest('.sidebar-item').classList.add('active')

        }

        document.addEventListener('DOMContentLoaded', function() {
            var nameInput = document.getElementById('name');
            var sisaMinSpan = document.getElementById('sisaMin');

            nameInput.addEventListener('input', function() {
                var inputValue = nameInput.value.length;
                var minCharacter = 4;

                // Update sisaMinSpan
                sisaMinSpan.textContent = Math.max(0, minCharacter - inputValue);

                // Tampilkan notifikasi jika kurang dari 4 karakter
                if (inputValue < minCharacter) {
                    showNotification('Nama Lengkap harus memiliki setidaknya 4 karakter.');
                }
            });

            // Fungsi untuk menampilkan notifikasi
            function showNotification(message) {
                var notification = document.createElement('div');
                notification.className = 'alert alert-danger alert-dismissible fade show';
                notification.innerHTML = message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                document.body.appendChild(notification);

                // Menghilangkan notifikasi setelah beberapa detik (misalnya, 3 detik)
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>

</html>
