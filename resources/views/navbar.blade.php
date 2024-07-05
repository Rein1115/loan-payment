<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
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

      
      {{-- {{dd($data)}} --}}

      <li class="nav-item ">
        <a href="/" class="nav-link">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @if($data >0)
        @foreach($data as $item)
        <li class="nav-item ">
          <a class="nav-link" data-bs-target="#{{$item['description']}}-nav" data-bs-toggle="collapse" href="#">
            <i class="{{$item['icon']}}"></i><span>{{$item['description']}}</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="{{$item['description']}}-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              @foreach($item['function'] as $function)
              <a href="{{$function['route']}}">
                <i class="{{$function['icon']}}"></i><span>{{$function['description']}}</span>
              </a>
              @endforeach
            </li>
          </ul>
        </li>
      @endforeach
      @else



      @endif

      



    
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside>