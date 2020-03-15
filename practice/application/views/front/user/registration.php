<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
<div class="container">
 
            <form class="form-horizontal" role="form" method="post" id="register"  enctype="multipart/form-data">
                <h2 style="text-align: center;">Registration</h2><center>
                <?php  
        if(!empty($success_msg)){ 
            echo '<p class="status-msg success">'.$success_msg.'</p>'; 
        }elseif(!empty($error_msg)){ 
            echo '<p class="status-msg error">'.$error_msg.'</p>'; 
        } 
    ?></center>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                         <input type="text" name="first_name" placeholder="FIRST NAME" value="<?php echo !empty($user->first_name)?$user->first_name:''; ?>"  class="form-control">
                <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                         <input type="text" name="last_name" placeholder="LAST NAME" value="<?php echo !empty($user->last_name)?$user->last_name:''; ?>" class="form-control">
                <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email* </label>
                    <div class="col-sm-9">
                         <input type="email" name="email" placeholder="EMAIL" value="<?php echo !empty($user->email)?$user->email:''; ?>"  class="form-control">
                <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password*</label>
                    <div class="col-sm-9">
                       <input type="password" name="password" placeholder="PASSWORD"  class="form-control" id="password">
                <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Confirm Password*</label>
                    <div class="col-sm-9">
                         <input type="password" name="conf_password" placeholder="CONFIRM PASSWORD" class="form-control">
                <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label for="birthDate" class="col-sm-3 control-label">Date of Birth*</label>
                    <div class="col-sm-9">
                        <input type="date" id="birthDate" class="form-control">
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                    <div class="col-sm-9">
                        <input type="text" id="phone" name="phone" placeholder="Phone number" class="form-control" value="<?php echo !empty($user->phone)?$user->phone:''; ?>">
                         <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                        
                    </div>
                </div>
                 <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label">Profile Image</label>
                    <div class="col-sm-9 imgfileerr">
                        <input type="file" id="image" name="image" placeholder="image" class="form-control imgfile">
                         <?php echo form_error('image','<p class="help-block">','</p>'); ?>
                        
                    </div>
                </div>
              
                 
                <?php 
                if(!empty($user->gender) && $user->gender == 'Female'){ 
                    $fcheck = 'checked="checked"'; 
                    $mcheck = ''; 
                }else{ 
                    $mcheck = 'checked="checked"'; 
                    $fcheck = ''; 
                } 
                ?>
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row rederr">
                            <div class="col-sm-4 ">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" name="gender" value="Female" <?php echo $mcheck; ?>>Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" name="gender" value="Male" <?php echo $mcheck; ?>>Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <input type="submit" name="signupSubmit" value="CREATE ACCOUNT" class="btn btn-primary btn-block">
                 <p>Already have an account? <a href="<?php echo base_url('users/login'); ?>">Login here</a></p>
               <!--  <button type="submit" class="btn btn-primary btn-block">Register</button> -->
            </form> <!-- /form -->
        </div> <!-- ./container -->

<script type="text/javascript">
    $(document).ready(function () {
       $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]*$/);
    });
    $('#register').validate({
    ignore: [],
    rules: {
        first_name:{
            required:true,
            lettersonly:true,
            maxlength:10,           
        },
        last_name: {
            required:true,
            lettersonly:true,
            maxlength:10,
        },
        email:{
            required:true,
            email:true 
        },
        password : {
        required:true,
        minlength : 5
        },
        conf_password : {
        required:true,
        minlength : 5,
        equalTo : "#password"
        },
         phone:{
            required:true,
            number:true 
        },
        image:"required",
         gender:"required",
         
    },
    messages: {
    first_name:{required:"Please enter first name.", lettersonly:"Please enter valid first name."},
    last_name:{required:"Please enter last name.", lettersonly:"Please enter valid last name."},
    
    email:{
        required:"Please enter email.",
        email:"Please enter valid email."
    },
    password : {
    required:"Please enter password.",
    minlength : "Password minimum length is 5 character."
    },

    conf_password : {
    required:"Please enter confirm password.",
    equalTo : "password mismatch."
    },
    phone:{required:"Please enter phone.", number:"Please enter valid phone."},
    image:"please uploade image",
    gender:"Please select gender",
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