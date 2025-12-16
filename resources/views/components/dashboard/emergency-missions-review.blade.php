@if ($allCount)
<div class="col-lg-6 col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between pb-0">
        
        <h4 class="card-title">
          <i data-feather="help-circle" class="font-medium-3 cursor-pointer" title="(غير المتوقف  نهائيا أو ملغى)"></i>
          متابعة مهمات الطوارئ  

        </h4>
      
        <div class="dropdown chart-dropdown">
          {{-- <button
            class="btn btn-sm border-0 dropdown-toggle p-50"
            type="button"
            id="dropdownItem4"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            الشهر الحالى
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem4">
            <a class="dropdown-item" href="#">Last 28 Days</a>
            <a class="dropdown-item" href="#">Last Month</a>
            <a class="dropdown-item" href="#">Last Year</a>
          </div> --}}
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
            <h1 class="font-large-2 fw-bolder mt-2 mb-0">{{$allCount}}</h1>
            <p class="card-text">اجمالى</p>
          </div>
          <div class="col-sm-10 col-12 d-flex justify-content-center">
            @if ($percentage)
               <div id="emergency-review-chart">{{$percentage}}</div> 
            @endif
            
          </div>
        </div>
        <div class="d-flex justify-content-between mt-1">
            @foreach ( $emergencyMissions as  $emergencyMission)
            <div class="text-center">
                <p class="card-text mb-50">{{$emergencyMission->status_title['title']}}</p>
                <span class="font-large-1 fw-bold">{{$emergencyMission->count}}</span>
            </div>
            @endforeach
          
          {{-- <div class="text-center">
            <p class="card-text mb-50">قيد التنفيذ</p>
            <span class="font-large-1 fw-bold">29</span>
          </div>
          <div class="text-center">
            <p class="card-text mb-50">قيد التنفيذ</p>
            <span class="font-large-1 fw-bold">29</span>
          </div>
          <div class="text-center">
            <p class="card-text mb-50">قيد التنفيذ</p>
            <span class="font-large-1 fw-bold">29</span>
          </div>
          <div class="text-center">
            <p class="card-text mb-50">قيد التنفيذ</p>
            <span class="font-large-1 fw-bold">29</span>
          </div>
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
          </div> --}}
          {{-- <div class="text-center">
            <p class="card-text mb-50">متوسط وقت التنفيذ</p>
            <span class="font-large-1 fw-bold">48d</span>
          </div> --}}
          {{-- <div class="text-center">
            <p class="card-text mb-50">أوامر عمل الطوارئ</p>
            <span class="font-large-1 fw-bold">--</span>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

  @push('page-script')
  
    <script>
    $(window).on('load', function () {
      var $trackBgColor = '#EBEBEB';
      var $strokeColor = '#ebe9f1';
      var $textHeadingColor = '#5e5873';
      var $white = '#fff';
      var $supportTrackerChart = document.querySelector('#emergency-review-chart');
      var supportTrackerChartValue =parseInt($('#emergency-review-chart').text()); 
      $('#emergency-review-chart').text('');
      var wChartOptions;

      wChartOptions = {
        chart: {
          height: 270,
          type: 'radialBar'
        },
        plotOptions: {
          radialBar: {
            size: 150,
            offsetY: 20,
            startAngle: -150,
            endAngle: 150,
            hollow: {
              size: '65%'
            },
            track: {
              background: $white,
              strokeWidth: '100%'
            },
            dataLabels: {
              name: {
                offsetY: -5,
                color: $textHeadingColor,
                fontSize: '1rem'
              },
              value: {
                offsetY: 15,
                color: $textHeadingColor,
                fontSize: '1.714rem'
              }
            }
          }
        },
        colors: [window.colors.solid.danger],
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: [window.colors.solid.primary],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          }
        },
        stroke: {
          dashArray: 8
        },
        series: [supportTrackerChartValue],
        labels: ['أوامر العمل المسلمة']
      };

      supportTrackerChart = new ApexCharts($supportTrackerChart, wChartOptions);
      supportTrackerChart.render();

  });
</script>
@endpush

@endif
