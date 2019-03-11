<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['user_id'])  && ($_SESSION['user_role'] == 'Admin')): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Add Content</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/add_course">Courses</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/add_certificate">Certificates</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">View Content</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/view_students">Students</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/view_teachers">Teachers</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/view_admins">Admins</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/view_courses">Courses</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/view_certificates">Certificates</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Register</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/registerStudent">Student</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/registerTeacher">Teacher</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/registerAdmin">Admin</a>
            </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </li>
          <?php elseif (isset($_SESSION['user_id']) && ($_SESSION['user_role'] == 'Student' || $_SESSION['user_role'] == 'Teacher')) : ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </li>
          <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
          </li>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </nav>