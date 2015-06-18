<?php

// Producten queried, load products for city
$cities = array('ingelmunster', 'roeselare', 'kortrijk', 'gent', 'destelbergen');
foreach ($cities as $city) {
    $productstring = file_get_contents($base . "data/" . $city . ".json");
    $products = json_decode($productstring);
    ?>

    <h1>Producten voor<?php echo $city; ?></h1>

    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Overzicht Producten</h3>
          <div class="box-tools">
            <div class="input-group" style="width: 150px;">
              <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search"/>
              <div class="input-group-btn">
                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Productencatalogus</th>
              <th>Productencatalogus ID</th>
              <th>Organisatie</th>
            </tr>
          <?php foreach ($products as $product) {
              $product = (array) $product;
              print('<tr>');
              // get ID
              $pid = (preg_match("/\/([a-zA-Z0-9]+)$/", $product['?product'], $matches)) ? $matches[1] : $product['?product']; 
              print('<td><a href="' . $product['?product'] . '" target="_blank">' . $pid . '</a></td>');
              // Get title
              print('<td>' . $product['?title'] . '</td>');
              // Get productencatalogus
              if (array_key_exists('?type', $product)) {
                  print('<td><span class="label label-success">Ja</span></td>');
              } else {
                  print('<td><span class="label label-danger">Nee</span></td>');
              }
              // Get productencatalogus ID
              $pcid = (preg_match("/\/(\d+)$/", $product['?type'], $matches)) ? $matches[1] : "";
              print('<td><a href="' . $product['?type'] . '" target="_blank">' . $pcid . '</a></td>');
              print('<tr>');
          }
          ?>  
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    </div>
<?php 
}
?>