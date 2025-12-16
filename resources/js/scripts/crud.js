/*=========================================================================================
    File Name: crud.js
    Description: Crud js file
    ----------------------------------------------------------------------------------------
    Item Name: Crud
    Author: Tamer
    Author URL: Tamer
==========================================================================================*/

function doSave(el,url,tableFields,targetTableName,modalName,class_name,redirectBack=false,message="") {
    var formData = new FormData(el);

    //console.log('do save 4');
    var current_url      = window.location.href;
    //console.log(url);
    $.ajax({
        method: "post",
        url: `${BASE_URL}/${url}`,
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (res) {
            el.reset();
            let modalId = $(el).closest('.modal').attr('id');
            $('#' + modalId).modal('hide');

            let resp = res[0];
            let $table = $('#'+targetTableName);
            let row_count = $table.find('tr').length+1;
            $('#'+targetTableName+' > tr').removeClass('table-warning');

            $table.append(autoAppendTableFields(tableFields,url, modalName , resp , url, row_count,class_name));
            feather.replace();

            $('#tr' + resp.id).attr("class", "table-warning");
            if(message){
                sweetAlert(message);
            }else{
                sweetAlert('تمت العملية بنجاح');
            }
            // console.log(res);
            if(redirectBack) {
                setTimeout(() => { 
                    window.location = current_url  ;
                }, 2000);
            } 
                
        },
        error: function (xhr, status, error) {
            $("#" +modalName+ "_errors").html('');
            if (status == 422 || xhr.status == 422) {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    $("#" +modalName+ "_errors").append("<li class='alert alert-danger'>" + item + "</li>");
                });
            }
            else {
                $("#" +modalName+ "_errors").append("<li class='alert alert-danger'>" + xhr.responseJSON.message + "</li>");
            }

        }
    });

}


function autoAppendTableFields(tableFields, routeName , modalName , result , url, row_count,class_name) {
    let row = "";

    row += "<tr id='tr" + result.id + "'>";
    row += "<th scope='row'>" + row_count + "</th>";
    tableFields.forEach(function (item) {
        if (item.show_in_index) {
            row += " <td id='"+item.name+"_"+result.id+"'>" + result[item.name] + "</td>";
        }
    });

    row += "<td>\
            <div class='btn-group'>\
              <a href='#' id='showId"+ result.id + "' class='btn btn-outline-primary btn-sm show_"+class_name+"'>\
                    <i data-feather='eye'></i>\
                </a>\
                <a href='#' id='editId"+ result.id + "' class='btn btn-outline-warning btn-sm edit_"+class_name+"'>\
                    <i data-feather='edit'></i>\
                </a>\
                <a href='#' class='btn btn-outline-danger btn-sm delete_"+class_name+"'>\
                    <i data-feather='trash'></i>\
                </a>\
            </div>\
        </td>\
        </tr>"
    return row;
}


function doShow(el, url,tableFields,modalName) {
    console.log('show here ' + modalName);

    $('.modal-body,.modal-footer').hide();
    $('.spinner-border').show();

    $('#show_'+modalName+'_modal').modal('show');

    var id = $(el).attr('id').replace("showId", "");

    $.ajax({
        url:`${BASE_URL}/${url}/${id}`,
        method:"GET",
        success:function(res){
            tableFields.forEach(function(item) {
                var itemName = item.name ;
                $('#show_'+modalName+'_modal #'+itemName).html(res[itemName]);
            });

            $('.spinner-border').hide();
            $('.modal-body,.modal-footer').show();
        }
    });
}


function doEdit(el, url, tableFields, modalName) {
    $('.modal-body,.modal-footer').hide();
    $('.spinner-border').show();

    $('#edit_' + modalName + '_modal').modal('show');

    var id = $(el).attr('id').replace("editId", "");
    console.log("edit id = " + id);

    $.ajax({
        url: `${BASE_URL}/${url}/${id}?action=edit`,
        method: "GET",
        success: function (res) {
            //console.dir(res);
            tableFields.forEach(function (item) {
                var itemName = item.name;
                $("input[name=" + itemName + "],textarea[name=" + itemName + "]").val(res[itemName]);
                $("select[name=" + itemName + "]").val(res[itemName]).trigger('change')/*.prepend("<option selected value="+res[itemName]+">"+res[itemName]+"</option>")*/;
            });

            $('.spinner-border').hide();
            $('.modal-body,.modal-footer').show();
        }
    });
}


function doUpdate(el, url, tableFields, modalName , targetTableName) {
    var formData = new FormData(el);

    var id = $('#detail_id').val();
    console.log("update id = " + id);

    $.ajax({
        url: `${BASE_URL}/${url}/${id}`,
        method: "post",
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (res) {
            tableFields.forEach(function (item) {
                var itemName = item.name;
                $('#' + itemName + id).html(res[itemName]);
            });

            $('#edit_' + modalName + '_modal').modal('hide');

            $('#'+targetTableName+' > tbody > #tr'+res.id).attr("class", "table-warning");
            sweetAlert('تمت العملية بنجاح');
            console.log(res);
        },
        error: function (xhr, status, error) {
            if (status == 422 || xhr.status == 422) {
                // console.log('error here update2');
                $("#" +modalName+ "_edit_errors").html('');
                $.each(xhr.responseJSON.errors, function (key, item) {
                    // console.log('item: ' + item);
                    $("#" +modalName+ "_edit_errors").append("<li class='alert alert-danger'>" + item + "</li>");
                });
            }
            else {
                $("#" +modalName+ "_edit_errors").append("<li class='alert alert-danger'>" + xhr.responseJSON.message + "</li>");
            }

        }
    });
}


function doDelete(el, url) {
    var elementId = el.id;
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "تأكيد المسح!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، أريد المسح',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            deleteIt("#" + elementId, url);
        }
        else {
            Swal.fire('إلغاء', 'تم الغاء العملية', 'error');
        }
    });
}


function deleteIt(id , url) {
    var id = id.replace("#deleteId", "");
    console.log("delete here => "+id);

    console.log("token = " + csrf_token);

    $.ajax({
        url: `${BASE_URL}/${url}/${id}`,
        method: "post",
        data: { "_method": "DELETE", "_token": csrf_token, "id": id },
        success: function (res) {
            $('#tr' + res.id).attr("class", "table-warning");
            $('#tr' + id).attr("style", "background-color: rgb(181 37 37 / 15%);");
            $('#tr' + id).fadeOut(1000);

            if (res.status == true) {
                $('#success-msg').removeClass("d-none");
                $('#success-msg').html(res.msg);
            }
        },
        error: function (res, textStatus, errorThrown) {
            if (res.status == false) {
                $('#danger-msg').removeClass("d-none");
                $('#danger-msg').html(res.msg);
            }
            console.log(res);
        }
    });
}


function sweetAlert(msg){
    Swal.fire(
        msg,
        '',
        'warning'
    );
}

$('.modal').on('hidden.bs.modal', function () {
    $('.modal')
        .find("input:not([type=hidden]),textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    $('.error').html('');
});
