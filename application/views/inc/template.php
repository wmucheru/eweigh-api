<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo isset($page_title) ? $page_title : ''; ?></title>
<meta name="description" content=""/>
<meta name="author" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php
    echo link_tag('favicon.png', 'shortcut icon', 'image/png');

    $styles = array(
        'assets/css/bootstrap.min.css',
        'assets/css/ionicons.min.css',
        'https://fonts.googleapis.com/css?family=Lato:400,900&display=swap',
        'assets/css/style.css?t='.date('His')
    );

    foreach($styles as $stl){
        echo link_tag($stl);
    }
?>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
<![endif]-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<?php 
    if(!$this->site_model->isLocalhost()){
        $gaCode = '';
        
        echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id=$gaCode\"></script>
        <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());gtag('config', '$gaCode');</script>";
    }
?>
</head>
<body class="site-bd <?php echo isset($body_class) ? $body_class : ''; ?>">
    <div class="clearfix wrapper">
        
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" 
                        data-target=".nav-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
        
                <div class="collapse navbar-collapse nav-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="home-lnk" href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a class="login-lnk" href="<?php echo site_url('accounts/login'); ?>">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="page-wrapper clearfix container" style="background:transparent;">
            <?php
                $this->load->view($page_content);
            ?>
        </div>
    </div>
    
    <footer>
        <div class="container clearfix text-center">
            <p>&copy; <?php echo date('Y') . '.  ' .$this->config->item('site_name') .'.'; ?></p>
        </div>
    </footer>
    <?php
        echo '<script>const siteURL = "'. site_url() .'"</script>';

        if($this->site_model->isLocalhost()){
            $this->output->enable_profiler(TRUE);
        }
        
        $scripts = array(
            'assets/js/bootstrap.min.js',
            # 'assets/plugins/bxslider/jquery.bxslider.min.js',
            'assets/js/custom.js'
        );
        
        foreach($scripts as $script){
            $url = base_url($script);
            echo "<script src=\"$url\"></script>";
        }
    ?>
</body>
</html>