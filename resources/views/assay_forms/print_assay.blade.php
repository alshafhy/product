<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
    * {
            margin: 0;
            padding: 0;
            text-indent: 0;
            direction: rtl;
            font-family: {{$report['font_name']}}/*Calibri, sans-serif;*/
            color: black;
            font-size: 14pt;
        }
        body{
            font-family: {{$report['font_name']}};
            color: black;
            font-size: {{$report['font_size']}}pt;
            /* font-weight: bold; */
            font-style: normal;
            text-decoration: none;
            text-indent: 0pt;
            line-height: 13pt;
        }
        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
        }
        .str-small {
            font-size: 11pt;
        }
        .str-xsmall {
            font-size: 9pt;
        }
        .center{
            text-align: center;
            line-height: 15pt;
        }
        .left{
            text-align: left;
            line-height: 15pt;
        }
        .checkbox {
            width: 20px;
            text-align: left;
        }
        .light_green{
            background-color: #E1EED9;
        }
        .dark_green{
            background-color: #27757A;
            color: #FFF;
        }
        .table-borderd {
            width: 100%;
            border-collapse: collapse;
        }
        .table-borderd td, .table-borderd th{
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-borderd-none {
            border-style: none;
        }
        .table-borderd-none td, .table-borderd-none th{
            border-style: none;
        }
        
        .border-none{
            border-style: none;
        }
        .pr-5{
            padding-right: 5pt;
        }
        .w278{
            width:278pt;
        }
        .w303{
            width:303pt;
        }
        .w580{
            width:580pt;
        }
        .w25{
            width: 25%;
        }
        .w150{
            width: 150px;
        }
        .w82{
            width: 82px;
        }
        .w95{
            width: 95px;
        }
        .w76{
            width: 76px;
        }
        .w81{
            width: 150px;
        }
        .h33{
            height:33pt
        }
        .h61{
            height:61pt;
        }


       /**reportPageHeaderAndFooter.blade.php**/
        .borderless{
            border: 0px;
        }
        .normal_table_h {
            font-family: {{$report['font_name']}};
            border-collapse: collapse;
            width: 100%;
        }
        
        .normal_table_h td, .normal_table_h th {
            padding: 2px;
        }
        
        .normal_table_h td, .normal_table_h th {
            border: 0px ;
        }
    
        .normal_table_h th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            /*background-color: #4CAF50;*/
            background-color: {{$report['title_background_color']}};
            color: white;
        }
    
       
        
        /* .icon {
            display: inline-block;
            width: 22px; height: 22px;
            border-radius: 5%;
            transform: rotate(45deg);
        }
        .icon::before, .icon::after { position: absolute; content: ''; background-color: #fff; }
        .icon.icon-success          { background: green; }
        .icon.icon-success:before   { width:  3px; height:  9px; top:  6px; left: 11px; }
        .icon.icon-success:after    { width:  3px; height:  3px; top: 12px; left:  8px; }
        .icon.icon-failure          { background: lightcoral; }
        .icon.icon-failure::before  { width:  3px; height: 12px; top:  5px; left: 10px; }
        .icon.icon-failure::after   { width: 12px; height:  3px; top: 10px; left:  5px; } */
        /* page 4 */
        .border-bottom{
            border-bottom: 1px solid black;
        }
        .v-top{
            vertical-align: text-top;
        }
        .ul-dash {
            list-style-type: '-';
        }

        /* page 6*/
        .w50{
            width: 50%;
        }

        /* page 7 */
        .w16-6{
            width: 16.66%;
        }
        .red{
            background: #C00000;
            color: #FFFFFF;
        }

    </style>

        <style>
            @page {
                /* background-color:#E6E6E6; */
                margin-header: 1%;
                margin-footer: 1%;
                margin-top: 33mm;
                header: page-header;
                footer: MyFooter1;
            }
        </style>

</head>
<body>
    <div style="font-weight: bold;" > بسم الله الرحمن الرحيم</div>
    بسم الله الرحمن الرحيم


    

</body>
</html>