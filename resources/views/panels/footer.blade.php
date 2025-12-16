<!-- BEGIN: Footer-->
<footer
  class="footer footer-light {{($configData['footerType'] === 'footer-hidden') ? 'd-none' : ''}} {{$configData['footerType']}}">
  <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">حقوق الملكية الفكرية &copy;
      <script>document.write(new Date().getFullYear())</script><a class="ms-25" href="#" target="_blank">شركة
        تجريبيه</a>,
      <span class="d-none d-sm-inline-block">[جميع الحقوق محفوظة ]</span>
    </span>
    <span class="float-md-end d-none d-md-block"><x-today-date /><i data-feather="heart"></i></span>
    {{-- <span class="float-md-end d-none d-md-block"><x-today-date /></span> --}}
  </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->