/*!
 * Designed By WaveInfotech.biz
 */
 $(document).ready(function() {
    /*============= About page ==============*/
  $(".about-tab-menu .list-group-item").click(function(e) {
      e.preventDefault();
      $(this).siblings('a.active').removeClass("active");
      $(this).addClass("active");
      var index = $(this).index();
      $("div.about-tab>div.about-tab-content").removeClass("active");
      $("div.about-tab>div.about-tab-content").eq(index).addClass("active");
  });

  /*==============  photos ===============*/
  $(".show-image").click(function(){
    var img = $(this).closest(".item-img-wrap").find("img:first").attr("src");
    $("#showPhoto .modal-body").html("<img src='"+img+"' class='img-responsive'>");
    $("#showPhoto").modal("show");
  })

  /*==============  show panel ===============*/
  $(".btn-frm").click(function(){
    $(".frm").toggleClass("hidden");
    $(".frm").toggleClass("animated");
    $(".frm").toggleClass("fadeInRight");
  });
	
});

/* =====================Typing text of login page ===========*/

var txt = 'linkliv'.split('');
var delay = 200;
function type() {
	for (i = 0; i < txt.length; i++) {
		setTimeout(function () {
			$('.autoText').append(txt.shift());
		}, delay * i);
	}
	setTimeout(function(){
		$('.autoText').text('');
		type(txt = 'linkliv'.split(''));
	}, delay * i + 1000)
}
type();
/*============= datepicker DOB ===============*/
$('#startDate').datetimepicker({
	 format: 'DD/MM/YYYY',
	 maxDate: moment("12/30/2010"),
});

/*============= datepicker in achievement===============*/
$('#startDate2').datetimepicker({
	 format: 'DD/MM/YYYY',
	 maxDate: moment("12/30/2010"),
});

/*============= datepicker with class==============*/
$('.date-picker-new').datetimepicker({
	 format: 'DD/MM/YYYY',
	 maxDate: moment("12/30/2010"),
});



/*============= datepicker in experience ===============*/

    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });

	
/*========== select options ==============*/

$('.js-example-basic-single').select2();

$('.js-example-basic-multiple').select2();

$(".js-example-tags").select2({
  tags: true
});
/*========== tooltip ==============*/

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

/*========== fix sidebar ==============*/
function fixDiv() {
    var $cache = $('#getFixed_left');
    if ($(window).scrollTop() > 450)
      $cache.addClass('is_fixed');
    else
      $cache.removeClass('is_fixed');
  }
  $(window).scroll(fixDiv);
  fixDiv();

/*========== date validation ============*/

function fixDivright() {
    var $cache = $('#getFixed_right');
    if ($(window).scrollTop() > 450)
      $cache.addClass('is_fixed');
    else
      $cache.removeClass('is_fixed');
  }
  $(window).scroll(fixDivright);
  fixDivright();



/*========== profile img ============*/
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
				
		    } else {
		        //if( log ) alert(log);
                        $("#upload_file").show();
                        
		    }
	    
		});
		
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload2').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp1").change(function(){
		    readURL(this);
                     $('#submitpost').prop('disabled', false);
		});
		
		$("#clear").click(function(){
                    var val=$('#src1').val();
                    //alert(val);
		    $('#img-upload2').attr('src',val);
                    $("#upload_file").hide();
                   
		   // $('#urlname').val('');
		});
	});
/*========== /profile img ============*/

/*========== page profile img ============*/
$(document).ready( function() {
    
    	$(document).on('change', '.btn-file-page :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file-page :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        //if( log ) alert(log);
                        $("#upload_file1").show();
		    }
	    
		});
		
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
		
		$("#clear").click(function(){
                    var val=$('#src').val();
                    //alert(val);
		    $('#img-upload').attr('src',val);
                    $("#upload_file1").hide();
		   // $('#urlname').val('');
		});
	});
/*========== /page profile img ============*/

