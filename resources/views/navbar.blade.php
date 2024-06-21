<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item active">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#client-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="client-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Clients</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Reports</span>
            </a>
          </li>
        </ul>
      </li><!-- End client Nav --> --}}
      
      {{-- <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.index') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span >User</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
        <ul id="components-nav" class="nav-content {{ request()->routeIs('user.index') ? '' : 'collapsed' }} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user.index')}}">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
        </ul>
      </li><!-- Users Nav --> --}}

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#collector-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Collector</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="collector-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Collectors</span>
            </a>
          </li>
          <li>
            <a href="{{}}">
              <i class="bi bi-circle"></i><span>Area</span>
            </a>
          </li>
        </ul>
      </li><!-- Collector Nav --> --}}

      
      @foreach($data as $item)
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#{{$item['description']}}-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>{{$item['description']}}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="{{$item['description']}}-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            @foreach($item['function'] as $function)
            <a href="{{$function['route']}}">
              <i class="bi bi-circle"></i><span>{{$function['description']}}</span>
            </a>

            @endforeach
          </li>
        </ul>
      </li>
    @endforeach



    
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside>