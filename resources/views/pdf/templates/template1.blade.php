<html dir="rtl">
        <head>
        <style>
       
        body{
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
        .RowTitle
        { 
            color:#fff;
            font-family:{{$report['font_name']}};
            font-size:11px;
            font-weight:bold;
            padding:5px;
            text-align:right;
            /*background:cid:bar.png@adilla.com.sa;*/
            background-repeat:repeat;
            background-color:#cc6600;
            /*background-color:#993366;*/
        }

        td.label, td.title
        {
            color:#333333;
            font-family:{{$report['font_name']}};
            font-size:11px;
            padding:5px;
            text-align:center;
            background-color:#E9E9E9;
        }

        
        
        td.data, td.Text
        {
            color:#000;
            font-family:{{$report['font_name']}};
            font-size:11px;
            padding:5px;
        }
        
                
        td.TextRed
        {
            color:#F00;
            font-family:{{$report['font_name']}};
            font-size:11px;
            padding:5px;
            font-weight:bold; 
        }
        
        td.TextCenter
        {
            color:#000;
            font-family:{{$report['font_name']}};
            font-size:11px;
            padding:5px;
            text-align:center;
        }
        
        td.TextStart
        {
            color:#000;
            font-family:{{$report['font_name']}};
            font-size:11px;
            padding:5px;
            text-align:start;
        }
        
        #rowstbl tr:nth-child(even) {background: #EBEBEB}
        #rowstbl tr:nth-child(odd) {background: #FFF}

        </style>
        </head>
        <br />
    <body >

        <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
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
                <td width="15%" class="title">الإدارة المسلمة للطلب</td>
                <td width="35%" class="Text">{FROM_DEPT_NAME}</td>
                <td width="15%" class="title">الموظف المسلم للطلب</td>
                <td width="35%" class="Text">{FROM_PERSONAL_NAME}</td>
            </tr>
            <tr>
                <td width="15%" class="title">الإدارة المستلمة للطلب</td>
                <td width="35%" class="Text">{TO_DEPT_NAME}</td>
                <td width="15%" class="title">الموظف المستلم للطلب</td>
                <td width="35%" class="Text">{TO_PERSONAL_NAME}</td>
            </tr>
            <tr>
                <td width="15%" class="title">حالة الطلب</td>
                <td class="Text" colspan="3">{CHECK_STATUS_DESC}</td>
            </tr>
            <tr>
            <td colspan="4">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;" id="rowstbl">
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
        </table>

    </body>

</html>