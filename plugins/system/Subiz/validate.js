





jQuery(document).ready(function (){
					
					var lid = jQuery("#jform_params_License_ID").val();
					var idcode = jQuery("#jform_params_idcode").val();
					
					if(lid=="")
					   {
						    if(idcode=="")
							  {
								  jQuery('.btn-success').attr('disabled','disabled');
								  jQuery('#toolbar-save>button').attr('disabled','disabled');
							  }
					   }
					
			
			
	jQuery("#jform_params_idcode").change(function(){
	     var idcode = jQuery(this).val();
		 var lid = jQuery("#jform_params_License_ID").val();
	          if(idcode == "" && lid == "")
					   {
						   jQuery('.btn-success').attr('disabled','disabled');
						   jQuery('#toolbar-save>button').attr('disabled','disabled');
						     alert("License ID OR Widget code require");
					   }
					   else
					   {
						   jQuery('.btn-success').removeAttr('disabled');
						   jQuery('#toolbar-save>button').removeAttr('disabled');
						 
					   }
					   
		});			   
					   
	jQuery("#jform_params_License_ID").change(function(){
	     var lid = jQuery(this).val();
		 var idcode = jQuery("#jform_params_idcode").val();
	          if(lid == "" && idcode == "")
					   {
						   jQuery('.btn-success').attr('disabled','disabled');
						   jQuery('#toolbar-save>button').attr('disabled','disabled');
						     alert("License ID OR Widget code require");
					   }
					   else
					   {
						   jQuery('.btn-success').removeAttr('disabled');
						    jQuery('#toolbar-save>button').removeAttr('disabled');
						  
					   }				   
					   
					   
         });		
			
			
			
			
			
			
			
			
			
			
			});
			
