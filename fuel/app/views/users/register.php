<style type="text/css">

form{margin-left:1em}

#username{
margin-left:56px;
}
#password{
margin-left:56px;
}
#repass{
margin-left:15px;
}
#email{
margin-left:86px;
}

</style>

 <form    id="form" method="post" action=""  >
	<fieldset>
		
		
		<p>
			<label class="username" for="username">Username</label>
			<input id="username" name="username" type="text" /><div id="status"></div>
		</p>
		<p>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" /><span ></span>
		</p>
		<p>
			<label for="cpassword">Confirm password </label>
			<input id="cpassword" name="cpassword" type="password" /><span ></span>
		</p>
		<p>
			<label for="email">Email</label>
			<input id="email" name="email" type="email" /><span ></span>
		</p>
		<p>
			<input type="submit" value="create Account" />
		</p>
                </fieldset>
 	 	</form>


<script> 

$(document).ready(function(){

$("#username").change(function() { 

var usr = $("#username").val();

if(usr.length >= 4)
{
$("#status").html('<img src="<?php echo URI::base()?>/assets/img/loader.gif" align="absmiddle">&nbsp;Checking availability...');
 check_availability();  



}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
	$("#username").removeClass('object_ok'); // if necessary
	$("#username").addClass("object_error");
	}

});

});
function check_availability(){  
  
        //get the username  
        var username = $('#username').val();  
  
        //use ajax to run the check  
        $.post("<?php echo URI::base()?>users/check", { username: username },  
            function(result){  
                //if the result is 1  
                if(result == true){  
                    //show that the username is available  
                   $("#status").html('<img src="<?php echo URI::base()?>/assets/img/tick.gif" align="absmiddle">&nbsp;Available'); 
                }else{  
                    //show that the username is NOT available  
                   $("#status").html('<img src="<?php echo URI::base()?>/assets/img/no.gif" align="absmiddle">&nbsp;Not available');  
                }  
        });  
  
}
$(document).ready(function(){
    $("#form").validate({
        debug: false,
        
        
    rules: {
        username: {
            required:true,
            
            
        },
        password: {
            minlength: 4,
            required:true,
             
        },
        cpassword: {
            minlength: 4,
            required:true,
            equal: password,
        },
        email: {
        required: true,
        email: true,
        }
    },
    messages: {
    username: {
        required:"You have not entered username."
    },
    password:{ 
        required:"You have not entered password."
    },
    email: {
        required: "Null or empty email detected.",
        email: "This email is not correct  yet."
    },
    cpassword: {
        required:"You have not entered confirm password.",
        equal:"Confirm password do not match with the password."
    },
    }
    });
    });
    
    

</script>