<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-flud">
  	    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  		    <h1 class="display-5"><?php echo $data['title']; ?></h1>
  	    </div>

  	    <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/dashboards/test">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>

        </div>

  </div>

  <?php if(hasPermission('admin')) : ?>
    <hr>
      <div class="jumbotron jumbotron-flud">
  	    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  		    <h1 class="display-5">Admin</h1>
  	    </div>
  	    <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
        <div class="row">
  	    	<div class="col-md-6">
  	    		<a href="<?php echo URLROOT; ?>/posts">More</a>
  	    	</div>
        </div>
      </div>
    <?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
