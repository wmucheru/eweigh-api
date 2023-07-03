<div class="content-wrapper">

<section class="content-header">
	<hr />
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard'); ?>"> Home</a></li>
        <li><a href="<?php echo site_url('users/permissions/'); ?>">Group Permissions</a></li>
        <li class="active"><?php echo isset($page_title) ? $page_title : ''; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="clearfix">
	<div class="col-md-12">
		<?php
			
			# var_dump($group_perms);
			if($this->session->flashdata('perm_success') !== null){
				echo '<div class="alert alert-success">' . $this->session->flashdata('perm_success') . '</div>';
			}

			/* 
			 * If Admin/System group is selected, show full-access message 
			 */
			//if($gid == 1 || $gid == 8){
				echo '<div class="alert alert-info alert-large">
						<i class="fa fa-info-circle"></i> To change Admin/System settings Contact 
						the System administrator for any queries
					  </div>';
			//}
			//else{
				$hidden = array('gid'=>$gid);
			//}

				echo form_open('users/set_perms', '', $hidden);
		?>
		<table class="table table-bordered table-striped dt">
	    <thead>
    	<tr>
            <th>Permissions</th>
            <th>Allowed</th>
        </tr>
        </thead>
        <tbody>
			<form>
			<input type="hidden" id="group_id" name="group_id" value="<?php echo $gid; ?>"/>
				<?php
					foreach($perms as $perm){
						$checked = in_array($perm->id, $group_perms) ? 'checked' : '';
				?>
					<tr>
						<td><?php echo $perm->id . '. ' . $perm->name ?></td>
						<td><input type="checkbox" id="perm[]" name="perm[]" class="check" value="<?php echo $perm->id ?>" 
								<?php echo $checked; ?>/></td>
					</tr>
				<?php } ?>
			</form>
	    </tbody>
	    </table>

		<hr />
	    <button class="btn btn-success">
	    	<i class="fa fa-check"></i> Save Changes
	    </button>

	    <?php 
				echo form_close(); 

	    	//} # ENDIF: Admin has access to all pages
	    ?>
	</div>
</div>
</section>

</div>
<script type="text/javascript">
    $(function (){
        $('input[name=perm]').click(function() {
			var perms = [];
			$("input[name=perm[]]:checked").function() {
                perms.push($(this).val();
			});
			//var perms  = $("#group_id").val();
			var group_id  = $("#group_id").val();
			$.ajax({
                url : siteUrl + "/users/set_perms",
                type: 'POST',
                data : {'perms':perms,'group_id':group_id},
                success: function() {
                    alert('mike the shit!');
                }
            });
        })
    });
</script>




