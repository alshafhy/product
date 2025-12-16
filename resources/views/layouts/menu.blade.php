<li class="nav-item  {{Helper::checkCurrentRouteName('home') ? 'active' : ''}}">
  <a href="{{ route('home') }}" class="d-flex align-items-center">
    <i data-feather="home"></i>
    <span class="menu-title text-truncate">@lang('Home')</span>
  </a>
</li>


<x-sys-menu></x-sys-menu>

{{-- <li class="nav-item  {{Route::currentRouteName() === 'labs.index' ? 'active' : ''}}">
<a href="{{ route('labs.index') }}" class="d-flex align-items-center">
  <i data-feather="file"></i>
  <span class="menu-title text-truncate">@lang('models/labs.plural')</span>
</a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'returnSituations.index' ? 'active' : ''}}">
  <a href="{{ route('returnSituations.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/returnSituations.plural')</span>
  </a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'layers.index' ? 'active' : ''}}">
  <a href="{{ route('layers.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/layers.plural')</span>
  </a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'workOrderFollows.index' ? 'active' : ''}}">
  <a href="{{ route('workOrderFollows.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/workOrderFollows.plural')</span>
  </a>
</li> --}}

{{-- new Routs  --}}
<li class="nav-item {{ Request::is('sizes*') ? 'active' : '' }}">
  <a href="{!! route('sizes.index') !!}" class="d-flex align-items-center">
    <i data-feather="box"></i>
    <span class="menu-title text-truncate">@lang('models/sizes.plural')</span>
  </a>
</li>
<li class="nav-item {{ Request::is('colors*') ? 'active' : '' }}">
  <a href="{!! route('colors.index') !!}" class="d-flex align-items-center">
    <i data-feather="droplet"></i>
    <span class="menu-title text-truncate">@lang('models/colors.plural')</span>
  </a>
</li>
<li class="nav-item {{ Request::is('products*') ? 'active' : '' }}">
  <a href="{!! route('products.index') !!}" class="d-flex align-items-center">
    <i data-feather="package"></i>
    <span class="menu-title text-truncate">@lang('models/products.plural')</span>
  </a>
</li>
{{-- <li class="nav-item  {{Route::currentRouteName() === 'financialDueTypes.index' ? 'active' : ''}}">
<a href="{{ route('financialDueTypes.index') }}" class="d-flex align-items-center">
  <i data-feather="file"></i>
  <span class="menu-title text-truncate">@lang('models/financialDueTypes.plural')</span>
</a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'achievementCertificates.index' ? 'active' : ''}}">
  <a href="{{ route('achievementCertificates.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/achievementCertificates.plural')</span>
  </a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'financialDues.index' ? 'active' : ''}}">
  <a href="{{ route('financialDues.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/financialDues.plural')</span>
  </a>
</li>

<li class="nav-item  {{Route::currentRouteName() === 'baladies.index' ? 'active' : ''}}">
  <a href="{{ route('baladies.index') }}" class="d-flex align-items-center">
    <i data-feather="file"></i>
    <span class="menu-title text-truncate">@lang('models/baladies.plural')</span>
  </a>
</li> --}}

{{-- <li class="nav-item  {{Route::currentRouteName() === 'emergencyMissions.index' ? 'active' : ''}}">
<a href="{{ route('emergencyMissions.index') }}" class="d-flex align-items-center">
  <i data-feather="file"></i>
  <span class="menu-title text-truncate">@lang('models/emergencyMissions.plural')</span>
</a>
</li> --}}


{{-- <li class="nav-item  {{Route::currentRouteName() === 'missionTypes.index' ? 'active' : ''}}">
<a href="{{ route('missionTypes.index') }}" class="d-flex align-items-center">
  <i data-feather="file"></i>
  <span class="menu-title text-truncate">@lang('models/missionTypes.plural')</span>
</a>
</li> --}}

{{-- <li class="nav-item  {{Route::currentRouteName() === 'consultants.index' ? 'active' : ''}}">
<a href="{{ route('consultants.index') }}" class="d-flex align-items-center">
  <i data-feather="file"></i>
  <span class="menu-title text-truncate">@lang('models/consultants.plural')</span>
</a>
</li> --}}


{{-- <li class="nav-item">
    <a href="{{ route('systemReleases.index') }}" class="nav-link {{ Request::is('systemReleases*') ? 'active' : '' }}">
<i class="nav-icon fas fa-home"></i>
<p>@lang('models/systemReleases.plural')</p>
</a>
</li>

<li class="nav-item">
  <a href="{{ route('systemReleasesFeatures.index') }}" class="nav-link {{ Request::is('systemReleasesFeatures*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-home"></i>
    <p>@lang('models/systemReleasesFeatures.plural')</p>
  </a>
</li> --}}

{{-- <li class="nav-item">
    <a href="{{ route('workOrderTransactionsHistories.index') }}" class="nav-link {{ Request::is('workOrderTransactionsHistories*') ? 'active' : '' }}">
<i class="nav-icon fas fa-home"></i>
<p>@lang('models/workOrderTransactionsHistories.plural')</p>
</a>
</li> --}}