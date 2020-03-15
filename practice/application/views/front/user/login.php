<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
<div class="container">
    <h2 style="text-align: center;">Login to Your Account</h2>
	
    <!-- Status message -->
    <center>
    <?php  
        if(!empty($success_msg)){ 
            echo '<p class="status-msg success">'.$success_msg.'</p>'; 
        }elseif(!empty($error_msg)){ 
            echo '<p class="status-msg error">'.$error_msg.'</p>'; 
        } 
    ?></center>
	
    <!-- Login form -->
    <div class="regisFrm form-horizontal">
        <form action="" method="post" id="login">
            <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">EMAIL</label>
                    <div class="col-sm-9">
                         <input type="text" name="email" placeholder="EMAIL" value=""  class="form-control">
                <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">PASSWORD</label>
                    <div class="col-sm-9">
                         <input type="password" name="password" placeholder="PASSWORD" value=""  class="form-control">
               <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                    </div>
                </div>

           <div class="form-group"> 
            <div class="col-sm-9 col-sm-offset-3">
                <div class="send-button">
                    <input type="submit" name="loginSubmit" value="LOGIN">
                     <p>Don't have an account? <a href="<?php echo base_url('users/registration'); ?>">Register</a></p>
                </div>
            </div>

        </div>
        </form>
       
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
       $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]*$/);
    });
    $('#login').validate({
    ignore: [],
    rules: {
       
        email:{
            required:true,
            email:true 
        },
        password : {
        required:true,
        },
    },
    messages: {
    email:{
        required:"Please enter email.",
        email:"Please enter valid email."
    },
    password : {
    required:"Please enter password.",
    },
    }, 
    errorPlacement: function(error, element) {
        if(element.attr('name') == "expert[]"){
            element.next().append(error);
        }
        else if(element.attr('name') == "image"){
            jQuery('.imgfile').after(error);//.append(error);
        }
        else if(element.attr('name') == "gender"){
            jQuery('.rederr').after(error);//.append(error);
        }
        else {
            error.insertAfter(element);
        }
    },     
    submitHandler: function(form) {
        form.submit();
    }
});
       });
</script>