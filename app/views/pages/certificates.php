<?php require APPROOT . '/views/inc/header.php';?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Add a certificate</h2>
        <p>Please fill out this form to add a certificate</p>
        <form action="<?php echo URLROOT; ?>/pages/add_certificate" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="vendor">Vendor: <sup>*</sup></label>
            <input type="text" name="vendor" class="form-control form-control-lg <?php echo (!empty($data['vendor_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vendor']; ?>">
            <span class="invalid-feedback"><?php echo $data['vendor_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control form-control-lg" value="<?php echo $data['description']; ?>">
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Submit" class="btn btn-success btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php';?>