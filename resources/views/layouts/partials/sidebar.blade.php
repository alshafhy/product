{{-- Sidebar — BUG 2 FIX --}}
<div class="sidebar">
    <div class="sidebar-header">
        {{-- Brand logo/text would go here --}}
    </div>
    
    <div class="main-menu-content">
        <ul class="nav flex-column" id="main-menu-navigation">
            @foreach($menuItems as $item)
                @if($item->children->count() > 0)
                    <li class="nav-item">
                        {{-- RTL: icon on right, arrow on left --}}
                        <a class="nav-link collapsed d-flex align-items-center"
                           data-bs-toggle="collapse"
                           href="#menu-{{ $item->id }}"
                           aria-expanded="{{ $item->children->contains(fn($c) => $c->isCurrentRoute()) ? 'true' : 'false' }}">

                          {{-- Arrow: always on the START (left in RTL, right in LTR) --}}
                          <i class="bi bi-chevron-left collapse-arrow flex-shrink-0"
                             style="font-size:0.75rem; transition: transform 0.2s;"></i>

                          {{-- Spacer pushes icon+label to the end --}}
                          <span class="flex-grow-1"></span>

                          {{-- Label --}}
                          <span class="nav-label mx-2">{{ $item->comp_ar_label }}</span>

                          {{-- Icon: always on the END (right in RTL) --}}
                          <i class="bi {{ $item->icon_class }} nav-icon flex-shrink-0"></i>

                        </a>
                        
                        <ul class="collapse {{ $item->children->contains(fn($c) => $c->isCurrentRoute()) ? 'show' : '' }}" 
                            id="menu-{{ $item->id }}">
                            @foreach($item->children as $child)
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center {{ $child->isCurrentRoute() ? 'active' : '' }}"
                                       href="{{ $child->getRouteUrl() }}">
                                      <span class="flex-grow-1"></span>
                                      <span class="nav-label mx-2">{{ $child->comp_ar_label }}</span>
                                      <i class="bi {{ $child->icon_class }} nav-icon flex-shrink-0"
                                         style="font-size:0.85rem;"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center {{ $item->isCurrentRoute() ? 'active' : '' }}"
                           href="{{ $item->getRouteUrl() }}">
                          <span class="flex-grow-1"></span>
                          <span class="nav-label mx-2">{{ $item->comp_ar_label }}</span>
                          <i class="bi {{ $item->icon_class }} nav-icon flex-shrink-0"></i>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
