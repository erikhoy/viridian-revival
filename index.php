<?php $page = "Vintage Living"; ?>
<?php include("includes/header.php"); ?>
<?php $products = Product::find_homepage_products(); ?>
<?php $reviews = Review::get_homepage_reviews(); ?>

<!-- Page Content -->
<div class="carousel-container container">
  <div class="row">
    <div class="col col-xs-12">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php 
            $n = 0;
            foreach($products as $product) {
              echo "<li data-target='#carousel-example-generic' data-slide-to='".$n."'></li>";
              $n += 1;
            }
          ?>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Wrapper for slides -->
          <?php foreach($products as $product): ?>
            <?php $image = Image::find_by_id($product->id); ?>
            <div class="item">
              <img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" alt='<?php echo $product->name; ?>'>
              <div class="carousel-caption"></div>
            </div>
          <?php endforeach; ?>
        </div>
        <script>
          $(document).ready(function(){
            $('.item:first').addClass('active');
            $('ol > li:first').addClass('active');
          });
        </script>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col col-xs-12 col-md-offset-1 col-md-4">
      <h2>Welcome to Viridian Revival!</h2>
      <p>Above is a random sampling of some of the items that we are currently selling or have already sold at our <a href="https://www.etsy.com/shop/ViridianRevival" target='_blank'>Etsy store</a>. Click to see which <a href="<?php echo 'products'.DS.'listed_products.php'; ?>">listings</a> are still available.</p>
      <p><a href="<?php echo 'contact.php'; ?>">Contact us</a> if you have any questions or are interested in purchasing any of the items available.</p>
      <h2>About Us</h2>
      <p><img src="<?php echo IMAGES_PATH.DS.'strongman.jpg'; ?>" alt="Strongman toy" width="20%" align="right">People’s trash fascinates us. We have spent many hours alley shopping and dumpster diving, finding things that aren’t quite ready for the landfill. We find vintage chairs to paint and reupholster, industrial or mechanical items become lighting, and found wood becomes Adirondack chairs, sofas, tables, benches or other furniture.</p>
      <p>As time has passed, the complexity of our projects broadened, as did our search for different materials. Increasingly, we were led to garage sales, estate sales, thrift stores and online auctions, and we found ourselves snatching up vintage items to be used for our own home decor.</p>
      <p>Over time, certain items must be let go, however painful, to make room for new acquisitions&hellip;or just to make space. There are also those items that we find in our search that we feel need to be rediscovered by people like you.</p>
      <p>We stock this store with things that we love; the things that catch our eyes on our endless search. They are the kinds of things that we would use to decorate our own spaces, because let’s face it, if it doesn’t sell, we’re &lsquo;stuck&rsquo; with it. Those things include art, housewares (clocks, collector plates, small appliances, vases, knick-knacks, lamps, dishes, sewing stuff), toys and games, sporting goods &amp; memorabilia, costume jewelry, erotica, books and comic books, tobacciana, cocktail &amp; bar supplies, gaming/gambling supplies &mdash; all vintage.</p>
    </div>
    <div class="recent col col-xs-12 col-md-6">
      <h2>Recent Reviews</h2>
      <?php foreach ($reviews as $review): ?>
        <?php $product = Product::find_by_id($review->product_id); ?>
        <?php $image = Image::find_by_id($product->id); ?>
        <div class="clearfix">
          <blockquote>
            <div class="col col-md-3">
              <img src="<?php echo IMAGES_PATH.DS.'uploads'.DS.$image->image_url; ?>" width="100">
              <div class="clearfix">
                <?php for($i=0; $i<$review->stars; $i++) { ?>
                  <span id="toggle" class="glyphicon glyphicon-star" style="color: goldenrod;"></span>
                <?php } ?>
                <?php for($i=0; $i<(5-$review->stars); $i++) { ?>
                  <span id="toggle" class="glyphicon glyphicon-star-empty" style="color: goldenrod;"></span>
                <?php } ?>
              </div>
            </div>
            <div class="col col-md-9">
              <div>
                <?php echo $product->name; ?>    
              </div>
              <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                <?php if(!empty($review->body)) { ?>
                  <span itemprop="description">&ldquo;<?php echo $review->body; ?>&rdquo;</span><br>
                <?php } ?>
                <span class="author clearfix" itemprop="author"><small><strong><?php echo $review->author; ?></strong></small></span><br>
              </div>
            </div>
          </blockquote>
        </div>
        <hr>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>