/*============= post image preview =================*/
$(document).ready( function() {
    
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#tbImg").change(function(){
		    readURL(this);
                     $('#submitpost').prop('disabled', false);
		});
	});

/*============= /post image preview =================*/

/*===========add-school================

 $('.button-add').click(function(){
        //we select the box clone it and insert it after the box
        $('.box.template:last').clone()
                          .show()
                          .removeClass("template")
                          .insertAfter(".box:last");
    }).trigger("click");
    
    $(document).on("click", ".button-remove", function() {
        $(this).closest(".box").remove();
    });
	
	
/*==========acrodian===============*/

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}


/*======== close image ========*/	

$(".close-image").click(function(){
   $(this).parent().remove(); 
});


/*======== chat ========*/

//this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
       
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
           
            //arrays of popups ids
            var popups = [];
       
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                       
                        var element_pop= document.getElementById(id);
						element_pop.parentNode.removeChild(element_pop);
                        calculate_popups();
                       
                        return;
                    }
                }  
            }
       
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
               
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
               
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
           
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name,img)
            {
               
                for(var iii = 0; iii < popups.length; iii++)
                {  
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                   
                        popups.unshift(id);
                       
                        calculate_popups();
                       
                       
                        return;
                    }
                }              
               
                var element = '<div class="popup-box chat-popup" id="'+id+'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left"><img src="'+img+'" alt="User Avatar" >'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages" id="we'+ id +'"></div> <textarea class="form-control input-lg p-text-area" id="form_chat_message'+ id +'" onkeyup="if(event.keyCode==13) send_chat_message(this.value,'+id+');" rows="2" placeholder="Write a message..."></textarea></div>';
               
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element; 
       
                popups.unshift(id);
                       
                calculate_popups();
               fuserchatmessage(id)
            }
           
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
               
                display_popups();
               
            }
         function send_chat_message(value,key){
   

    var message=value;
 
if((jQuery.trim( message )).length==0){
  alert("Please send some text!!!!!!!");
  }else {

    $.get('/users/send_chat_message',{to_user_id: key,message:message}, function (data){
    if(data){
     
      $('#form_chat_message'+key).val(''); 
      $('#we'+key).html('');
      $('#we'+key).append(data); 
        var height = parseInt($('#we'+key).height());  
        var length = $('#we'+key).length;
        var abc = height * length;
        $('#we'+key).scrollTop($('#we'+key).offset().top+abc);  
    }
    });
    }
}  
function fuserchatmessage(key){
clearInterval(prevchatNowPlaying);
 $('#to_user').val(key);  

 $.get('/users/load_chat_messages',{to_user_id: key}, function (data){ 
	if(data!=''){
		if($('#we'+key).length) {
                     $('#form_chat_message'+key).val(''); 
			$('#we'+key).html('');
			$('#we'+key).append(data); 
			var height = parseInt($('#we'+key).height());  
			var length = $('#we'+key).length;
			var abc = height * length;
			$('#we'+key).scrollTop($('#we'+key).offset().top+abc);
		}		
   } else{
      // $('#we').html('');
   }
 });
   userchatmessage(key);
}
var prevchatNowPlaying = null;
function userchatmessage(key){
clearInterval(prevchatNowPlaying);
 $('#to_user').val(key);  

 $.get('/users/load_chat_messages',{to_user_id: key}, function (data){ 
	if(data!=''){
		if($('#we'+key).length) {
                     //$('#form_chat_message'+key).val(''); 
			$('#we'+key).html('');
			$('#we'+key).append(data); 
			var height = parseInt($('#we'+key).height());  
			var length = $('#we'+key).length;
			var abc = height * length;
		//	$('#we'+key).scrollTop($('#we'+key).offset().top+abc);
		}		
   } else{
      // $('#we').html('');
   }
 });
  prevchatNowPlaying =setInterval(function() { userchatmessage(key); }, 5000);
}

//recalculate when window is loaded and also when window is resized.
window.addEventListener("resize", calculate_popups);
window.addEventListener("load", calculate_popups);