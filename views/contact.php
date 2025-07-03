<?php
$this->title = "Contact Us"
?>
<div class="contactus-box">
  <div class="card">
    <div class="card-body login-card-body">
      <div class="row">
        <!-- Left Info Panel -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center border-end mb-3 mb-md-0">
          <h2><strong>HARDIK</strong> TRADERS</h2>
          <p>
            <a href="https://www.google.com/maps/dir//215,+Swaminaryan+Complex,+Opposite+Madhubaug,+Sarangpur,+Sarangpur,+Ahmedabad,+Gujarat+380002/@23.0190878,72.5187342,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x395e85cd3aaaaaab:0x5880a827f528d1be!2m2!1d72.6011358!2d23.0191091?entry=ttu&g_ep=EgoyMDI1MDUxNS4xIKXMDSoASAFQAw%3D%3D">215, Swaminaryan Complex, Opposite Madhubaug, <br> Sarangpur, Ahmedabad, Gujarat 380002<br></a>
            Phone:<br>
            <a class="icon-link icon-link-hover link-underline-opacity-25" href="tel:+919427416208"><i class="bi bi-telephone-outbound-fill"></i>Hardik Shah</a><br>
            <a class="icon-link icon-link-hover link-underline-opacity-25" href="tel:+91947329028"><i class="bi bi-telephone-outbound-fill"></i>Hardik Shah</a><br>
            <a class="icon-link icon-link-hover link-underline-opacity-25" href="tel:+919904788108"><i class="bi bi-telephone-outbound-fill"></i>Parshva Shah</a><br>
          </p>
        </div>

        <!-- Right Form Panel -->
        <div class="col-md-6">
          <form action="" method="post" id="loginform">
            <!-- Username Field -->
            <div class="mb-3">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control <?= $model->hasError('name') ? 'is-invalid' : '' ?>"
                  placeholder="Name"
                  name="name"
                  id="name"
                  value="<?= htmlspecialchars($model->name) ?>" />
              </div>
              <?php if ($model->hasError('name')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('name') ?></div>
              <?php endif; ?>
            </div>

            <!-- email Field -->
            <div class="mb-3">
              <div class="input-group">
                <input
                  type="email"
                  class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>"
                  placeholder="Email"
                  name="email"
                  id="email"
                  value="<?= htmlspecialchars($model->email) ?>" />
              </div>
              <?php if ($model->hasError('email')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('email') ?></div>
              <?php endif; ?>
            </div>

            <!-- subject Field -->
            <div class="mb-3">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control <?= $model->hasError('subject') ? 'is-invalid' : '' ?>"
                  placeholder="Subject"
                  name="subject"
                  id="subject"
                  value="<?= htmlspecialchars($model->subject) ?>" />
              </div>
              <?php if ($model->hasError('subject')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('subject') ?></div>
              <?php endif; ?>
            </div>

            <!-- Body Field -->
            <div class="mb-3">
              <div class="input-group">
                <textarea
                  class="form-control <?= $model->hasError('body') ? 'is-invalid' : '' ?>"
                  placeholder="Body"
                  name="body"
                  id="body"
                  rows="5"
                  cols="auto"><?= htmlspecialchars($model->body) ?></textarea>
              </div>
              <?php if ($model->hasError('body')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('body') ?></div>
              <?php endif; ?>
            </div>


            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>