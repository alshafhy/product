const routeName = 'stores/assayService';
const targetTable = 'services_table';
const modalName = 'services';

const tableFields = [
  {
    "name": "id",
    "show_in_index": false
  },
  {
    "name": "assay_form_id",
    "show_in_index": false
  },
  {
    "name": "service_name",
    "show_in_index": true
  },
  {
    "name": "service_code",
    "show_in_index": true
  },
  {
    "name": "service_id",
    "show_in_index": false
  },
  {
    "name": "quantity",
    "show_in_index": true
  },
  {
    "name": "service_price",
    "show_in_index": true
  },
  {
    "name": "price",
    "show_in_index": true
  }
];



$('.modal').on('hidden.bs.modal', function () {
    $('.modal')
        .find("input:not([type=hidden]),textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
});
  
$('#insert_form_test').on("submit", function (e) {
  e.preventDefault();
  // paramters => this ,submit url , Fields that display in table,target table name of id of retravel table
  doSave(this, routeName, tableFields, targetTable,modalName,"data");
  services_title();
});

$(document).on('click', '.show_data', function (e) {
  e.preventDefault();
  doShow(this, routeName, tableFields, modalName);
});

$(document).on('click', '.edit_data', function (e) {
  e.preventDefault();
  doEdit(this, routeName, tableFields, modalName);
});

$('#edit_form_test').on("submit", function (e) {
  e.preventDefault();
  doUpdate(this, routeName, tableFields,modalName);
  services_title();
});

$(document).on('click','.delete_data', function (e) {
  e.preventDefault();
  doDelete(this, routeName)
});
function services_title() {
    let total_price = 0;
    $("td[id*='price']").each(function () {
        if ($(this).attr('id').indexOf("service_price") == -1) {
            console.dir($(this).attr('id'));
            let value = parseInt($(this).text().trim().replace(',',''));
            if (!isNaN(value)) {
                total_price += value;
            }
        }
    });
    $('#total_service_price').html(total_price.toLocaleString(
        undefined, // leave undefined to use the visitor's browser
        // locale or a string like 'en-US' to override it.
        { minimumFractionDigits: 0 }
    ));
}

/***********************************************************************************
 * Items detail
 ************************************************************************************/

const detailName = 'item';

const routeName_item = 'stores/assayItem';
const targetTable_item = 'items_table';
const modalName_item = 'item';

const tableFields_item = [
  {
    "name": "id",
    "show_in_index": false
  },
  {
    "name": "item_id",
    "show_in_index": false
  },
  {
    "name": "item_name",
    "show_in_index": true
  },
  {
    "name": "item_code",
    "show_in_index": true
  },
  {
    "name": "spend",
    "show_in_index": true
  },
  {
    "name": "used",
    "show_in_index": true
  },
  {
    "name": "returned",
    "show_in_index": true
  },
  {
    "name": "returned_spend",
    "show_in_index": true
  }
];
 

$('#add_'+modalName_item+'_modal #insert_form_test').on("submit", function (e) {
  e.preventDefault();
  doSave(this, routeName_item, tableFields_item, targetTable_item,modalName_item, 'data2')
});

$(document).on('click', '.show_data2', function (e) {
  e.preventDefault();
  doShow(this, routeName_item, tableFields_item, modalName_item)
});

$(document).on('click', '.edit_data2', function (e) {
  e.preventDefault();
  doEdit(this, routeName_item, tableFields_item, modalName_item)
});

$('#edit_form_test2').on("submit", function (e) {
  e.preventDefault();
  doUpdate(this, routeName_item, tableFields_item, modalName_item , targetTable_item)
});

$(document).on('click', '.delete_data2', function (e) {
  e.preventDefault();
  doDelete(this, routeName_item)
});
