<?php require APPROOT . '/views/inc/header.php';?>
<?php flash('info');?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    </div>
  </div>
    <div class="card-group">
      <?php foreach ($data['rows'] as $result):?>
          <div class="card" style="margin: 25px;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $result['Name']?></h5>
              <p class="card-text"><?php echo $result['Description']?></p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        <?php endforeach ?>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php';?>
