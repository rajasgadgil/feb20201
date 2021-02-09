$(document).ready( function () {
	if( $('.userspacetable').length>0){
		$('.userspacetable').dataTable( {
			"lengthChange": false
		} );
	}
	//assign company to user
	$('.jsAssignusercompany').on('change',function(){
		var company=$(this).val();
		var user=$(this).parent().find('.jsUser').val();
		var ajaxlocation= stylesheet_directory_uri+'/ajax.php';
		$.ajax({				
			url: ajaxlocation,
			data: { 
				assigncompany: company,
				assignto:user
			},
			success: function(result){ 
				if(!alert(result)){window.location.reload();}
			}
		});	
	
	});
	//form validate
	if($('.form-validate').length>0){
        $('.form-validate').validate({
            errorElement: 'div',
            errorClass: 'error-field',
            invalidHandler: function (event, validator) { //display error alert on form submit
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-control').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-control').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
				if(element.hasClass('errorouter')){
					error.insertAfter(element.parent());					
				}else{
					error.insertAfter(element);
				}
            },
            submitHandler: function (form, event) {
                form.submit();
            }
        });
    }

	/*data for companies*/
	 /*   if($('.jsCompanyFilterDataTable').length>0){
        var company=$('.jsCompany').val();
        $('.jsCompanyFilterDataTable').DataTable({
            fixedHeader: true,
            ordering:false,
            processing:true,
            serverSide:true,
            ajax:{
                url:'ajax.php',
                type:'POST',
                data:{
                    company:company
                },
                error:function(){
                    $("#jsCompanyFilterDataTable").append('<tbody><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                }

            }
        });
    }*/

} );
