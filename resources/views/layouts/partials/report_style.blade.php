<style>
       
    body{
        font-family:{{$reportSettings['font_name']}};
        color: black;
        font-size: {{$reportSettings['font_size']}}pt;
        font-weight: bold;
        font-style: normal;
        text-decoration: none;
        text-indent: 0pt;
        line-height: 13pt;
        /* margin-left: 30px;  */
    }
    @page {
        /* header: html_page-header; */
        footer: html_page-footer;
    }
    /* @page {
      size: auto;
      odd-header-name: html_page-header;
       odd-footer-name: html_MyFooter1; 
    } */
    @page :first {
    header: html_page-header;
}

    @page chapter2 {
        odd-header-name: html_MyHeader2;
        odd-footer-name: html_MyFooter2;
    }

    @page noheader {
        odd-header-name: _blank;
        odd-footer-name: _blank;
    }

    div.chapter2 {
        page-break-before: always;
        page: chapter2;
    }

    div.noheader {
        page-break-before: always;
        page: noheader;
    }
    .RowTitle
    { 
        color:#fff;
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
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
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
        padding:5px;
        text-align:center;
        background-color:#E9E9E9;
    }

    
    
    td.data, td.Text
    {
        color:#000;
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
        padding:5px;
    }
    
            
    td.TextRed
    {
        color:#F00;
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
        padding:5px;
        font-weight:bold; 
    }
    
    td.TextCenter
    {
        color:#000;
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
        padding:5px;
        text-align:center;
    }

    td.ReportHeaderTextCenter
    {
        color:#000;
        font-family:{{$reportSettings['font_name']}};
        font-size:10px;
        padding:5px;
        text-align:center;
    }
    
    td.TextStart
    {
        color:#000;
        font-family:{{$reportSettings['font_name']}};
        font-size:{{$reportSettings['font_size']}}px;
        padding:5px;
        text-align:start;
    }
    .vertical{
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }
    
    #rowstbl tr:nth-child(even) {background: #EBEBEB}
    #rowstbl tr:nth-child(odd) {background: #FFF}

    </style>