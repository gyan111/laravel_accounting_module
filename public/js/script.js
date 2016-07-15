$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var locale = $('meta[name="locale"]').attr('content');

$(function() {
    $( ".datepicker" ).datepicker({
    	  changeMonth: true,
      	changeYear: true,
      	dateFormat: 'dd-mm-yy'
    });

	$('#account-table').DataTable({
 		"columnDefs": [
  			{ "orderable": false, "targets": [1,2]}
  		],
    language: {
        url: locale != 'en' ? 'localisation/' + locale + '.json' : ''
    }
	});

	$('#category-table').DataTable({
 		"columnDefs": [
  			{ "orderable": false, "targets": [2,3]}
  		],
    language: {
        url: locale != 'en' ? 'localisation/' + locale + '.json' : ''
    }
	});

	$('#user-table').DataTable({
 		"columnDefs": [
  			{ "orderable": false, "targets": [5,6]}
  		],
      language: {
          url: locale != 'en' ? 'localisation/' + locale + '.json' : ''
      }
	});

  var transactionsDataTable;

  //code to keep the transaction table date column
  if ($('#transaction-table').length > 0){
    transactionsDataTable = $('#transaction-table').DataTable({
      "aaSorting": [[ 0, "desc" ]],
      "aoColumnDefs" : [ {'bSortable' : false,'aTargets' : [6,7] } ],
      language: {
            url: locale != 'en' ? 'localisation/' + locale + '.json' : ''
        }
      });
  }

    //adding transaction on transaction view page
  $('#transaction-table').on('click', '#add_transaction_on_transaction_view', function() {
    var id = $(this).attr('id').replace(/\D/g,'');

    //validatin of the input fields
    if ($( "#date_input").val() == "")
    {
      alert(lang.ener_date);
      $( "#date_input").focus();
    }
    else if ($( "#info_input").val() == "")
    {
      alert(lang.enter_inforamtion);
      $( "#info_input").focus();
    }
    else if ($( "#type_input").val() == "")
    {
      alert(lang.select_type);
      $( "#type_input").focus();
    }
    else if ($( "#category_input").val() == "")
    {
      alert(lang.select_category);
      $( "#category_input").focus();
    }
    else if ($( "#amount_input").val() == "")
    {
      alert(lang.enter_amount);
      $( "#amount_input").focus();
    }
    else if (!/^\s*-?[0-9]\d{0,10}(\.\d{1,2})?\s*$/i.test( $("#amount_input").val()))
    {
      alert(lang.enter_correct_number);
      $( "#amount_input").focus();
    }
    else if ($( "#amount_input").val() <= 0)
    {
      alert(lang.enter_value_more_than_zero);
      $( "#amount_input").focus();
    }
    else if ($( "#account_input").val() == "")
    {
      alert(lang.select_account);
      $( "#account_input").focus();
    }
    else 
    {
      //post the data to the url to add transaction details
      $.post(BASE_URL + 'transaction', {
            'date' : $("#date_input").val(),
            'type' : $("#type_input").val(),
            'category_id' : $("#category_input").val(),
            'amount' : $("#amount_input").val(),
            'description' : $("#info_input").val(),
            'account_id' : $("#account_input").val()
            }, function(data) {

        inserted_id = data;

        //clone row details from the first row of the table
        //in the below code firs the string is coverted to normal strig without new line and extra spaces
        //the data table is not accepting the first coumn with extra data where is supports in other columns
        date_data = ($('.view_transaction_tr:first td').clone().html());
        date_data = date_data.replace(/\r?\n/g, "");
        date_data = date_data.replace(/\s{2,}/g,' ');
        date_data = date_data.replace(/ </g,'<');
        date_data = date_data.replace(/> /g,'>');

        transactionsDataTable.row.add( [
              date_data.replace(/> /g,'>'),
              $('.view_transaction_tr:first td').next().clone().html(),
              $('.view_transaction_tr:first td').next().next().clone().html(),
              $('.view_transaction_tr:first td').next().next().next().clone().html(),
              $('.view_transaction_tr:first td').next().next().next().next().clone().html(),
              $('.view_transaction_tr:first td').next().next().next().next().next().clone().html(),
              $('.view_transaction_tr:first td').next().next().next().next().next().next().clone().html(),
              $('.view_transaction_tr:first td').next().next().next().next().next().next().next().clone().html(),
            ] ).draw();

        //getting the first row id
        first_row_id = $('.hidden_input').first().attr('id').replace(/\D/g,'');

        //assigning new inserted ids to the id
        $("#date_field_" + first_row_id).first().attr('id', 'date_field_' + inserted_id);
        $("#date_input_" + first_row_id).first().attr('id', 'date_input_' + inserted_id);
        $("#info_field_" + first_row_id).first().attr('id', 'info_field_' + inserted_id);
        $("#info_input_" + first_row_id).first().attr('id', 'info_input_' + inserted_id);
        $("#type_field_" + first_row_id).first().attr('id', 'type_field_' + inserted_id);
        $("#type_input_" + first_row_id).first().attr('id', 'type_input_' + inserted_id);
        $("#category_field_" + first_row_id).first().attr('id', 'category_field_' + inserted_id);
        $("#category_input_" + first_row_id).first().attr('id', 'category_input_' + inserted_id);
        $("#amount_field_" + first_row_id).first().attr('id', 'amount_field_' + inserted_id);
        $("#amount_input_" + first_row_id).first().attr('id', 'amount_input_' + inserted_id);
        $("#account_field_" + first_row_id).first().attr('id', 'account_field_' + inserted_id);
        $("#account_input_" + first_row_id).first().attr('id', 'account_input_' + inserted_id);
        $("#update_" + first_row_id).first().attr('id', 'update_' + inserted_id);
        $("#cancel_button_" + first_row_id).first().attr('id', 'cancel_button_' + inserted_id);
        $("#delete_transaction_" + first_row_id).first().attr('id', 'delete_transaction_' + inserted_id);
        $("#update_" + inserted_id).removeAttr('href');

        //updating the class of amount field and
        $("#amount_input_" + inserted_id).parent().addClass('text-right');
        $("#amount_input_" + inserted_id).parent().parent().addClass('view_transaction_tr');

        //assigning value to the new fields(both inputs and span fields)
        $("#date_field_" + inserted_id).text($("#date_input").val());
        $("#date_input_" + inserted_id).val($("#date_input").val());
        $("#info_field_" + inserted_id).text($("#info_input").val());
        $("#info_input_" + inserted_id).val($("#info_input").val());
        $("#type_field_" + inserted_id).text($("#type_input").val());
        $("#type_input_" + inserted_id).val($("#type_input").val());
        $("#category_field_" + inserted_id).text($("#category_input option:selected").text());
        $("#category_input_" + inserted_id).val($("#category_input").val());
        $("#account_field_" + inserted_id).text($("#account_input option:selected").text());
        $("#account_input_" + inserted_id).val($("#account_input").val());

        //add zero in the amount
        $("#amount_field_" + inserted_id).text(parseFloat($("#amount_input").val()).toFixed(2));
        $("#amount_input_" + inserted_id).val(parseFloat($("#amount_input").val()).toFixed(2));
        $("#amount_input_" + inserted_id).attr('value', parseFloat($("#amount_input").val()).toFixed(2));
        $("#date_input_" + inserted_id).attr('value', $("#date_input").val());
        $("#info_input_" + inserted_id).attr('value', $("#info_input").val());

        

        //changing the class of type and ammount depending on the type of the transaction
        if($("#type_input").val() == 'Income')
        {
          $("#type_field_" + inserted_id).removeClass('label-danger');
          $("#type_field_" + inserted_id).addClass('label-success');
          $("#amount_field_" + inserted_id).css('color', '#215e19');
          $("#amount_field_" + inserted_id).removeClass('text-danger');
        }
        else
        {
          $("#type_field_" + inserted_id).addClass('label-danger');
          $("#type_field_" + inserted_id).removeClass('label-success');
          $("#amount_field_" + inserted_id).css('color', '');
          $("#amount_field_" + inserted_id).addClass('text-danger');
          $("#amount_field_" + inserted_id).text("-" + parseFloat($("#amount_input").val()).toFixed(2));
        }

        //empty all the input fields
        $("#type_input").val(""),
        $("#category_input").val(""),
        $("#amount_input").val(""),
        $("#info_input").val(""),
        $("#account_input").val("")

      });
    }
  });

  //Update transaction 
  $('#transaction-table').on('click', '.update_transaction_button', function() {
      var id = $(this).attr('id').replace(/\D/g,'');

      //add categories name as options according to type selected
      //$('transaction-table').on('change', '#type_input_' + id, function() {
      $('#type_input_' + id).change(function(){
        $('#category_input_' + id).find('option').not(':first').remove();
        if ($(this).val() != "") {
          $.get( BASE_URL + 'categories/' + $(this).val(), function( data ) {
            $.each(data, function (index, value) {
              $('#category_input_' + id).append('<option value="' + index + '">' + value + '</option>');
            });
          });
        }
      });

      if ($(this).hasClass('btn-info'))
      {

        //edit button changes
        $(this).text(lang.update);
        $(this).addClass('btn-warning');
        $(this).removeClass('btn-info');

        //cancel button
        $('#delete_transaction_' + id).hide();
        $('#cancel_button_' + id).show();
        
        //hiding all the display fields 
        $( "#date_field_" + id ).hide();
        $( "#info_field_" + id ).hide();
        $( "#type_field_" + id ).hide();
        $( "#category_field_" + id ).hide();
        $( "#amount_field_" + id ).hide();
        $( "#account_field_" + id ).hide();

        //displaying all input fields
        $( "#date_input_" + id ).show();
        $( "#info_input_" + id ).show();
        $( "#type_input_" + id ).show();
        $( "#category_input_" + id ).show();
        $( "#amount_input_" + id ).show();
        $( "#account_input_" + id ).show();

      }
      else if ($(this).hasClass('btn-warning'))
      {
        if ($( "#date_input_" + id ).val() == "")
        {
          alert(lang.ener_date);
          $( "#date_input_" + id ).focus();
        }
        else if ($( "#info_input_" + id ).val() == "")
        {
          alert(lang.enter_inforamtion);
          $( "#info_input_" + id ).focus();
        }
        else if ($( "#type_input_" + id ).val() == "")
        {
          alert(lang.select_type);
          $( "#type_input_" + id ).focus();
        }
        else if ($( "#category_input_" + id ).val() == "")
        {
          alert(lang.select_category);
          $( "#category_input_" + id ).focus();
        }
        else if ($( "#amount_input_" + id ).val() == "")
        {
          alert(lang.enter_amount);
          $( "#amount_input_" + id ).focus();
        }
        else if (!/^\s*-?[0-9]\d{0,10}(\.\d{1,2})?\s*$/i.test( $("#amount_input_" + id ).val()))
        {
          alert(lang.enter_value_more_than_zero);
          $( "#amount_input_" + id ).focus();
        }
        else if ($( "#account_input_" + id ).val() == "")
        {
          alert(lang.select_account);
          $( "#account_input_" + id ).focus();
        }
        else 
        {
          //post the data to the url to update
          $.post(BASE_URL + "transaction/" + id, {
                _method:"PUT",
                'date' : $( "#date_input_" + id ).val(),
                'type' : $( "#type_input_" + id ).val(),
                'category_id' : $( "#category_input_" + id ).val(),
                'amount' : $( "#amount_input_" + id ).val(),
                'description' : $( "#info_input_" + id ).val(),
                'account_id' : $( "#account_input_" + id ).val()
                }, function(data) {
            
            //change to the update button
            $("#update_" + id).text(lang.edit);
            $("#update_" + id).removeClass('btn-warning');
            $("#update_" + id).addClass('btn-info');

            //cancel and delete button opreations
            $('#delete_transaction_' + id).show();
            $('#cancel_button_' + id).hide();

            //assignin current values input values to the field values
            $( "#date_field_" + id ).text($( "#date_input_" + id ).val());
            $( "#type_field_" + id ).text($( "#type_input_" + id ).val());
            //$( "#category_field_" + id ).text($("#category_input_" + id + ' option:selected').text());
            $( "#account_field_" + id ).text($("#account_input_" + id + ' option:selected').text());

            $( "#amount_field_" + id ).text(parseFloat($( "#amount_input_" + id ).val()).toFixed(2));
            //$( "#amount_field_" + id).text(parseFloat($("#amount_input").val()).toFixed(2));
            $( "#info_field_" + id ).text($( "#info_input_" + id ).val());

            $( "#category_field_" + id ).text($("#category_input_" + id + ' option:selected').text());

            //adding class to the type field according to choosen type
            if ($( "#type_input_" + id ).val() == 'Income')
            {
              $( "#type_field_" + id ).removeClass('label-danger');
              $( "#type_field_" + id ).addClass('label-success');
              $( "#amount_field_" + id).css('color', '#215e19');
              $( "#amount_field_" + id).removeClass('text-danger');
            }
            if ($( "#type_input_" + id ).val() == 'Expense')
            {
              $( "#type_field_" + id ).removeClass('label-success');
              $( "#type_field_" + id ).addClass('label-danger');
              $( "#amount_field_" + id).css('color', '');
              $( "#amount_field_" + id).addClass('text-danger');
              $( "#amount_field_" + id).text("-" + $("#amount_input_" +id).val());
            }
            
            //display all the fields
            $( "#date_field_" + id ).show();
            $( "#info_field_" + id ).show();
            $( "#type_field_" + id ).show();
            $( "#category_field_" + id ).show();
            $( "#amount_field_" + id ).show();
            $( "#account_field_" + id ).show();

            //hide all the input fields
            $( "#date_input_" + id ).hide();
            $( "#info_input_" + id ).hide();
            $( "#type_input_" + id ).hide();
            $( "#category_input_" + id ).hide();
            $( "#amount_input_" + id ).hide();
            $( "#account_input_" + id ).hide();

          });
        }
      }
    });

    //cancel an inline update
    $('#transaction-table tbody').on('click', '.cancel_button', function() {
      var id = $(this).attr('id').replace(/\D/g,'');

      //change to the update button
      $("#update_" + id).removeClass('btn-warning');
      $("#update_" + id).addClass('btn-info');
      $("#update_" + id).text(lang.edit);

      //cancel and delete button opreations
      $('#delete_transaction_' + id).show();
      $('#cancel_button_' + id).hide();

      //display all the fields
      $( "#date_field_" + id ).show();
      $( "#info_field_" + id ).show();
      $( "#type_field_" + id ).show();
      $( "#category_field_" + id ).show();
      $( "#amount_field_" + id ).show();
      $( "#account_field_" + id ).show();

      //hide all the input fields
      $( "#date_input_" + id ).hide();
      $( "#info_input_" + id ).hide();
      $( "#type_input_" + id ).hide();
      $( "#category_input_" + id ).hide();
      $( "#amount_input_" + id ).hide();
      $( "#account_input_" + id ).hide();

    });


  //delete transaction 
  $('#transaction-table').on('click', '.delete_transaction_button', function() {
    var id = $(this).attr('id').replace(/\D/g,'');

    if(confirm(lang.transaction_delete_confirmation)){
       $.post(BASE_URL + "transaction/" + id, {_method:"DELETE"}, function(data) {
          $("#delete_transaction_" + id).parent().parent().remove();
        });
    }
    else
    {
      return false;  
    }
  });

  //add categories name as options according to type selected
  $('body').on('change', '#type_input', function() {
    $('#category_input').find('option').not(':first').remove();
    if ($(this).val() != "") {
      $.get( BASE_URL + 'categories/' + $(this).val(), function( data ) {
        $.each(data, function (index, value) {
          $('#category_input').append('<option value="' + index + '">' + value + '</option>');
        });
      });
    }
  });
});
