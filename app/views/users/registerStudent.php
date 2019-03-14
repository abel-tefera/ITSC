<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Register Student</h2>
        <p>Please fill out this form to register the student</p>
        <!-- <form action="<?php echo URLROOT; ?>/users/registerStudent" method="post" enctype="multipart/form-data"> -->
        <form action="<?php echo URLROOT; ?>/users/registerStudent" method="post" enctype="multipart/form-data">
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
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
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
          <div class="form-group">
            <label for="imageUpload">Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <!-- <div class="form-group">
            <label for="imageUpload">Image:</label>
            <input type="file" name="imageUpload" class="btn btn-outline-secondary" id="imageUpload" aria-describedby="imageUpload">
          </div> -->
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Register" class="btn btn-success btn-block">
            </div>
            <!-- <div class="col">
              <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
            </div> -->
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>