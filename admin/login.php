<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php'); ?>
<body class="hold-transition login-page">
  <script>
    start_loader();
  </script>
  <style>
    body {
      <?php 
        $cover = $_settings->info('cover');
        $cover_url = (!empty($cover) && is_file(base_app . $cover)) ? validate_image($cover) : base_url . 'uploads/cover-1637723881.png';
      ?>
      background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)), url("<?php echo $cover_url; ?>");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .login-title {
      color: #fff;
      font-weight: 800;
      letter-spacing: -0.5px;
      margin-bottom: 25px;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }
    .login-box {
      width: 440px;
      max-width: 92%;
    }
    .card-login {
      background: rgba(30, 41, 59, 0.92);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 16px;
      box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4);
      color: #f1f5f9;
      overflow: hidden;
    }
    .card-header-custom {
      background: transparent;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      padding: 24px 20px 18px 20px;
    }
    .form-control-custom {
      background: rgba(15, 23, 42, 0.7) !important;
      border: 1px solid #475569 !important;
      color: #fff !important;
      height: 48px;
      border-radius: 10px;
    }
    .form-control-custom:focus {
      border-color: #38bdf8 !important;
      box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25) !important;
    }
    .input-group-text-custom {
      background: rgba(15, 23, 42, 0.7);
      border: 1px solid #475569;
      color: #94a3b8;
      border-radius: 10px;
    }
    .btn-submit {
      background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
      border: none;
      height: 48px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
      color: #fff;
      box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
      transition: all 0.2s ease;
    }
    .btn-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(14, 165, 233, 0.6);
      color: #fff;
    }
    .quick-creds {
      background: rgba(15, 23, 42, 0.6);
      border: 1px dashed rgba(148, 163, 184, 0.3);
      border-radius: 10px;
      padding: 10px 14px;
    }
  </style>

  <h1 class="text-center login-title">
    <i class="fas fa-ring text-warning mr-2"></i><b><?php echo htmlspecialchars($_settings->info('name') ?: 'Online Marriage Registration System'); ?></b>
    <span class="d-block text-sm font-weight-normal text-cyan mt-1">Administrator Portal</span>
  </h1>

  <div class="login-box">
    <div class="card card-login">
      <div class="card-header card-header-custom text-center">
        <h3 class="mb-0 font-weight-bold" style="color: #38bdf8;">
          <i class="fas fa-shield-alt mr-2"></i>Admin Authentication
        </h3>
        <p class="text-muted small mb-0 mt-1">Sign in to manage registrations and system settings</p>
      </div>

      <div class="card-body p-4">
        <form id="login-frm" action="" method="post">
          
          <!-- Username Input -->
          <div class="form-group mb-3">
            <label class="small text-muted font-weight-bold mb-1">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text input-group-text-custom" style="border-right: none; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                  <i class="fas fa-user"></i>
                </span>
              </div>
              <input type="text" class="form-control form-control-custom" autofocus name="username" id="username_input" placeholder="admin" value="admin" style="border-left: none; border-top-left-radius: 0; border-bottom-left-radius: 0;" required>
            </div>
          </div>

          <!-- Password Input -->
          <div class="form-group mb-3">
            <label class="small text-muted font-weight-bold mb-1">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text input-group-text-custom" style="border-right: none; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                  <i class="fas fa-lock"></i>
                </span>
              </div>
              <input type="password" class="form-control form-control-custom" name="password" id="password_input" placeholder="••••••••" value="admin123" style="border-left: none; border-right: none; border-radius: 0;" required>
              <div class="input-group-append">
                <button type="button" class="btn input-group-text input-group-text-custom" id="toggle_password" style="border-left: none; border-top-left-radius: 0; border-bottom-left-radius: 0;" title="Toggle Password">
                  <i class="fas fa-eye" id="pw_icon"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Quick 1-Click Credentials Helper -->
          <div class="quick-creds mb-3 d-flex justify-content-between align-items-center">
            <small class="text-muted">
              <i class="fas fa-key text-warning mr-1"></i> Default: <code>admin</code> / <code>admin123</code>
            </small>
            <button type="button" id="autofill_btn" class="btn btn-xs btn-outline-info py-0 px-2" style="border-radius: 12px; font-size: 11px;">
              <i class="fas fa-magic mr-1"></i> Fill Form
            </button>
          </div>

          <!-- Submit Button -->
          <div class="mb-3">
            <button type="submit" class="btn btn-block btn-submit">
              <i class="fas fa-sign-in-alt mr-2"></i> Sign In to Dashboard
            </button>
          </div>

        </form>

        <!-- Auxiliary Links -->
        <div class="d-flex justify-content-between align-items-center pt-2 border-top border-secondary mt-3">
          <a href="<?php echo base_url; ?>index.php" class="text-muted small">
            <i class="fas fa-home mr-1"></i> Client Portal
          </a>
          <a href="<?php echo base_url; ?>db_setup.php" class="text-info small" title="Database Health Check & Importer">
            <i class="fas fa-database mr-1"></i> DB Health Check
          </a>
        </div>

      </div>
    </div>

    <!-- Small Footer Note -->
    <p class="text-center text-muted small mt-3">
      &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($_settings->info('name') ?: 'Online Marriage Registration System'); ?>.
    </p>
  </div>

  <!-- jQuery & AdminLTE Scripts -->
  <script src="<?php echo base_url; ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url; ?>dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function(){
      end_loader();

      // Toggle password visibility
      $('#toggle_password').click(function(){
        var pwInput = $('#password_input');
        var icon = $('#pw_icon');
        if (pwInput.attr('type') === 'password') {
          pwInput.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          pwInput.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      // 1-Click Auto Fill button
      $('#autofill_btn').click(function(){
        $('#username_input').val('admin');
        $('#password_input').val('admin123');
        if (typeof alert_toast === 'function') {
          alert_toast("Admin credentials filled!", "success");
        }
      });
    });
  </script>
</body>
</html>
