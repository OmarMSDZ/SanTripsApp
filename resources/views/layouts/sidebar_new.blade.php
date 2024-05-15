<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- ($APPS) --}}
        @foreach ($APPS as $key)
        <li class="nav-item">
            <a class="nav-link @if ($key->ruta_actual != 1)
                collapsed
            @endif "href="{{route($key->ruta)}}">
              <i class="bi bi-grid"></i>
              <span>{{$key->nombre}}</span>
            </a>
          </li>
        @endforeach
    </ul>

  </aside><!-- End Sidebar-->
