<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="nav-icon fas fa-chalkboard-teacher"></i> <b>Edit Data User</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Data User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">

                <?php foreach ($user as $u) { ?>

                  <form action="<?php echo base_url() . 'admin/userupdate'; ?>" method="post">

                    <div class="form-group">
                      <label>NPM</label>
                      <input type="number" class="form-control" name="npm" id="npm" value="<?php echo $u->npm ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $u->name ?>" required>
                    </div>
                    <input type="hidden" class="form-control" name="password" id="password" value="<?php echo $u->password ?>" required>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $u->email ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Level</label>
                      <select class="form-control" name="role_id" id="role_id" required>
                        <option value="1" <?php if ($u->role_id == 1) {
                          echo 'selected';
                        } else {
                        } ?>>Admin</option>
                        <option value="2" <?php if ($u->role_id == 2) {
                          echo 'selected';
                        } else {
                        } ?>>Dosen</option>
                        <option value="3" <?php if ($u->role_id == 3) {
                          echo 'selected';
                        } else {
                        } ?>>Mahasiswa</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>No.HP</label>
                      <input type="number" class="form-control" name="hp" id="hp" value="<?php echo $u->hp ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="is_active" id="is_active" required>
                        <option value="1" <?php if ($u->is_active == 1) {
                          echo 'selected';
                        } else {
                        } ?>>Aktif</option>
                        <option value="0" <?php if ($u->is_active == 0) {
                          echo 'selected';
                        } else {
                        } ?>>Non-Aktif</option>
                      </select>
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>

                    <input type="hidden" name="id" id="id" value="<?php echo $u->id ?>" />
                  </form>
                <?php } ?>
                <br>

              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </section>
</div>