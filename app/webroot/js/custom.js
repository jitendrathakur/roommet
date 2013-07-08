

$(document).ready(function(){
	 $( "#productAdd" ).datepicker({ dateFormat: "yy-mm-dd", maxDate: "+d" });

	$( "#ProductStartDate" ).datepicker({
      defaultDate: "+d",
      changeMonth: true,
      dateFormat: "yy-mm-dd",
      onClose: function( selectedDate ) {
        $( "#ProductEndDate" ).datepicker( "option", "minDate", selectedDate );
      }
    });

    $( "#ProductEndDate" ).datepicker({
      defaultDate: "+d",
      changeMonth: true, 
      dateFormat: "yy-mm-dd",   
      onClose: function( selectedDate ) {
        $( "#ProductStartDate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
	 

});
