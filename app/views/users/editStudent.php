<?php require APPROOT . '/views/inc/header.php';?>
  <a href="<?php echo URLROOT; ?>/pages/view_students" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Student</h2>
    <p>Enter data with this form</p>
    <form action="<?php echo URLROOT; ?>/updates/editStudent/<?php echo $data['id']; ?>" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="mobile_tel">Mobile Telephone (+251): <sup>*</sup></label>
            <input type="tel" name="mobile_tel" class="form-control form-control-lg <?php echo (!empty($data['mobile_tel_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['mobile_tel']; ?>">
            <span class="invalid-feedback"><?php echo $data['mobile_tel_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="office_tel">Office Telephone (+251):</label>
            <input type="tel" name="office_tel" class="form-control form-control-lg" value="<?php echo $data['office_tel']; ?>">
          </div>
          <div class="form-group">
            <label for="organization">Organization:</label>
            <input type="text" name="organization" class="form-control form-control-lg" value="<?php echo $data['organization']; ?>">
          </div>
          <div class="form-group">
            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title" class="form-control form-control-lg" value="<?php echo $data['job_title']; ?>">
          </div>
          <div class="form-group">
            <label for="pobox">P.O. Box:</label>
            <input type="text" name="pobox" class="form-control form-control-lg" value="<?php echo $data['pobox']; ?>">
          </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php';?>