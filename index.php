<!DOCTYPE html>
<?php parse_str($_SERVER['QUERY_STRING']); 
if (isset($path)) {
    $path = explode('/', $path);
}
$base = "http://contactinformatie.v-ict-or.be/";
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contactinformatie</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo $base; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $base; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?php echo $base; ?>dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="skin-blue sidebar-collapse">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">Contactinformatie</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Contactinformatie</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
	  <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Introductie <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Welke informatie?</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Voor wie? <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Voor lokale besturen</a></li>
                    <li><a href="#">Voor burgers</a></li>
                    <li><a href="#">Voor ontwikkelaars</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                
              </form>                          
            </div><!-- /.navbar-collapse -->

         
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar sidebar-collapse">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">GEMEENTE</li>
            <!-- Optionally, you can add icons to the links -->
            <?php if ($path[1] == "destelbergen") { print('<li class="active">'); } else { print('<li>'); } ?><a href="/producten/destelbergen"><i class='fa fa-university'></i> <span>Destelbergen</span></a></li>
            <?php if ($path[1] == "gent") { print('<li class="active">'); } else { print('<li>'); } ?><a href="/producten/gent"><i class='fa fa-university'></i> <span>Gent</span></a></li>
            <?php if ($path[1] == "ingelmunster") { print('<li class="active">'); } else { print('<li>'); } ?><a href="/producten/ingelmunster"><i class='fa fa-university'></i> <span>Ingelmunster</span></a></li>
            <?php if ($path[1] == "kortrijk") { print('<li class="active">'); } else { print('<li>'); } ?><a href="/producten/kortrijk"><i class='fa fa-university'></i> <span>Kortrijk</span></a></li>
            <?php if ($path[1] == "roeselare") { print('<li class="active">'); } else { print('<li>'); } ?><a href="/producten/roeselare"><i class='fa fa-university'></i> <span>Roeselare</span></a></li>
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          
          
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <?php if (empty($path)): ?>
          <h1>
            Introductie
            <small>Contactinformatie voor lokale besturen</small>
          </h1>
        <?php endif; ?>
        <?php if ($path[0] == "producten"): ?>
          <h1>
            <?php print($path[1]); ?>
            <small>Producten</small>
          </h1>
        <?php endif; ?>
        </section>
        
        
        
        <!-- Main content -->
        <section class="content">
        <?php if (empty($path)) {
            // No path, load introduction
            require 'introduction.html';
        } elseif ($path[0] == "data") {
            // Load Data overview
            require 'data.php';
        } elseif ($path[0] == "producten") {
            // Load products
            $productstring = file_get_contents($base . "data/" . $path[1] . ".json");
            $products = json_decode($productstring);
            ?>
            
            <p class="marge">Deze producten werden gevonden voor <?php echo $path[1]; ?>. Klik een product aan om contactinformate te raadplegen.</p>
            
            <?php
            foreach ($products as $product) {
                $product = (array) $product;
                ?>
                <div class="row">
                <div class="col-md-12">
                  <div class="box collapsed-box">
                    <div class="box-header with-border">
                      <h3 class="box-title" data-widget="collapse"><?php echo $product['?title'] ?></h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">

                      </div><!-- /.row -->
                    </div><!-- ./box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
                </div><!-- /.row -->
                <?php
            }
        }
        ?>
        


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <a href="http://www.v-ict-or.be">V-ICT-OR</a>&nbsp;|&nbsp;
            <a href="http://www.bestuurszaken.be">BESTUURSZAKEN</a>&nbsp;|&nbsp;
            <a href="http://www.vdab.be">VDAB</a>&nbsp;|&nbsp;
            <a href="http://www.iminds.be">IMINDS</a>
        </div>
        <!-- Default to the left -->
        &nbsp;
      </footer>
      
      
     
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $base; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $base; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $base; ?>dist/js/app.min.js" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>
