<div class="clearfix">
    <?php
        # var_dump($user_info);
        
        $id = isset($user_info) ? $user_info->id : '';
        $name = isset($user_info) ? $user_info->name : '';
        $email = isset($user_info) ? $user_info->email : '';
        $mobile = isset($user_info) ? $user_info->mobile : '';
        

        # User's group in EDIT MODE
        $user_group_id = '';
        $user_groups = $this->auth_model->get_user_groups($id);
        
        if(!empty($user_groups)){
            $user_group_id = $user_groups[0]->id;
        }

        $options = array('class'=>'col-md-12 form-horizontal', 'role'=>'form');
        $proc_url = isset($edit_mode) && $edit_mode == true ? 'edit' : 'add';

        echo form_open('admin/users/user_proc/'. $proc_url, $options);

        if(isset($user_info)){
            echo form_hidden('user_id', $id);
        }
    ?>

    <div class="clearfix">
        <div class="form-group">
            <label for="user-fullname" class="col-sm-4 control-label">Full name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="user-fullname" required
                    value="<?php echo set_value('fname', $name); ?>" name="fname">
                <?php echo form_error('fname'); ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="user-email" class="col-sm-4 control-label">Email Address</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="user-email" required
                    value="<?php echo set_value('email', $email); ?>" name="email">
                <?php echo form_error('email'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="user-mobile" class="col-sm-4 control-label">Mobile</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="user-mobile" required 
                    value="<?php echo set_value('mobile', $mobile); ?>" name="mobile">
                <?php echo form_error('mobile'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="user-role" class="col-sm-4 control-label">User Group</label>
            <div class="col-sm-8">
                <select class="form-control col-sm-8" id="user-role" name="user_group" required>
                    <option value="">Select a Group</option>
                    <?php
                        foreach($groups as $g){
                            var_dump($g);

                            # Select Default user automatically in ADD MODE
                            $selected = '';

                            if(isset($edit_mode) && $edit_mode == true){
                                $selected = ($g->id == $user_group_id) ? ' selected' : '';
                            }
                            else{
                                $selected = ($g->id == 3) ? ' selected' : '';
                            }

                            echo '<option value="'. $g->id .'" ' . set_select('user_group', $g->id) . 
                                    $selected . '>' . $g->name . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="user_passwd" class="col-sm-4 control-label">Password </label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="user_passwd" name="password">
                <?php 
                    echo form_error('password');
                
                    if(isset($edit_mode) && $edit_mode == true){
                        echo '<div class="text-info">Leave password fields blank to retain old password(s)</div>';
                    } 
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="con-passwd" class="col-sm-4 control-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="con-passwd" name="cpassword">
                <?php echo form_error('cpassword'); ?>
            </div>
        </div>
        <hr/>
        
        <div class="col-sm-offset-4 col-sm-8">
            <input type="submit" class="btn btn-primary" value="Submit" />
            <input type="reset" class="btn btn-default" value="Reset" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
