@if(request()->route()->uri <> '/' && request()->route()->uri <> 'home' )
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-start mb-0">@yield('title')</h2>
          <div class="breadcrumb-wrapper">
            @if(@isset($breadcrumbs))
            <ol class="breadcrumb">
                {{-- this will load breadcrumbs dynamically from controller --}}
                @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item">
                    @if(isset($breadcrumb['link']))
                    <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link']:url($breadcrumb['link']) }}">
                        @endif
                        {{$breadcrumb['name']}}
                        @if(isset($breadcrumb['link']))
                    </a>
                    @endif
                </li>
                @endforeach
            </ol>
            @else
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{url('/home') }}">{{__('Home')}}</a>
                </li>
                <li class="breadcrumb-item">
                @yield('breadcrumbs')
                </li>
              </ol> 
            @endisset
          
          </div>
        </div>
      </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
      <div class="mb-1 breadcrumb-right">
        <div class="dropdown">
          <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle  hide-arrow" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i data-feather="grid"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end">
            @if(auth()->user())
              @if (auth()->user()->hasRole('admin') || auth()->user()->can('workOrdersManagement.workOrders.index'))
                <a class="dropdown-item" href="{{ route('workOrders.index') }}">
                  <i class="me-1" data-feather="clipboard"></i>
                  <span class="align-middle">أوامر العمل</span>
                </a>
              @endif
              @if (auth()->user()->hasRole('admin') || auth()->user()->can('workOrdersManagement.workOrdersPermits.index') )
              <a class="dropdown-item" href="{{ route('workOrdersPermits.index') }}">
                <i class="me-1" data-feather="clipboard"></i>
                <span class="align-middle">التصاريح</span>
              </a>
              @endif
              @if (auth()->user()->hasRole('admin') || auth()->user()->can('emergency.emergencyMissions.index'))
              <a class="dropdown-item" href="{{ route('emergencyMissions.index') }}">
                <i class="me-1" data-feather="clipboard"></i>
                <span class="align-middle">مهمات الطوارئ</span>
              </a>
              @endif
              @if ( auth()->user()->hasRole('admin') || auth()->user()->can('stores.assayForms.index'))
              <a class="dropdown-item" href="{{ route('assayForms.index') }}">
                <i class="me-1" data-feather="clipboard"></i>
                <span class="align-middle">المقايسات</span>
              </a>
              @endif
              @if ( auth()->user()->hasRole('admin') || auth()->user()->can('paymentClearances.achievementCertificates.index'))
              <a class="dropdown-item" href="{{ route('achievementCertificates.index') }}">
                <i class="me-1" data-feather="clipboard"></i>
                <span class="align-middle">شهادات الانجاز</span>
              </a>
              @endif
              @if ( auth()->user()->hasRole('admin') || auth()->user()->can('paymentClearances.financialDues.index'))
              <a class="dropdown-item" href="{{ route('financialDues.index') }}">
                <i class="me-1" data-feather="clipboard"></i>
                <span class="align-middle">المستخلصات</span>
              </a>
              @endif
            @endif
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endif

