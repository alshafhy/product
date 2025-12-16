<htmlpageheader name="MyHeader1">
    <div style="height: 140px"></div>
    <div style="height: 300px"></div>
    <div style="text-align: right; border-bottom: 1px solid #000000; font-weight: bold; font-size: 10pt;">My document
    </div>
</htmlpageheader>

<htmlpageheader name="MyHeader2">
    <div style="border-bottom: 1px solid #000000; font-weight: bold;  font-size: 10pt;">My document</div>
</htmlpageheader>

<htmlpagefooter name="MyFooter1">
    <table width="100%"
        style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
        <tr>
            <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
            <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right; ">My document</td>
        </tr>
    </table>
</htmlpagefooter>

<htmlpagefooter name="MyFooter2">
    <table width="100%"
        style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
        <tr>
            <td width="33%"><span style="font-weight: bold; font-style: italic;">My document</span></td>
            <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right; ">{DATE j-m-Y}</td>
        </tr>
    </table>
</htmlpagefooter>
<htmlpageheader name="page-header">
    <br>

    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
        style="border-collapse:collapse; font-size: 8px;">
        <tr>
            <td width="40%" class="ReportHeaderTextCenter">شركة تجريبيه المحدودة</td>
            <td rowspan="4" align="right" colspan="4">&nbsp;
                <center>
                    <img alt='logo_image' src='{{public_path("images/logo/logo-3.png")}}' height="85px" width="105px"
                        style="float:none;">
                </center>
            </td>
            <td width="40%" class="ReportHeaderTextCenter">رقم التقرير : {{$reportNumber}}</td>
        </tr>

        <tr>
            <td class="ReportHeaderTextCenter">الادارة / القسم : {{ session('current_department_name')}}</td>
            <td class="ReportHeaderTextCenter">{{$reportTitle}} </td>
        </tr>
        <tr>
            <td class="ReportHeaderTextCenter">اسم المستخدم : {{auth()->user()->name}}</td>
            <td class="ReportHeaderTextCenter">الوقت والتاريخ : {{$dateTime}} </td>
        </tr>
        <tr>
            <td class="ReportHeaderTextCenter">الفرع : {{ session('current_branch_name')}}</td>
            <td class="ReportHeaderTextCenter">صفحة رقم {PAGENO}</td>
        </tr>
        {{-- <tr>
            <td class="ReportHeaderTextCenter">رقم العقد</td>
            <td class="ReportHeaderTextCenter">عقد 2021</td>
        </tr>
        <tr>
            <td class="ReportHeaderTextCenter">التاريخ</td>
            <td class="ReportHeaderTextCenter">{{$dateTime}}</td>
        </tr> --}}
        {{-- <tr>
            <td class="ReportHeaderTextCenter">نوع الطلب</td>
            <td class="ReportHeaderTextCenter">---</td>
        </tr> --}}
    </table>
    {{-- <div style="height: 140px"></div>
    <div style="height: 300px"></div> --}}
</htmlpageheader>

{{-- <br><br><br><br> --}}
{{-- <br><br> --}}