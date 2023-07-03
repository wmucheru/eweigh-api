<div class="clearfix login-box row">
    <div class="col-sm-7 login-banner"></div>
    <div class="col-sm-5 login-form">
        <?php 
            echo form_open('auth/login_proc', array('class'=>'form-horizontal'));
        ?>
        <h4 style="text-transform:uppercase; font-size:0.9em;">Log in to your account</h4><br/>
        <div class="form-group">
            <?php
                echo $this->site_model->setFlashdataMessages('login');
            ?>
            <input type="text" class="form-control" name="email" placeholder="E-mail Address" autofocus/>
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password"/>
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-block">LOG IN</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
