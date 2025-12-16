<?php

namespace App\DataTables;

// use App\Models\districts;
// use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class AppDataTable extends DataTable
{

    public $dataTableName = "";
    public $actionViewBlade = "";
    public $actionVisible = true;
    public $addIndexColumn = true;
    public $reportZoom = '100%';
    public $orderByArray = [[0, 'desc']];
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        if($dataTable->addIndexColumn()){
            $dataTable->addIndexColumn();
        }
        if($this->actionViewBlade){
            $dataTable->addColumn('action', $this->actionViewBlade);
        }

        if ($action = request()->get('action')) {
            if ($action == 'print' && $this->dataTableName) {
                request()->request->add(['reportTitle' => $this->dataTableName]);
                request()->request->add(['reportZoom' => $this->reportZoom]);
            }
        }

        if (request()->has('search.value') && request('search.value') && is_array(json_decode(request('search.value'), true))) {
            $dataTable->filter(function ($query) {
                $searchData=json_decode(request('search.value'), true) ;
                if(is_array($searchData) && count($searchData) > 0 && isset($searchData['searchData'])){
                    foreach ($searchData['searchData'] as $key => $value) {
                        if($value == 'null'){
                            $query->whereNull($key);
                        }else if($value){
                            $query->where($key , 'like', "%" . $value. "%");
                        }
                    }
                }
            });
        }

        return $dataTable;
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '50px', 'className'=>"text-center", 'printable' => false, "visible"=>$this->actionVisible, 'title' => __('crud.action')])
            ->parameters([
                "dom"=> 'Bflrtip',//Bfrtip
                "sPaginationType"=> "full_numbers",
                // "sDom" => '<""l>t<"F"fp>',
                'stateSave' => false,
                'pageLength'=> 15,
                // "scrollX"=> true,
                'lengthMenu'=> [5,10,15,20,30,50],// [[ 5, 15, 25, 100, -1 ], [ 5, 15, 25, 100, "All" ]]
                'order'     => $this->orderByArray ,

                // "orderColumn" =>['id', '-id $1'],
                'drawCallback' => 'function() {
                                    feather.replace({width: 14,height: 14});
                                    //console.log($("#pagelist" ).length);
                                    if( $(\'.data-table\').length !=0){
                                        if ($( "#pagelist" ).length == 0  ) {
                                            $(".dataTables_length").append(" / صفحة رقم<select onChange=\"loadDataTablePage() \" name=\"pagelist\" id=\"pagelist\" class=\"custom-select custom-select-sm form-control form-control-sm\"></select>");

                                           }


                                           var page_info = $(\'.data-table\').DataTable().page.info();

                                           $(\'#totalpages\').text(page_info.pages);

                                           var html = "";

                                           var start = 0;

                                           var length = page_info.length;

                                           for(var count = 1; count <= page_info.pages; count++)
                                           {
                                               var page_number = count - 1;

                                               html += \'<option value="\'+page_number+\'" data-start="\'+start+\'" data-length="\'+length+\'">\'+count+\'</option>\';

                                               start = start + page_info.length;
                                           }

                                           $(\'#pagelist\').html(html);

                                           $(\'#pagelist\').val(page_info.page);
                                    }


                                    }',
                // 'initComplete' => 'function() {  }',
                // 'responsive'=> 'true',
                // 'dom'=> "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",

                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-primary btn-sm no-corner',
                       'text' => '<i data-feather="plus"></i> ' .__('auth.app.create').'',
                       'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'

                    ],
                    // [
                    //     'extend' => 'pdfHtml5',
                    //     'className' => 'btn btn-primary btn-sm no-corner',
                    //     'text' => '<i data-feather="plus"></i> ' .__('auth.app.pdf').'',
                    //     // 'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                    //     'orientation'=>'landscape'

                    //  ],
                    //Button::make(['extend' => 'pdfHtml5', 'orientation' => 'landscape', 'text' => '<i class="fas fa-file-pdf"></i> ' . trans('global.app_pdf'), 'className' => 'btn-outline-info']),
                    // [
                    //    'extend' => 'export',
                    //    'className' => 'btn btn-primary btn-sm no-corner',
                    //    'text' => '<i data-feather="download"></i> ' .__('auth.app.export').'',
                    //    'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                    // ],
                    // [
                    //     'extend' => 'csv',
                    //     'className' => 'btn btn-primary btn-sm no-corner',
                    //     'text' => '<i data-feather="download"></i> ' .__('auth.app.export_csv').'',
                    //     'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                    // ],
                    // [
                    //     'extend' => 'pdf',
                    //     'className' => 'btn btn-primary btn-sm no-corner',
                    //     'text' => '<i data-feather="download"></i> ' .__('auth.app.export_pdf').'',
                    //     'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                    // ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-primary btn-sm no-corner',
                       'text' => '<i data-feather="printer"></i> ' .__('auth.app.print').'',
                       'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary");$(node).removeClass("buttons-print");}'
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-primary btn-sm no-corner',
                       'text' => '<i data-feather="refresh-cw"></i> ' .__('auth.app.reload').'',
                       'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                    ],
                    [
                        'extend' => 'reset',
                        'className' => 'btn btn-primary btn-sm no-corner',
                        'text' => '<i data-feather="repeat"></i> ' .__('auth.app.reset').'',
                        'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
                     ],
                ],
                 'language' => [
                    //    'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/Arabic.json'),
                    'processing'=> '<span >جارى التحميل</span></br><div class=" spinner-border text-primary" role="status">
                            <span class="visually-hidden">جارى التحميل</span>
                                </div>',
                    // "sProcessing"=>   "جارٍ التحميل...",
                    "sLengthMenu"=>   "أظهر _MENU_ سجلات",
                    "sZeroRecords"=>  "لم يعثر على أية سجلات",
                    "sInfo"=>         "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty"=>    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered"=> "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix"=>  "",
                    "sSearch"=>       "ابحث:",
                    // "sUrl"=>          "",
                    "oPaginate"=> [
                        "sFirst"=>    "الأول",
                        "sPrevious"=> "السابق",
                        "sNext"=>     "التالي",
                        "sLast"=>     "الأخير"
                    ]

                ],

            ]);
    }

    // /**
    //  * Get columns.
    //  *
    //  * @return array
    //  */
    // protected function getColumns()
    // {
    //     return [
    //         'name' => new Column(['title' => __('models/districts.fields.name'), 'data' => 'name'])
    //     ];
    // }

    // /**
    //  * Get filename for export.
    //  *
    //  * @return string
    //  */
    protected function filename(): string
    {
        return $this->dataTableName.'_datatable_' . time();
    }

    public function getIndexCol()
    {
        return  new Column([
            'defaultContent' => '',
            'data'           => 'DT_RowIndex',
            'name'           => 'DT_RowIndex',
            'title'          => __('index_short'),
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'width'          => "3%",
            'footer'         => '',
        ]);
    }
}
