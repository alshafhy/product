$(function() {
  console.log($('#status').val());
  if($('#status').val() == 7){
    $('#refuse_reason_div').show();
  }
});


$('#status').on('change', function() {
  if(this.value == 7){
    $('#refuse_reason_div').show();
  }
  else{
    $('#refuse_reason_div').hide();
  }
});



const routeName = 'workOrdersManagement/workOrdersPermitsExtensions';
const targetTable = 'extensions_table';
const modalName = 'extension';

const tableFields = [
  {
    "name": "id",
    "show_in_index": true
  },
  {
    "name": "sadad_number",
    "show_in_index": true
  },
  {
    "name": "from_date",
    "show_in_index": true
  },
  {
    "name": "to_date",
    "show_in_index": true
  },
  {
    "name": "amount",
    "show_in_index": true
  },
  {
    "name": "notes",
    "show_in_index": false
  }
];
  
$('#insert_form_test').on("submit", function (e) {
  e.preventDefault();
  // // paramters => this ,submit url , Fields that display in table,target table name of id of retravel table
  doSave(this, routeName, tableFields, targetTable , modalName,'data',true,"تم الحفظ بنجاح وجارى اعادة تحميل الصفحة");
});

$(document).on('click','.show_data', function (e) {
  e.preventDefault();
  doShow(this, routeName, tableFields, modalName)
});

$(document).on('click', '.edit_data', function (e) {
  e.preventDefault();
  doEdit(this, routeName, tableFields, modalName)
});

$('#edit_form_test').on("submit", function (e) {
  e.preventDefault();
  doUpdate(this, routeName, tableFields,modalName)
});

$(document).on('click', '.delete_data', function (e) {
  e.preventDefault();
  doDelete(this, routeName)
});


/***********************************************************************************
 * fines detail
 ************************************************************************************/

const detailName = 'fine'

const routeName_fine = 'workOrdersManagement/workOrdersPermitsFines';
const targetTable_fine = 'fines_table';
const modalName_fine = 'fine';

const tableFields_fine = [
  {
    "name": "id",
    "show_in_index": true
  },
  {
    "name": "sadad_number",
    "show_in_index": true
  },
  {
    "name": "issue_date",
    "show_in_index": true
  },
  {
    "name": "amount",
    "show_in_index": true
  },
  {
    "name": "fine_reason",
    "show_in_index": false
  },
  {
    "name": "notes",
    "show_in_index": false
  }
];
 

$('#add_'+modalName_fine+'_modal #insert_form_test').on("submit", function (e) {
  console.log('here fine 2 ');
  e.preventDefault();
  // doSave(this, routeName_fine, tableFields_fine, targetTable_fine)
  doSave(this, routeName_fine, tableFields_fine, targetTable_fine , modalName_fine,'data2');
});

// $('#fines_table_btns').closest('.show_data')
// $('#fines_table').parents("tbody").find(".show_data")
// $('tbody').parents("#fines_table_btns").find(".show_data").first()
// $('#fines_table_btns').find('.show_data')
// $("input", ".has_sub_span_field").on('click', function () {
// var next_span = $(this).parent().nextAll(".sub_span:first");

$(document).on('click', '.show_data2',function (e) {
  e.preventDefault();
  console.log('show fine here2');
  doShow(this, routeName_fine, tableFields_fine, modalName_fine)
});

$(document).on('click', '.edit_data2',function (e) {
  e.preventDefault();
  doEdit(this, routeName_fine, tableFields_fine, modalName_fine)
});

$('#edit_form_test2').on("submit", function (e) {
  e.preventDefault();
  doUpdate(this, routeName_fine, tableFields_fine, modalName_fine , targetTable_fine)
});

$(document).on('click', '.delete_data2',function (e) {
  e.preventDefault();
  doDelete(this, routeName_fine)
});
