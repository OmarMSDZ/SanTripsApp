<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @foreach ($APPS as $key)
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route($key->ruta)}}">
              <i class="bi bi-grid"></i>
              <span>{{$key->nombre}}</span>
            </a>
          </li>
        @endforeach
    </ul>

  </aside><!-- End Sidebar-->
