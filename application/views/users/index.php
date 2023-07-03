  <div class="content-wrapper">

    <section class="content-header">
      <h1>  </h1>

      <ol class="breadcrumb">
        <li><a href="#"> HOME</a></li>
        <li><a href="<?php echo site_url('users/index'); ?>">User Management</a></li>
        <li class="active"></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">


    <div class="box">

      <div class="box-body">

        <div class="row">
              <div class="col-sm-12">
                <?php $this->load->view('/admin/users/add-users-modal'); ?>
              </div>
            <hr />
        </div>

      <?php if(isset($users))  { ?>
      <table class="table table-stripped table-condensed dt">
        <thead>
          <th>ID</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Date Created</th> 
          <!--th></th-->
        </thead>
        <tbody>
          <?php foreach ($users as $user) { ?>
              <tr>
                  <td><?php echo $user->admin_id; ?></td>
                  <td><?php echo $user->admin_username; ?></td>
                  <td><?php echo $user->admin_email; ?></td>
                  <td><?php echo date('jS, F Y', strtotime($user->date_created)); ?></td>
                  <!--td><a href="" data-toggle="modal" data-target="#myModal" onclick="javascript:load_houses(<?php echo $nyumba_info->id; ?>)"><i class="fa fa-pencil-square-o"></i> EDIT </a></td-->
              </tr>
          <?php } //end foreach ?>
        </tbody>
        </table>
        <?php } else{
        echo '<p class="no-info">No Users Added yet :( </p>';
        }
        ?>
      </div>
      </div>
    </div>

    <div id="myModal" class="modal fade adduser" role="dialog">
        <?php include('modal.php'); ?>
    </div>


</section>
