{{-- Foreach menu item starts --}}
@if(env('SHOW_SUPER_ADMIN_MENU', false))
  @if(isset($menuData[0]))
    @foreach($menuData[0]->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ __('locale.'.$menu->navheader) }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp
      <li class="nav-item {{ $custom_classes }} {{Route::currentRouteName() === $menu->slug ? 'active' : ''}}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __($menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge rounded-pill badge-light-primary ms-auto me-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }}">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
          @include('panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>
      @endif
    @endforeach
  @endif
@endif
{{-- Foreach menu item ends --}}