<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route("dashboard") }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Bus Management -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route("buses.index") }}">
        <i class="mdi mdi-bus menu-icon"></i>
        <span class="menu-title">Buses</span>
      </a>
    </li>

    <!-- Route Management -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route("routes.index") }}">
        <i class="mdi mdi-map-marker menu-icon"></i>
        <span class="menu-title">Routes</span>
      </a>
    </li>

    <!-- Schedule Management -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route("schedules.index") }}">
        <i class="mdi mdi-timetable menu-icon"></i>
        <span class="menu-title">Schedules</span>
      </a>
    </li>

    <!-- Employee Management -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route("employees.index") }}">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Employees</span>
        </a>
      </li>

    <!-- Booking Management -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route("booking.index") }}">
        <i class="mdi mdi-ticket menu-icon"></i>
        <span class="menu-title">Bookings</span>
      </a>
    </li>



  </ul>
</nav>
