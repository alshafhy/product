<script>
const fields = [
                "id",
                "sadad_number",
                "amount" , 
                "from_date" ,
                "to_date" , 
                "notes"
                ];

//ajax insert
$('#insert_form').on("submit", function(event){
    event.preventDefault();
    var formData = new FormData(this);

   $.ajax({
    url:"{{route('workOrdersPermitsExtensions.store')}}",
    method:"post",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(res){
    // this.reset();

     $('#add_extension_modal').modal('hide');
     
     let resp = res[0] ;

     feather.replace();

     $('#extensions_table').append("<tr id='tr"+resp.id+"'>\
                                    <th scope='row'>"+resp.id+"</th>\
                                    <th scope='row'>"+resp.id+"</th>\
                                    <td>"+resp.sadad_number+"</td>\
                                    <td>"+resp.from_date+"</td>\
                                    <td>"+resp.to_date+"</td>\
                                    <td>"+resp.amount+"</td>\
                                    <td>\
                                        <div class='btn-group'>\
                                            <a href='#' id='showId"+resp.id+"' class='btn btn-outline-primary btn-sm'>\
                                                <i data-feather='eye'></i>\
                                            </a>\
                                            <a href='#' id='editId"+resp.id+"' class='btn btn-outline-warning btn-sm'>\
                                                <i data-feather='edit'></i>\
                                            </a>\
                                            <a href='#' class='btn btn-outline-danger btn-sm'>\
                                                <i data-feather='trash'></i>\
                                            </a>\
                                        </div>\
                                    </td>\
                                </tr>");

    feather.replace();
    
     $('#tr'+res.id).attr("class", "table-warning");

     sweetAlert('تمت العملية بنجاح');
     console.log(res);
   },
   error: function(xhr, status, error) {
        $.each(xhr.responseJSON.errors, function (key, item)
        {
            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
        });
    }
   });
});


//ajax show
$('.show_data').on('click', function(event){
 event.preventDefault();
 
 $('.modal-body,.modal-footer').hide();
 $('.spinner-border').show();

 var id = $(this).attr("id").replace("showId", "");

 $('#show_extension_modal').modal('show');

 var url  = "{{route('workOrdersPermitsExtensions.show','showId')}}".replace("showId", id);
 $.ajax({
  url:url,
  method:"GET",
  success:function(res){
    fields.forEach(function(item) {
      $("#show_extension_modal #"+item).html(res[item]);
    });
    
    $('.spinner-border').hide();
    $('.modal-body,.modal-footer').show();
  }
 });
});


 //ajax edit
 $('.edit_data').on('click', function(event){
  event.preventDefault();
  $('.modal-body,.modal-footer').hide();
  $('.spinner-border').show();

  var id = $(this).attr("id").replace("editId", "");
  
  $('#edit_extension_modal').modal('show');

  var url  = "{{route('workOrdersPermitsExtensions.edit','editId')}}".replace("editId", id);
  $.ajax({
      url:url,
      method:"GET",
      success:function(res){
        fields.forEach(function(item) {
          $("input[name="+item+"],textarea[name="+item+"]").val(res[item]);
        });

        $('#extension_id').val(res.id);
        
        $('.spinner-border').hide();
        $('.modal-body,.modal-footer').show();
      
      }
    });
  });


//ajax update
$('#edit_form').on("submit", function(event){
  event.preventDefault();
  var formData = new FormData(this);

  var id = $('#detail_id').val();
  
  console.log('update here => ' +id );
  
  $.ajax({
    url:"{{route('workOrdersPermitsExtensions.update','editId')}}".replace("editId", id),
    method:"post",
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(res){
      $('#edit_extension_modal').modal('hide');

      fields.forEach(function(item) {
        $("#show_extension_modal #"+item).html(res[item]);
        $('#'+item+id).html(res[item]);
      });

      $('#tr'+res.id).attr("class", "table-warning");

      sweetAlert('تمت العملية بنجاح');
      console.log(res);
    },
    error: function (res, textStatus, errorThrown) {
        console.log(res);
    }
  });
});



function deleteIt(id){
  var id = id.replace("#deleteId", "");

  console.log("delete here => "+id);
  
  $.ajax({
   url:"{{route('workOrdersPermitsExtensions.destroy','deleteId')}}".replace("deleteId", id),
   method:"POST",
   data:{"_method": "DELETE","_token": "{{ csrf_token() }}","id": id},
   success:function(res){
    $('#tr'+res.id).attr("class", "table-warning");
    
    $('#tr'+id).attr("style", "background-color: rgb(181 37 37 / 15%);");
    $('#tr'+id).fadeOut(1000);
    
    if(res.status==true){
      $('#success-msg').removeClass("d-none");
      $('#success-msg').html(res.msg);
    }
    console.log(res);
  },
   error: function (res, textStatus, errorThrown) {
     if(res.status==false){
       $('#danger-msg').removeClass("d-none");
       $('#danger-msg').html(res.msg);
     }
       console.log(res);
   }
  });

}

// TODO: put it in global
function sweetConfirmDelete(targetID , action){
  event.preventDefault();

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      if(action == 'submit'){
        $("#"+targetID).submit();
      } else{
        deleteIt("#"+targetID);
      }
    }
    else {
      Swal.fire('إلغاء', 'تم الغاء العملية', 'error');
    }
  });

}

// TODO: put it in global
function sweetAlert(msg){
  Swal.fire(
    msg,
    '',
    'warning'
  );
}

</script>


