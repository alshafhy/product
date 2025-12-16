(function (window, undefined) {
  'use strict';


  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */
  $('.fileinput').fileinput()

})(window);

loadDataTablePage = function () {
  var start = $('#pagelist').find(':selected').data('start');
  
  var length = $('#pagelist').find(':selected').data('length');

  // load_data(start, length);

  var page_number = parseInt($('#pagelist').val());

  var test_table = $('.data-table').dataTable();

  test_table.fnPageChange(page_number);
};
