<table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
    style="border-collapse:collapse; font-size: 8px;">
    <tr>
        <td width="40%" class="ReportHeaderTextCenter">شركة تجريبيه المحدودة</td>
        <td rowspan="4" align="right" colspan="4">&nbsp;
            <center>
                <img alt='logo_image' src='{{ public_path('images/logo/logo-3.png') }}' height="80px" width="100px"
                    style="float:none;">
            </center>
        </td>
        <td width="40%" class="ReportHeaderTextCenter">تقرير </td>
    </tr>

    <tr>
        <td class="ReportHeaderTextCenter">الادارة / القسم : {{ session('current_department_name') }}</td>
        <td class="ReportHeaderTextCenter">تقرير تفصيلى للتصريح</td>
    </tr>
    <tr>
        <td class="ReportHeaderTextCenter">اسم المستخدم : {{ auth()->user()->name }}</td>
        <td class="ReportHeaderTextCenter">الفرع : {{ session('current_branch_name') }}</td>
    </tr>
</table>