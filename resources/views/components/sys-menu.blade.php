@foreach($nodes as $sys)
    <li class="nav-item ">
      <a href="#" class="d-flex align-items-center">
        @if($sys->icon_name)
        <i data-feather="{{ $sys->icon_name }}"></i>
        @else
        <i data-feather="book"></i>
        @endif
        <span class="menu-title text-truncate">{{ $sys->comp_ar_label }}</span>
      </a>
      <ul class="menu-content">
        @foreach($sys->children as $menu)
          @if (count($menu->children) )
            <li class="nav-item ">
              <a class="d-flex align-items-center"><i data-feather='circle'></i><span
                class="menu-title text-truncate">{{$menu->comp_ar_label}}</span></a>
      
              <ul class="menu-content">
                @foreach($menu->children as $screen)
                <li class="nav-item  {{ Helper::checkActiveRoute($screen->route_name)  ? 'active' : ''}}">
                  <a @if($screen->isLeaf()) href="{{ ($screen->comp_type == 4) ? route('previewReport',$screen->route_name) : route($screen->route_name.'.index')  }}" @endif 
                    class="d-flex align-items-center" > 
                    <i data-feather='circle'></i>
                    <span class="menu-title text-truncate">{{$screen->comp_ar_label}}</span>
                  </a>
                </li>
                @endforeach
              </ul>
            </li>
          @else
            <li class="nav-item  {{ Helper::checkActiveRoute($menu->route_name,$menu->comp_type)  ? 'active' : ''}}">
              <a @if($menu->isLeaf()) href="{{ ($menu->comp_type == 4) ? route('previewReport',$menu->route_name) : route($menu->route_name.'.index')  }}" @endif 
                class="d-flex align-items-center" > 
                <i data-feather='circle'></i>
                <span class="menu-title text-truncate">{{$menu->comp_ar_label}}</span>
              </a>
            </li>
          @endif
        
        @endforeach
      </ul>
    </li>
@endforeach
