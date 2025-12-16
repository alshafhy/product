$(function() {
  $("#div_emps").hide();
  $("#div_conts").hide();
  $("#note_div").hide();
});


$('.layer_worker_type').on('change', function() {
    //console.dir($(this).val());
  if($(this).val() == 1){
    $("#div_emps").hide();
    $('#div_conts').show();
    $("#e_div_emps").hide();
    $('#e_div_conts').show();
  }
  else if($(this).val() == 2){
    $("#div_conts").hide();
    $('#div_emps').show();
    $("#e_div_conts").hide();
    $('#e_div_emps').show();
  }
  else{
    $("#div_emps").hide();
    $("#div_conts").hide();
    $("#e_div_emps").hide();
    $("#e_div_conts").hide();
  }
});


$('.lab_result_status').on('change', function() {
    //console.dir($(this).val());
  if($(this).val() == 1){
    $("#note_div").hide();
    $('#e_note_div').hide();
  }
  else if($(this).val() == 2){
    $("#note_div").show();
    $('#e_note_div').show();
  }
  else{
    $("#note_div").hide();
    $("#e_note_div").hide();
  }
});

$('#edit_layer_modal').on('show.bs.modal', function () {
    //console.dir($('#layer_worker_type').val());
    if($('#layer_worker_type').val() == '1'){
        $("#e_div_emps").hide();
        $('#e_div_conts').show();
    }else {
        $("#e_div_conts").hide();
        $('#e_div_emps').show();
    }
    if($('#lab_result_status').val() == '1'){
        $('#e_note_div').show();
    }else {
        $("#e_note_div").hide();
    }
});

$('.modal').on('hidden.bs.modal', function () {
    $('.modal')
        .find("input:not([type=hidden]),textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    $("#div_emps").hide();
    $("#div_conts").hide();
});

const routeName = 'restablishWorkOrders/landLayers';
const targetTable = 'layers_table';
const modalName = 'layer';

const tableFields = [
  {
    "name": "id",
    "show_in_index": false
  },
  {
    "name": "layer_id",
    "show_in_index": true
  },
  {
    "name": "layer_employee_id",
    "show_in_index": false
  },
  {
    "name": "layer_contractor_id",
    "show_in_index": false
  },
  {
    "name": "start_date",
    "show_in_index": true
  },
  {
    "name": "layer_worker_type",
    "show_in_index": true
  },
  {
    "name": "lab_id",
    "show_in_index": false
  },
  {
    "name": "lab_result_status",
    "show_in_index": true
  },
  {
    "name": "worker",
    "show_in_index": false
  },
  {
    "name": "note",
    "show_in_index": true
  }
];
  
$('#insert_form_test').on("submit", function (e) {
  e.preventDefault();
  doSave(this, routeName, tableFields, targetTable, modalName, "data");
  //console.log('here new');
});
$(document).on('click', '.show_data', function (e) {
  e.preventDefault();
  doShow(this, routeName, tableFields, modalName);
});

$(document).on('click', '.edit_data', function (e) {
  e.preventDefault();
  doEdit(this, routeName, tableFields, modalName);
});

$(document).on('submit', '#edit_form_test', function (e) {
  e.preventDefault();
  doUpdate(this, routeName, tableFields,modalName);
});

$(document).on('click', '.delete_data', function (e) {
  e.preventDefault();
  doDelete(this, routeName);
});

$(document).on('click', '.delete_history', function (e) {
  e.preventDefault();
  doDelete(this, "restablishWorkOrders/delete_history");
});
