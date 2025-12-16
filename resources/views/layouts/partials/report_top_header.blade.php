<htmlpageheader name="page-header">
    <br>

    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
        style="border-collapse:collapse; font-size: 8px;">
        <tr>
            <td width="40%" class="ReportHeaderTextCenter">شركة تجريبيه المحدودة</td>
            <td rowspan="4" align="right" colspan="4">&nbsp;
                <center>
                    <img alt='logo_image' src='{{public_path("images/logo/logo-3.png")}}' height="80px" width="100px"
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
            <td class="ReportHeaderTextCenter">الفرع : {{ session('current_branch_name')}}</td>
        </tr>
        {{-- <tr>
            <td class="ReportHeaderTextCenter">الفرع : {{ session('current_branch_name')}}</td>
            <td class="ReportHeaderTextCenter">صفحة رقم {PAGENO}</td>
        </tr> --}}
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
</htmlpageheader>

<br><br><br><br>
{{-- <br><br> --}}