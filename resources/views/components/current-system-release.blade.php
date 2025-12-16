<div>
    @if ($currentSystemRelease)
    <a href="{{route('systemReleasesShow')}}">
        الاصدار الحالى للنظام
         ({{$currentSystemRelease}}) 
      </a>
    @endif
</div>