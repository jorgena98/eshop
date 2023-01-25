$(document).ready(function() {	
    $('#subscribeButton').on('click', function() {  
        $('.status').html('');        
        var regEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var email = $('#email').val();	        
         if(email.trim() == '' ) {          
			$('#emailError').text('Please enter email.').removeClass('hidden').addClass('alert alert-danger');	
              
        } else if(!regEmail.test(email)) {          
			$('#emailError').text('Please enter a valid email.').removeClass('hidden').addClass('alert alert-danger');        
       
        } else {          
            $.ajax({
                type:'POST',
                url:'subscribe/subscribe_action.php',
                dataType: "json",
                data:{email_subscribe:1, email:email},
                success:function(data) {
                    if(data.status == 'ok') {
                        $('.status').html(`<p class="alert alert-success">${data.msg}</p>`);
                    } else {  
                        $("#emailError").empty().removeClass('alert alert-danger').addClass('hidden');                
                        $('.status').html(`<p class="alert alert-danger">${data.msg}</p>`);
                    }
                    $('#subscribeButton').removeAttr("disabled");
                    $('.susbcribe-container').css('opacity', '');
                },
                beforeSend:function () {
                    $('#subscribeButton').attr("disabled", "disabled");
                    $('.susbcribe-container').css('opacity', '.5');
                }
                
            });
        }
    });
});