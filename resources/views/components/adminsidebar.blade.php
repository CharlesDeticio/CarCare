<nav>
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name">Carcare</span>
    </div>

    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">Welcome {{ $admin?->name ?? 'Admin' }}</span>
    </div>

      <div class="sidebar-content">
        <ul class="lists">
          <li class="list">
            <a href="{{ route('admin.indexuser') }}" class="nav-link">
              <i class="bx bx-home-alt icon"></i>
              <span class="link">Users</span>
            </a>
          </li>
          <li class="list">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="bx bx-bar-chart-alt-2 icon"></i>
              <span class="link">Shop Owner</span>
            </a>
          </li>
          <li class="list">
            <a href="{{ route('adminreport') }}" class="nav-link">
              <i class="bx bx-bell icon"></i>
              <span class="link">Report</span>
            </a>
          </li>
          {{-- <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-message-rounded icon"></i>
              <span class="link">Messages</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-pie-chart-alt-2 icon"></i>
              <span class="link">Analytics</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-heart icon"></i>
              <span class="link">Likes</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-folder-open icon"></i>
              <span class="link">Files</span>
            </a>
          </li>
        </ul>

        <div class="bottom-cotent">
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-cog icon"></i>
              <span class="link">Settings</span>
            </a>
          </li> --}}
          <li class="list">
            <form method="POST" action="{{ route('admin.logout') }}">
              @csrf
              <button type="submit" class="nav-link logout-button">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Log Out</span>
              </button>
            </form>
          </li>
          
        </form>
        </div>
      </div>
    </div>
  </nav>

  <section class="overlay"></section>

  <script>
    const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon"),
      overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  </script>