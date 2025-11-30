<div class="nav">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
        <div class="d-flex justify-content-start align-items-center">
            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="/assets/burger.svg" class="mb-2" alt="">
            </button>
            <h2 class="nav-title" style="font-size: 28px; font-weight: 600; color: #2d3748;">{{ $title }}</h2>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center nav-input-container">
        <div class="nav-input-group">
            <input type="text" class="nav-input" placeholder="Search people, team, project">
            <button class="btn-nav-input"><img src="/assets/search.svg" alt=""></button>
        </div>

        <button class="btn-notif d-none d-md-block"><img src="/assets/bell.svg" alt=""></button>
    </div>
</div>
