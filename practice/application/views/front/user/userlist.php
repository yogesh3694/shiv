<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script> -->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript"> 

$( document ).ready(function() {

    $('#dismain').DataTable({
           // "searching": false,
            //"bLengthChange": false,
            "aaSorting": [],
            "ordering": true,
            columnDefs: [{
            orderable: false,
            targets: "no-sort"
            }],
            "pageLength": 10,
           // "processing": true,
            //"serverSide": true,
            "language": {
                          "emptyTable": "Data  Not Found."
                      },
            // "ajax":{
            // url :"<?php echo base_url('user/userlistdata/') ?>", // json datasource
            // type: "POST",  // type of method  , by default would be get
            // error: function(){  // error handling code
            //   $("#employee_grid_processing").css("display","none");
            // }

            // }
    });   
});
</script>
<div class="container">
    
            
                <h2>User List</h2><center>
                <?php  
        if(!empty($success_msg)){ 
            echo '<p class="status-msg success">'.$success_msg.'</p>'; 
        }elseif(!empty($error_msg)){ 
            echo '<p class="status-msg error">'.$error_msg.'</p>'; 
        } 
    ?></center>
                <div class="form-group">
                   
                    <div class="col-sm-12">
                        <div class="content-i manage_discussion_page">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box table_container"> 
               
                <div class="table-responsive"> <?php //print_r($disdata); exit; ?>
                    <table id="dismain" class="table admin_table display">
                        <thead> 
                            <tr>
                            <th class="no-sort">No.</th>
                            <th class="no-sort">First Name</th>
                            <th class="no-sort">Last Name</th>
                            <th class="no-sort">Email</th>
                            <th class="no-sort">Phone</th>
                            <th class="">Gender</th>
                            <th class="no-sort">Image</th>
                            <th class="no-sort">Status</th>
                            <th class="no-sort action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            foreach ($user as $keyvalue) { ?>
                            
                            <tr>
                                <td><?php echo $i;?></td>
                                 <td><?php echo $keyvalue->first_name;?></td>
                                 <td><?php echo $keyvalue->last_name;?></td>
                                 <td><?php echo $keyvalue->email;?></td>
                                 <td><?php echo $keyvalue->phone;?></td>
                                 <td><?php echo $keyvalue->gender;?></td>
                                 <td><?php if($keyvalue->image!=''){?><img src="<?php echo base_url("assets/upload/".$keyvalue->image)?>" height="100" width="100"><?php } ?></td>
                                 <td><?php echo ($keyvalue->status==1)? 'Active' : 'Inactive';?></td>
                                 <td><a title="Edit" href="<?php echo base_url().'edit-user/'.$keyvalue->id;?>" class="t_edit_icon"><i class="zmdi zmdi-edit"></i>Edit | </i></a><a title="Edit" href="<?php echo base_url().'userdelete/'.$keyvalue->id;?>" class="t_edit_icon"><i class="zmdi zmdi-edit"></i>Delete | </i></a><a title="View" href="<?php base_url().'view-user/'.$keyvalue->id;?>" class="t_delet_icon"><i class="fa fa-eye" aria-hidden="true">View</i></a></td>
                            </tr>

                            <?php
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>
                
            
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
    jQuery(document).on("change",".catstatusselect",function(e){
     var discussion_ID=e.target.id;
     var status=$(this).val();
    $.ajax({
        type:'POST',
        url:"<?php echo base_url().'admin/Discussion_Master/admin_dicsussion_status' ?>",
        data:{ discussion_ID:discussion_ID,status: status},
        success:function(html){  
           window.location.href="<?php echo base_url();?>/admin/discussions";
        }
    });                
});
</script>