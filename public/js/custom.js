$('#calendar').datepicker({});

!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
	$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})

$(document).ready(function () {
    $('.table').DataTable();
	$('.datepicker').datepicker();
	$('.select2').select2();
	$('.select2').on('change', function() {
        $(this).trigger('blur');
    });
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#profile_image').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#image_uploader").change(function() {
  readURL(this);
});

function joinGrammar(prod_date){
  var prod_date_timestamp = new Date(prod_date).getTime();
  var current_timestamp = Date.now();

  if(prod_date_timestamp > current_timestamp){
    return "Will join";
  }
  return "Joined";
}
function timeConverter(prod_date){
  var a = new Date(prod_date);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time =  month + ' ' + date + ', ' + year;
  return time;
}
function timeConverter2(prod_date){
  var a = new Date(prod_date);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time =  month + ' ' + date;
  return time;
}