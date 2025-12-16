<html dir="rtl">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
            font-size: 14pt;
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
            text-indent: 0pt;
            line-height: 13pt;
            /* margin-left: 30px;  */
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .RowTitle {
            color: #fff;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            font-weight: bold;
            padding: 5px;
            text-align: right;
            /*background:cid:bar.png@adilla.com.sa;*/
            background-repeat: repeat;
            background-color: #cc6600;
            /*background-color:#993366;*/
        }

        td.label,
        td.title {
            color: #333333;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            padding: 5px;
            text-align: center;
            background-color: #E9E9E9;
        }



        td.data,
        td.Text {
            color: #000;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            padding: 5px;
        }


        td.TextRed {
            color: #F00;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            padding: 5px;
            font-weight: bold;
        }

        td.TextCenter {
            color: #000;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            padding: 5px;
            text-align: center;
        }

        td.TextStart {
            color: #000;
            font-family: {{$report['font_name']}};
            font-size: 13px;
            padding: 5px;
            text-align: start;
        }

        .vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        #rowstbl tr:nth-child(even) {
            background: #EBEBEB
        }

        #rowstbl tr:nth-child(odd) {
            background: #FFF
        }
    </style>
</head>
<br />

<body>
    <htmlpageheader name="page-header">
        <br>

        <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
            <tr>
                <td width="40%" class="TextCenter">شركة تجريبيه المحدودة</td>
                <td rowspan="4" align="right" colspan="4">&nbsp;
                    <center>
                        <img alt='logo_image' src='{{public_path("images/logo/logo-3.png")}}' height="85px"
                            width="105px" style="float:none;">
                    </center>
                </td>
                <td width="40%" class="TextCenter">رقم التقرير : 562546</td>

            </tr>
            <tr>
                <td class="TextCenter">الادارة / القسم : {{ session('current_department_name')}}</td>
                <td class="TextCenter">تقرير متابعة أوامر العمل </td>
            </tr>
            <tr>
                <td class="TextCenter">اسم المستخدم : {{auth()->user()->name}}</td>
                <td class="TextCenter">الوقت والتاريخ : {{$dateTime}} </td>
            </tr>
            <tr>
                <td class="TextCenter">الفرع : {{ session('current_branch_name')}}</td>
                <td class="TextCenter">صفحة رقم {PAGENO}</td>
            </tr>
        </table>
    </htmlpageheader>

    <br><br><br><br><br> <br><br>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="12%" class="title">رقم أمر العمل</td>
            <td width="10%" class="title">نوع العمل</td>
            <td width="10%" class="title">تاريخ الاستلام</td>
            <td width="10%" class="title">الادارة المسئولة الحالية</td>
            <td width="7%" class="title">مدة العمل</td>
            <td width="10%" class="title">الحالة</td>
            <td width="7%" class="title">مقايسة</td>
            <td width="7%" class="title">شهادة انجاز</td>
            <td width="7%" class="title">مستخلص</td>
        </tr>
        <tr>
            <td class="TextCenter">908111006</td>
            <td class="TextCenter">802 </td>
            <td class="TextCenter">M</td>
            <td class="TextCenter">154</td>
            <td class="TextCenter">0</td>
            <td class="TextCenter">0.00</td>
            <td class="TextCenter">لا</td>
            <td class="TextCenter">لا</td>
            <td class="TextCenter">لا</td>
        </tr>
        <tr>
            <td class="TextCenter">301010105</td>
            <td class="TextCenter">402 </td>
            <td class="TextCenter">M</td>
            <td class="TextCenter">1.6</td>
            <td class="TextCenter">54</td>
            <td class="TextCenter">982511.40</td>
            <td class="TextCenter">لا</td>
            <td class="TextCenter">لا</td>
            <td class="TextCenter">لا</td>
        </tr>
    </table>
    <br><br><br>

    <htmlpagefooter name="page-footer">
        {{-- {PAGENO} --}}
    </htmlpagefooter>
</body>

</html>