@extends('layouts/app')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
{{-- Page css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->

@if (config('custom.custom.showDashboard'))
<section id="dashboard-ecommerce">
  <div class="row match-height">
    <!-- Medal Card -->
    <div class="col-xl-4 col-md-6 col-12">
      <div class="card card-congratulation-medal">
        <div class="card-body">
          <h5>مرحبا بك</h5>
          <p class="card-text font-small-3">أخر عملية دخول كانت
            {{ (auth()->user()->last_login_at) ? auth()->user()->last_login_at->diffForHumans() : "" }}
          </p>
          <p class="card-text font-small-3">{{ session('current_branch_name')}} / {{session('current_department_name')}}
          </p>
          {{-- <p class="card-text font-small-3">الفرع الحالى / الإدارة الحالية </p> --}}
          {{-- <p class="card-text font-small-3">الإدارة الحالية </p> --}}
          {{-- <h3 class="mb-75 mt-2 pt-50">
                <a href="#">$48.9k</a>
              </h3> --}}

          {{-- <a href="{{ route('workOrders.index') }}" class="btn btn-sm btn-primary"> أوامر العمل</a>
          <a href="{{ route('workOrdersPermits.index') }}" class="btn btn-sm btn-primary"></a>
          <a href="{{ route('financialDues.index') }}" class="btn btn-sm btn-primary"> المستخلصات</a> --}}


          {{-- <button type="button" class="btn-sm btn-primary"> أوامر العمل</button> --}}
          {{-- <button type="button" class="btn-sm btn-primary"></button> --}}
          {{-- <button type="button" class="btn-sm btn-primary"> المستخلصات</button> --}}
          <img src="{{asset('images/illustration/administrator-work.svg')}}" class="administrator-work"
            alt="administrator work Pic" />
        </div>
      </div>
    </div>
    <!--/ Medal Card -->

    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">إحصائيات عامة</h4>
          <div class="d-flex align-items-center">
            <p class="card-text font-small-2 me-25 mb-0">أخر تحديث منذ ساعة مضت</p>
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="edit" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$colorCount ?? 0}}</h4>
                  <p class="card-text font-small-3 mb-0">الألوان</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="file-text" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$productCount ?? 0}}</h4>
                  <p class="card-text font-small-3 mb-0">المنتجات</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="activity" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$sizeCount ?? 0}}</h4>
                  <p class="card-text font-small-3 mb-0">المقاسات</p>
                </div>
              </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6 col-12">
                  <div class="d-flex flex-row">
                    <div class="avatar bg-light-success me-2">
                      <div class="avatar-content">
                        <i data-feather="layers" class="avatar-icon"></i>
                      </div>
                    </div>
                    <div class="my-auto">
                      <h4 class="fw-bolder mb-0">{{$financialDueCount ?? 0}}</h4>
            <p class="card-text font-small-3 mb-0">المستخلصات</p>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
  </div>
  </div>
  {{-- <div class="col-xl-12 col-md-6 col-12">
          <div class="card card-statistics">
            <div class="card-body statistics-body">
              <div class="row">

                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                  <div class="d-flex flex-row">
                    <div class="avatar bg-light-primary me-2">
                      <div class="avatar-content">
                        <i data-feather="list" class="avatar-icon"></i>
                      </div>
                    </div>
                    <div class="my-auto">
                      <h4 class="fw-bolder mb-0">{{$assayFormsCount ?? 0}}</h4>
  <p class="card-text font-small-3 mb-0">عدد المقايسات</p>
  </div>
  </div>
  </div>

  <div class="col-xl-3 col-sm-6 col-12">
    <div class="d-flex flex-row">
      <div class="avatar bg-light-primary me-2">
        <div class="avatar-content">
          <i data-feather="check" class="avatar-icon"></i>
        </div>
      </div>
      <div class="my-auto">
        <h4 class="fw-bolder mb-0">{{$finishedWorkOrderCount ?? 0}}</h4>
        <p class="card-text font-small-3 mb-0"> المنفذة</p>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 col-12">
    <div class="d-flex flex-row">
      <div class="avatar bg-light-warning me-2">
        <div class="avatar-content">
          <i data-feather="check" class="avatar-icon"></i>
        </div>
      </div>
      <div class="my-auto">
        <h4 class="fw-bolder mb-0">{{$achievementCertificateCount ?? 0}}</h4>
        <p class="card-text font-small-3 mb-0">عدد شهادات الانجاز</p>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 col-12">
    <div class="d-flex flex-row">
      <div class="avatar bg-light-success me-2">
        <div class="avatar-content">
          <i data-feather="check" class="avatar-icon"></i>
        </div>
      </div>
      <div class="my-auto">
        <h4 class="fw-bolder mb-0">{{$financialDueWorkOrderCount ?? 0}}</h4>
        <p class="card-text font-small-3 mb-0"> التي صدر لها مستخلص</p>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div> --}}
  <!--/ Statistics Card -->
  </div>

  <div class="row match-height">
    {{-- <x-dashboard.work_order_review></x-dashboard.work_order_review>
        <x-dashboard.emergency_missions_review></x-dashboard.emergency_missions_review> --}}

  </div>
  <div class="row match-height">
    {{-- <x-dashboard.users_entery_progress /> --}}
  </div>
  {{ $showAnotherCards = false}}
  @if ($showAnotherCards)
  <div class="row match-height">
    <div class="col-lg-4 col-12">
      <div class="row match-height">
        <!-- Bar Chart - Orders -->
        <div class="col-lg-6 col-md-3 col-6">
          <div class="card">
            <div class="card-body pb-50">
              <h6>أوامر العمل</h6>
              <h2 class="fw-bolder mb-1">2,76k</h2>
              <div id="statistics-order-chart"></div>
            </div>
          </div>
        </div>
        <!--/ Bar Chart - Orders -->

        <!-- Line Chart - Profit -->
        <div class="col-lg-6 col-md-3 col-6">
          <div class="card card-tiny-line-stats">
            <div class="card-body pb-50">
              <h6>المستخلصات</h6>
              <h2 class="fw-bolder mb-1">6,24k</h2>
              <div id="statistics-profit-chart"></div>
            </div>
          </div>
        </div>
        <!--/ Line Chart - Profit -->

        <!-- Earnings Card -->
        <div class="col-lg-12 col-md-6 col-12">
          <div class="card earnings-card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h4 class="card-title mb-1">المستخلصات</h4>
                  <div class="font-small-2">هذا الشهر</div>
                  <h5 class="mb-1"> 4055.56 ريال سعودى </h5>
                  <p class="card-text text-muted font-small-2">
                    <span class="fw-bolder">68.2%</span><span> باجمالى زيادة عن الشهر السابق.</span>
                  </p>
                </div>
                <div class="col-6">
                  <div id="earnings-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Earnings Card -->
      </div>
    </div>

    <!-- Revenue Report Card -->
    <div class="col-lg-8 col-12">
      <div class="card card-revenue-budget">
        <div class="row mx-0">
          <div class="col-md-8 col-12 revenue-report-wrapper">
            <div class="d-sm-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-50 mb-sm-0">متابعة المستخلصات</h4>
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center me-2">
                  <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                  <span>الفواتير</span>
                </div>
                <div class="d-flex align-items-center ms-75">
                  <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                  <span>المستخلصات</span>
                </div>
              </div>
            </div>
            <div id="revenue-report-chart"></div>
          </div>
          <div class="col-md-4 col-12 budget-wrapper">
            <div class="btn-group">
              <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                2020
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">2020</a>
                <a class="dropdown-item" href="#">2019</a>
                <a class="dropdown-item" href="#">2018</a>
              </div>
            </div>
            <h2 class="mb-25">25,852</h2>
            <div class="d-flex justify-content-center">
              <span class="fw-bolder me-25">الاجمالى المستحق</span>
              <span>56,800</span>
            </div>
            <div id="budget-chart"></div>
            <button type="button" class="btn btn-primary">عرض التفاصيل</button>
          </div>
        </div>
      </div>
    </div>
    <!--/ Revenue Report Card -->
  </div>

  <div class="row match-height">
    <!-- Avg Sessions Chart Card starts -->
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-body">
          <div class="row pb-50">
            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
              <div class="mb-1 mb-sm-0">
                <h2 class="fw-bolder mb-25">2.7K</h2>
                <p class="card-text fw-bold mb-2">عدد</p>
                <div class="font-medium-2">
                  <span class="text-success me-25">+5.2%</span>
                  <span>مقارنة بأخر سبعة ايام</span>
                </div>
              </div>
              <button type="button" class="btn btn-primary">عرض التفاصيل</button>
            </div>
            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
              <div class="dropdown chart-dropdown">
                <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  الاسبوع الحالى
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">
                  <a class="dropdown-item" href="#">Last 28 Days</a>
                  <a class="dropdown-item" href="#">Last Month</a>
                  <a class="dropdown-item" href="#">Last Year</a>
                </div>
              </div>
              <div id="avg-sessions-chart"></div>
            </div>
          </div>
          <hr />
          <div class="row avg-sessions pt-50">
            <div class="col-6 mb-2">
              <p class="mb-50">تم الارسال</p>
              <div class="progress progress-bar-primary" style="height: 6px">
                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100"
                  style="width: 50%"></div>
              </div>
            </div>
            <div class="col-6 mb-2">
              <p class="mb-50">منتظر السداد</p>
              <div class="progress progress-bar-warning" style="height: 6px">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100"
                  style="width: 60%"></div>
              </div>
            </div>
            <div class="col-6">
              <p class="mb-50">متأخر</p>
              <div class="progress progress-bar-danger" style="height: 6px">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100"
                  style="width: 70%"></div>
              </div>
            </div>
            <div class="col-6">
              <p class="mb-50">تم التسليم والاقفال</p>
              <div class="progress progress-bar-success" style="height: 6px">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100"
                  style="width: 90%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Avg Sessions Chart Card ends -->

    <!-- Support Tracker Chart Card starts -->
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <h4 class="card-title">متابعة أوامر العمل</h4>
          <div class="dropdown chart-dropdown">
            <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              الشهر الحالى
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem4">
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
              <h1 class="font-large-2 fw-bolder mt-2 mb-0">163</h1>
              <p class="card-text">اجمالى</p>
            </div>
            <div class="col-sm-10 col-12 d-flex justify-content-center">
              <div id="support-trackers-chart"></div>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-1">
            <div class="text-center">
              <p class="card-text mb-50">قيد التنفيذ</p>
              <span class="font-large-1 fw-bold">29</span>
            </div>
            <div class="text-center">
              <p class="card-text mb-50">متوقف</p>
              <span class="font-large-1 fw-bold">9</span>
            </div>
            <div class="text-center">
              <p class="card-text mb-50">تم التسليم</p>
              <span class="font-large-1 fw-bold">63</span>
            </div>
            <div class="text-center">
              <p class="card-text mb-50">متوسط وقت التنفيذ</p>
              <span class="font-large-1 fw-bold">48d</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Support Tracker Chart Card ends -->
  </div>
  @endif
  {{ $showMoreCards = false}}
  @if ($showMoreCards)
  <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-8 col-12">
      <div class="card card-company-table">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Category</th>
                  <th>Views</th>
                  <th>Revenue</th>
                  <th>Sales</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Dixons</div>
                        <div class="font-small-2 text-muted">meguc@ruj.io</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-primary me-1">
                        <div class="avatar-content">
                          <i data-feather="monitor" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Technology</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">23.4k</span>
                      <span class="font-small-2 text-muted">in 24 hours</span>
                    </div>
                  </td>
                  <td>$891.2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">68%</span>
                      <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/parachute.svg')}}" alt="Parachute svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Motels</div>
                        <div class="font-small-2 text-muted">vecav@hodzi.co.uk</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-success me-1">
                        <div class="avatar-content">
                          <i data-feather="coffee" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Grocery</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">78k</span>
                      <span class="font-small-2 text-muted">in 2 days</span>
                    </div>
                  </td>
                  <td>$668.51</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">97%</span>
                      <i data-feather="trending-up" class="text-success font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/brush.svg')}}" alt="Brush svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Zipcar</div>
                        <div class="font-small-2 text-muted">davcilse@is.gov</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-warning me-1">
                        <div class="avatar-content">
                          <i data-feather="watch" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Fashion</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">162</span>
                      <span class="font-small-2 text-muted">in 5 days</span>
                    </div>
                  </td>
                  <td>$522.29</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">62%</span>
                      <i data-feather="trending-up" class="text-success font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/star.svg')}}" alt="Star svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Owning</div>
                        <div class="font-small-2 text-muted">us@cuhil.gov</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-primary me-1">
                        <div class="avatar-content">
                          <i data-feather="monitor" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Technology</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">214</span>
                      <span class="font-small-2 text-muted">in 24 hours</span>
                    </div>
                  </td>
                  <td>$291.01</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">88%</span>
                      <i data-feather="trending-up" class="text-success font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/book.svg')}}" alt="Book svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Cafés</div>
                        <div class="font-small-2 text-muted">pudais@jife.com</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-success me-1">
                        <div class="avatar-content">
                          <i data-feather="coffee" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Grocery</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">208</span>
                      <span class="font-small-2 text-muted">in 1 week</span>
                    </div>
                  </td>
                  <td>$783.93</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">16%</span>
                      <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/rocket.svg')}}" alt="Rocket svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Kmart</div>
                        <div class="font-small-2 text-muted">bipri@cawiw.com</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-warning me-1">
                        <div class="avatar-content">
                          <i data-feather="watch" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Fashion</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">990</span>
                      <span class="font-small-2 text-muted">in 1 month</span>
                    </div>
                  </td>
                  <td>$780.05</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">78%</span>
                      <i data-feather="trending-up" class="text-success font-medium-1"></i>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/speaker.svg')}}" alt="Speaker svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Payers</div>
                        <div class="font-small-2 text-muted">luk@izug.io</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-warning me-1">
                        <div class="avatar-content">
                          <i data-feather="watch" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Fashion</span>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">12.9k</span>
                      <span class="font-small-2 text-muted">in 12 hours</span>
                    </div>
                  </td>
                  <td>$531.49</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="fw-bolder me-1">42%</span>
                      <i data-feather="trending-up" class="text-success font-medium-1"></i>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--/ Company Table Card -->

    <!-- Developer Meetup Card -->
    {{-- <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-developer-meetup">
              <div class="meetup-img-wrapper rounded-top text-center">
                <img src="{{asset('images/illustration/email.svg')}}" alt="Meeting Pic" height="170" />
  </div>
  <div class="card-body">
    <div class="meetup-header d-flex align-items-center">
      <div class="meetup-day">
        <h6 class="mb-0">THU</h6>
        <h3 class="mb-0">24</h3>
      </div>
      <div class="my-auto">
        <h4 class="card-title mb-25">Developer Meetup</h4>
        <p class="card-text mb-0">Meet world popular developers</p>
      </div>
    </div>
    <div class="mt-0">
      <div class="avatar float-start bg-light-primary rounded me-1">
        <div class="avatar-content">
          <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
        </div>
      </div>
      <div class="more-info">
        <h6 class="mb-0">Sat, May 25, 2020</h6>
        <small>10:AM to 6:PM</small>
      </div>
    </div>
    <div class="mt-2">
      <div class="avatar float-start bg-light-primary rounded me-1">
        <div class="avatar-content">
          <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
        </div>
      </div>
      <div class="more-info">
        <h6 class="mb-0">Central Park</h6>
        <small>Manhattan, New york City</small>
      </div>
    </div>
    <div class="avatar-group">
      <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Billy Hopkins"
        class="avatar pull-up">
        <img src="{{asset('images/portrait/small/avatar-s-9.jpg')}}" alt="Avatar" width="33" height="33" />
      </div>
      <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Amy Carson"
        class="avatar pull-up">
        <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" width="33" height="33" />
      </div>
      <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Brandon Miles"
        class="avatar pull-up">
        <img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="Avatar" width="33" height="33" />
      </div>
      <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Daisy Weber"
        class="avatar pull-up">
        <img src="{{asset('images/portrait/small/avatar-s-20.jpg')}}" alt="Avatar" width="33" height="33" />
      </div>
      <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Jenny Looper"
        class="avatar pull-up">
        <img src="{{asset('images/portrait/small/avatar-s-20.jpg')}}" alt="Avatar" width="33" height="33" />
      </div>
      <h6 class="align-self-center cursor-pointer ms-50 mb-0">+42</h6>
    </div>
  </div>
  </div>
  </div> --}}
  <!--/ Developer Meetup Card -->

  <!-- Browser States Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-browser-states">
      <div class="card-header">
        <div>
          <h4 class="card-title">Browser States</h4>
          <p class="card-text font-small-2">Counter August 2020</p>
        </div>
        <div class="dropdown chart-dropdown">
          <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#">Last 28 Days</a>
            <a class="dropdown-item" href="#">Last Month</a>
            <a class="dropdown-item" href="#">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="browser-states">
          <div class="d-flex">
            <img src="{{asset('images/icons/google-chrome.png')}}" class="rounded me-1" height="30"
              alt="Google Chrome" />
            <h6 class="align-self-center mb-0">Google Chrome</h6>
          </div>
          <div class="d-flex align-items-center">
            <div class="fw-bold text-body-heading me-1">54.4%</div>
            <div id="browser-state-chart-primary"></div>
          </div>
        </div>
        <div class="browser-states">
          <div class="d-flex">
            <img src="{{asset('images/icons/mozila-firefox.png')}}" class="rounded me-1" height="30"
              alt="Mozila Firefox" />
            <h6 class="align-self-center mb-0">Mozila Firefox</h6>
          </div>
          <div class="d-flex align-items-center">
            <div class="fw-bold text-body-heading me-1">6.1%</div>
            <div id="browser-state-chart-warning"></div>
          </div>
        </div>
        <div class="browser-states">
          <div class="d-flex">
            <img src="{{asset('images/icons/apple-safari.png')}}" class="rounded me-1" height="30"
              alt="Apple Safari" />
            <h6 class="align-self-center mb-0">Apple Safari</h6>
          </div>
          <div class="d-flex align-items-center">
            <div class="fw-bold text-body-heading me-1">14.6%</div>
            <div id="browser-state-chart-secondary"></div>
          </div>
        </div>
        <div class="browser-states">
          <div class="d-flex">
            <img src="{{asset('images/icons/internet-explorer.png')}}" class="rounded me-1" height="30"
              alt="Internet Explorer" />
            <h6 class="align-self-center mb-0">Internet Explorer</h6>
          </div>
          <div class="d-flex align-items-center">
            <div class="fw-bold text-body-heading me-1">4.2%</div>
            <div id="browser-state-chart-info"></div>
          </div>
        </div>
        <div class="browser-states">
          <div class="d-flex">
            <img src="{{asset('images/icons/opera.png')}}" class="rounded me-1" height="30" alt="Opera Mini" />
            <h6 class="align-self-center mb-0">Opera Mini</h6>
          </div>
          <div class="d-flex align-items-center">
            <div class="fw-bold text-body-heading me-1">8.4%</div>
            <div id="browser-state-chart-danger"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Browser States Card -->

  <!-- Goal Overview Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Goal Overview</h4>
        <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
      </div>
      <div class="card-body p-0">
        <div id="goal-overview-radial-bar-chart" class="my-2"></div>
        <div class="row border-top text-center mx-0">
          <div class="col-6 border-end py-1">
            <p class="card-text text-muted mb-0">Completed</p>
            <h3 class="fw-bolder mb-0">786,617</h3>
          </div>
          <div class="col-6 py-1">
            <p class="card-text text-muted mb-0">In Progress</p>
            <h3 class="fw-bolder mb-0">13,561</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Goal Overview Card -->

  <!-- Transaction Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-transaction">
      <div class="card-header">
        <h4 class="card-title">Transactions</h4>
        <div class="dropdown chart-dropdown">
          <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#">Last 28 Days</a>
            <a class="dropdown-item" href="#">Last Month</a>
            <a class="dropdown-item" href="#">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="transaction-item">
          <div class="d-flex">
            <div class="avatar bg-light-primary rounded float-start">
              <div class="avatar-content">
                <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="transaction-percentage">
              <h6 class="transaction-title">Wallet</h6>
              <small>Starbucks</small>
            </div>
          </div>
          <div class="fw-bolder text-danger">- $74</div>
        </div>
        <div class="transaction-item">
          <div class="d-flex">
            <div class="avatar bg-light-success rounded float-start">
              <div class="avatar-content">
                <i data-feather="check" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="transaction-percentage">
              <h6 class="transaction-title">Bank Transfer</h6>
              <small>Add Money</small>
            </div>
          </div>
          <div class="fw-bolder text-success">+ $480</div>
        </div>
        <div class="transaction-item">
          <div class="d-flex">
            <div class="avatar bg-light-danger rounded float-start">
              <div class="avatar-content">
                <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="transaction-percentage">
              <h6 class="transaction-title">Paypal</h6>
              <small>Add Money</small>
            </div>
          </div>
          <div class="fw-bolder text-success">+ $590</div>
        </div>
        <div class="transaction-item">
          <div class="d-flex">
            <div class="avatar bg-light-warning rounded float-start">
              <div class="avatar-content">
                <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="transaction-percentage">
              <h6 class="transaction-title">Mastercard</h6>
              <small>Ordered Food</small>
            </div>
          </div>
          <div class="fw-bolder text-danger">- $23</div>
        </div>
        <div class="transaction-item">
          <div class="d-flex">
            <div class="avatar bg-light-info rounded float-start">
              <div class="avatar-content">
                <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="transaction-percentage">
              <h6 class="transaction-title">Transfer</h6>
              <small>Refund</small>
            </div>
          </div>
          <div class="fw-bolder text-success">+ $98</div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transaction Card -->
  </div>
  @endif
</section>
@endif
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
{{-- Page js files --}}

<script src="{{ asset(mix('js/scripts/pages/dashboard-default.js')) }}"></script>
@endsection