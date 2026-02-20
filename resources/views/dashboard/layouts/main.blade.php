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
    <title>{{ $title }} | Universitas Sultan Ageng Tirtayasa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/UNIVERSITAS TEKNOKRAT.png') }}">
    <style>
        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        .sidebar-wrapper {
            position: relative;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background-color: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transform: translateX(0);
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        
        .main-content {
            min-height: 100vh;
            background-color: #f8f9fa;
            margin-left: 280px;
            transition: margin-left 0.3s ease-in-out;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        .content-area {
            background-color: #f8f9fa;
            min-height: calc(100vh - 70px);
        }
        
        .screen-cover {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
            transition: opacity 0.3s ease-in-out;
        }
        
        #sidebarToggle {
            border: none;
            background: transparent;
            font-size: 1.2rem;
        }
        
        #sidebarToggle:hover {
            background-color: #f8f9fa;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .screen-cover.active {
                display: block !important;
            }
        }
        
        @media (min-width: 769px) {
            .screen-cover {
                display: none !important;
            }
        }
        
        /* Room thumbnail styles */
        .room-thumbnail {
            transition: transform 0.2s ease-in-out;
            border-radius: 8px !important;
        }
        
        .room-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Table styling for better image display */
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="screen-cover d-none" onclick="toggleSidebar()"></div>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <div class="sidebar" id="sidebar">
                @include('dashboard.partials.sidebar')
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1" id="mainContent">
            <div class="d-flex align-items-center justify-content-between p-3 bg-white border-bottom">
                <!-- Toggle Button -->
                <button class="btn btn-outline-secondary" id="sidebarToggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="d-flex align-items-center">
                    @include('dashboard.partials.navbar')
                </div>
            </div>
            
            <div class="content-area p-4">
                @yield('container')
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/edituser.js') }}"></script>
    <script src="{{ asset('js/editroom.js') }}"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const screenCover = document.querySelector('.screen-cover');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar_items = document.querySelectorAll('.sidebar-item');
        
        let isSidebarCollapsed = false;

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                // Mobile behavior
                sidebar.classList.toggle('active');
                screenCover.classList.toggle('d-none');
                screenCover.classList.toggle('active');
            } else {
                // Desktop behavior
                isSidebarCollapsed = !isSidebarCollapsed;
                
                if (isSidebarCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                    sidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
                }
            }
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active');
            });
            e.closest('.sidebar-item').classList.add('active');
        }

        // Close sidebar when clicking screen cover (mobile)
        screenCover.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                screenCover.classList.add('d-none');
                screenCover.classList.remove('active');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                // Desktop view
                screenCover.classList.add('d-none');
                screenCover.classList.remove('active');
                sidebar.classList.remove('active');
                
                if (!isSidebarCollapsed) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
                }
            } else {
                // Mobile view
                sidebar.classList.remove('collapsed');
                mainContent.classList.add('expanded');
                sidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
                isSidebarCollapsed = false;
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 768) {
                sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
            } else {
                mainContent.classList.add('expanded');
            }
        });

        // Function to preview image (global function)
        window.previewImage = function(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    
                    // For edit modal, show the new image container
                    if (previewId === 'editRoomPreview') {
                        document.getElementById('newImageContainer').style.display = 'block';
                    }
                };
                
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                
                // For edit modal, hide the new image container
                if (previewId === 'editRoomPreview') {
                    document.getElementById('newImageContainer').style.display = 'none';
                }
            }
        };
    </script>

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
