<div class="clearfix">
    <div class="container">
        <div class="row intro">
            <div class="col-sm-7 intro-info">
                <?php
                    echo img("assets/img/eweigh-logo.png", '', 'class="img-responsive logo"');

                    $siteName = $this->config->item('site_name');

                    echo "<h1>$siteName App</h1>";
                ?>
                <ul>
                    <li>Estimate the liveweight (LW) of cattle using a heart-girth measurement.</li>
                    <li>Easy farmer registration</li>
                    <li>Register and track your cattle's weight</li>
                    <li>Calculate food rations for best cattle health</li>
                </ul>

                <?php
                    $img = img("assets/img/google-play.png", '', 'class="img-responsive google-play"');
                    echo anchor('https://play.google.com/store/apps/details?id=org.ilri.eweigh', $img, '');
                ?>
            </div>
            <div class="col-sm-5">
                <?php
                    echo img("assets/img/phone.jpg", '', 'class="img-responsive" style="margin:0 auto; max-width:20em;"');
                ?>
            </div>
        </div>
    </div>
</div>