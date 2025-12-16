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
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="40%" class="TextCenter">شركة تجريبيه المحدودة</td>
            <td rowspan="4" align="right" colspan="4">&nbsp;
                <center>
                    <img alt='logo_image' src='{{public_path("images/logo/logo-3.png")}}' height="100" width="105"
                        style="float:left">
                </center>
            </td>
            <td width="40%" class="TextCenter">رقم التقرير : 562546</td>

        </tr>

        <tr>
            <td class="TextCenter">الادارة / القسم : ادارة التمديدات والحفر</td>
            <td class="TextCenter">تقرير متابعة أوامر العمل </td>
        </tr>
        <tr>
            <td class="TextCenter">اسم المستخدم : تامر يسرى عبده محمد عرفه</td>
            <td class="TextCenter">الوقت والتاريخ : </td>
        </tr>
        <tr>
            <td class="TextCenter">الفرع : الفرع الرئيسى</td>
            <td class="TextCenter">عدد الصفحات من 3 : 4</td>
        </tr>
        {{-- <tr>
            <td class="TextCenter">رقم العقد</td>
            <td class="TextCenter">عقد 2021</td>
        </tr>
        <tr>
            <td class="TextCenter">التاريخ</td>
            <td class="TextCenter">{{$dateTime}}</td>
        </tr> --}}
        {{-- <tr>
            <td class="TextCenter">نوع الطلب</td>
            <td class="TextCenter">---</td>
        </tr> --}}
    </table>

    <br>
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

        {{-- @foreach ($data['assayItem'] as $assayItem)
        <tr>
            <td class="TextCenter">{{$assayItem['item']['code']}}</td>
            <td class="TextCenter">{{$assayItem['item']['name']}} </td>
            <td class="TextCenter">{{$assayItem['item']['unit']['code']}}</td>
            <td class="TextCenter">{{$assayItem['used']}}</td>
            <td class="TextCenter">0</td>
            <td class="TextCenter">0.00</td>
        </tr>
        @endforeach
        @foreach ($data['assayService'] as $assayService)
        <tr>
            <td class="TextCenter">{{$assayService['service']['code']}}</td>
            <td class="TextCenter">{{$assayService['service']['name']}} </td>
            <td class="TextCenter">{{$assayService['service']['unit']['code']}}</td>
            <td class="TextCenter">{{$assayService['quantity']}}</td>
            <td class="TextCenter">{{number_format($assayService['service']['price'],2)}}</td>
            <td class="TextCenter">{{number_format($assayService['price'],2)}}</td>
        </tr>
        @endforeach --}}

        {{-- <tr>

            <td colspan="8" class="title">الإجمالي</td>
            <td class="title">2356326236</td>
        </tr> --}}
        {{-- <tr>
            <td class="title">الإدارة المسلمة للطلب</td>
            <td class="Text">{FROM_DEPT_NAME}</td>
            <td class="title">الموظف المسلم للطلب</td>
            <td class="Text">{FROM_PERSONAL_NAME}</td>
        </tr> --}}
    </table>
    <br><br><br>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="67%" class="Text">الاستشارى :
                {{$data['workOrder']['consultant']['name'] ?? ''}}
            </td>
            <td width="33%" class="Text">مندوب المقاول :
                شركة تجريبيه المحدودة
            </td>
        </tr>
        <tr>
            <td class="Text">الاسم :

            </td>
            <td class="Text">الاسم :
                م فياض عبد المعين قصاب
            </td>
        </tr>
        <tr>
            <td class="Text">التوقيع : </td>
            <td class="Text">التوقيع : </td>
        </tr>
        <tr>
            <td colspan="2" class="TextCenter">
                مشرف الشركة السعودية للكهرباء
            </td>
        </tr>
        <tr>
            <td colspan="2" class="Text">الاسم : </td>
        </tr>
        <tr>
            <td colspan="2" class="Text">التوقيع : </td>
        </tr>
    </table>

    {{-- <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td align="right" colspan="4">&nbsp;<center>
                    <IMG src="cid:Headernew.png@adilla.com.sa" ALT="adilla_logo">
                    <!--<IMG src="Headernew.png" ALT="adilla_logo">-->
                </center>
            </td>
        </tr>
        <tr>
            <td align="right" class="RowTitle" colspan="4">أوامر الطلبات من المستودعات</td>
        </tr>
        <tr>
            <td width="15%" class="title">السنة / رقم الطلب</td>
            <td width="35%" class="Text">{YEAR} / {REQUEST_NO}</td>
            <td width="15%" class="title">التاريخ</td>
            <td width="35%" class="Text">{REQUEST_DATE}</td>
        </tr>
        <tr>
            <td class="title">الإدارة المسلمة للطلب</td>
            <td class="Text">{FROM_DEPT_NAME}</td>
            <td class="title">الموظف المسلم للطلب</td>
            <td class="Text">{FROM_PERSONAL_NAME}</td>
        </tr>
        <tr>
            <td class="title">الإدارة المستلمة للطلب</td>
            <td class="Text">{TO_DEPT_NAME}</td>
            <td class="title">الموظف المستلم للطلب</td>
            <td class="Text">{TO_PERSONAL_NAME}</td>
        </tr>
        <tr>
            <td class="title">حالة الطلب</td>
            <td class="Text" colspan="3">{CHECK_STATUS_DESC}</td>
        </tr>
        <tr>
            <td colspan="4">
                <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
                    style="border-collapse:collapse;" id="rowstbl">
                    <tr>
                        <td align="right" class="RowTitle" colspan="5">قائمة بطلبات الاصناف</td>
                    </tr>
                    <tr>
                        <td width="5%" class="title">رقم البند</td>
                        <td width="20%" class="title" style="color:red;">رقم الباركود</td>
                        <td width="30%" class="title">الصنف</td>
                        <td width="15%" class="title">العدد</td>
                        <td width="30%" class="title">ملاحظات</td>
                    </tr>
                    {TABLE_ROWS}
                    <tr>
                        <td class="TextCenter"><span class="Text">{T_ROWNUM}</span></td>
                        <td class="TextCenter" style="color:red;"><span class="Text">{ADILLA_BAR_CODE}</span></td>
                        <td class="TextCenter"><span class="Text">{ITEM_NAME}</span></td>
                        <td class="TextCenter"><span class="Text">{QUANTITY}</span></td>
                        <td class="TextCenter"><span class="Text">{REMARK}</span></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="RowTitle">
                &nbsp; ملاحظات
            </td>
        </tr>
        <tr>
            <td colspan="4" class="Text">
                - تم إرسال هذه الرسالة تلقائياً من النظام الآلي للمستودعات </td>
        </tr>
        </tr>
    </table> --}}

</body>

</html>