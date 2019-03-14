<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?php echo URLROOT; ?>/pages/view_courses" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
  <h2>Edit Course</h2>
    <p>Enter data with this form</p>
    <form action="<?php echo URLROOT; ?>/updates/editCourse/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="description">Description: <sup>*</sup></label>
            <input type="text" name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="imageUpload">Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Submit" class="btn btn-success btn-block">
            </div>
      </div>
    </form>
<?php require APPROOT . '/views/inc/footer.php';?>