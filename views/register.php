<?php
$this->title = 'Register';
$c=0
?>
        <!-- return ['firstName', 'lastName', 'username', 'password', 'user_type','email', 'address', 'status']; -->


<!-- register.html -->
<body class="register-page bg-body-secondary">
  <div class="register-box">
    <div class="register-logo">
      <a href="#"><b>HARDIK</b>TRADERS</a>
    </div>
    <!-- /.register-logo -->
    <div class="card">
      <div class="card-body register-card-body">
        <form action="" method="post" id="registrationform" >
            <!-- Name -->
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                        <input 
                        type="text" 
                        class="form-control <?= $model->hasError('firstName') ? 'is-invalid' : '' ?>" 
                        placeholder="First Name" 
                        name="firstName"
                        id="firstName"
                        value="<?= htmlspecialchars($model->firstName) ?>"
                        />
                        <input 
                        type="text" 
                        class="form-control <?= $model->hasError('lastName') ? 'is-invalid' : '' ?>" 
                        placeholder="Last Name" 
                        name="lastName"
                        id="lastName"
                        value="<?= htmlspecialchars($model->lastName) ?>"
                        />
                        
                    </div>
                    <?php if ($model->hasError('firstName')):  $c = 1;?>
                        <div class="text-danger small ms-1"><?= $model->getFirstError('firstName')?></div>
                    <?php else: $c=0;
                    endif; ?>
                    <?php if ($model->hasError('lastName') && $c != 1 ): ?>
                        <div class="text-danger small ms-1"><?= $model->getFirstError('lastName') ?></div>
                    <?php endif; ?>
                    
          <!-- Username Field -->
          <div class="input-group mb-3">
            <div class="input-group-text"><span>@</span></div>
            <input 
              type="text" 
              class="form-control <?= $model->hasError('username') ? 'is-invalid' : '' ?>" 
              placeholder="Username" 
              name="username"
              id="username"
              value="<?= htmlspecialchars($model->username) ?>"
            />
            
          </div>
          <?php if ($model->hasError('username')): ?>
            <div class="text-danger small ms-1"><?= $model->getFirstError('username') ?></div>
          <?php endif; ?>

          <!-- Password Field -->
          <div class="input-group mb-3">
            <div class="input-group-text"><span class="bi bi-lock"></span></div>
            <input 
              type="password" 
              class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>" 
              placeholder="Password" 
              name="password"
              id="password"
              value="<?= htmlspecialchars($model->password) ?>"
            /> 
          </div>
          <?php if ($model->hasError('password')): ?>
            <div class="text-danger small ms-1"><?= $model->getFirstError('password') ?></div>
          <?php endif; ?>

          <!-- Conform Password Field -->
          <div class="input-group mb-3">
            <div class="input-group-text"><span class="bi bi-lock"></span></div>
            <input 
              type="password" 
              class="form-control <?= $model->hasError('conform_password') ? 'is-invalid' : '' ?>" 
              placeholder="Retype Password" 
              name="conform_password"
              id="conform_password"
              value="<?= htmlspecialchars($model->conform_password) ?>"
            /> 
          </div>
          <?php if ($model->hasError('conform_password')): ?>
            <div class="text-danger small ms-1"><?= $model->getFirstError('conform_password') ?></div>
          <?php endif; ?>

          <!-- user_type Field -->
           <div class="input-group mb-3">   
            <div class="input-group-text"><span>Role</span></div>
            <select name="user_type" id="user_type" style="width: 82%;" class="form-control <?= $model->hasError('user_type') ? 'is-invalid' : '' ?>" >
                <option value="" selected disabled>Select your role</option>
                <option value="c">Customer</option>
                <option value="s">Supplier</option>
                <option value="m">Manufacturer</option>
            </select>
           </div>
           <?php if ($model->hasError('user_type')): ?>
            <div class="text-danger small ms-1"><?= $model->getFirstError('user_type') ?></div>
          <?php endif; ?>

           <!-- Email Field -->
          <div class="input-group mb-3">
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            <input 
              type="email" 
              class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>" 
              placeholder="Email" 
              name="email"
              id="email"
              value="<?= htmlspecialchars($model->email) ?>"
            /> 
          </div>
          <?php if ($model->hasError('email')): ?>
            <div class="text-danger small ms-1"><?= $model->getFirstError('email') ?></div>
          <?php endif; ?>

          <!-- address -->
           <div class="input-group mb-3">
            <div class="input-group-text"><span class="bi bi-pin-map"></span></div>
              <textarea
                class="form-control <?= $model->hasError('address') ? 'is-invalid' : '' ?>" 
                placeholder="Address" 
                name="address"
                id="address"
                rows="5"
                cols="auto"
              ><?= htmlspecialchars($model->address) ?></textarea>
            </div>
            <?php if ($model->hasError('address')): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('address') ?></div>
            <?php endif; ?>

          <!-- Remember Me & Submit -->
          <!-- <div class="row">
            <div class="col-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember" />
                <label class="form-check-label" for="flexCheckDefault">I agree to the terms</label>
              </div>
            </div>
            <div class="col-4"> -->
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            <!-- </div>
          </div> -->
        </form>
          <a href="/login" class="text-center">I already have a membership</a>
        </p>
      </div>
    </div>
  </div>
</body>