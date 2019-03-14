<?php require APPROOT . '/views/inc/header.php';?>
<?php flash('info');?>
  <!-- <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    </div>
  </div> -->
  <!-- <img src="./4.jpg" alt="Image not found"/> -->
    <div class="card-columns">
      <?php foreach ($data['rows'] as $result):?>
          <div class="card" style="margin: 25px;">
            <!-- <img src="/<?php echo $result['image_directory']?>" class="card-img-top" alt="Image not found"/> -->
            <img src="https://cdn0.tnwcdn.com/wp-content/blogs.dir/1/files/2018/05/Wyvern-programming-languages-in-one.jpg" class="card-img-top" alt="Image not found"/>
            <!-- <img src="file:///C:/xampp/htdocs/itsc/public/img/DLD.png" class="card-img-top" alt="Image not found"/> -->
            <div class="card-body">
              <h5 class="card-title"><?php echo $result['Name']?></h5>
              <p class="card-text"><?php echo $result['Description']?></p>
              <p class="card-text"><small class="text-muted">Next start date: </small></p>
            </div>
          </div>
        <?php endforeach ?>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php';?>
