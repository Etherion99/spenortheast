$(document).ready(function() {
    $('#edit-event-description').summernote({
        placeholder: '',
        tabsize: 4,
        height: 250
  	});

    //fix datetime picker fontwaseome icons error 

  	$.fn.datetimepicker.Constructor.Default = $.extend({},
        $.fn.datetimepicker.Constructor.Default,
        {
        	icons:{
            	time: 'fas fa-clock',
                date: 'fas fa-calendar-alt',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times'
            } 
        }
    );

  	$('#edit-event-start_date').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        locale: 'es'
    });

    $('#edit-event-end_date').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        locale: 'es'
    });
});