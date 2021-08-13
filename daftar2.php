<?php
    include_once("layout/header.php");

    if ($_POST['password'] != $_POST['password2']) {
        header('Location: daftar.php');
    }
?>
<div class="container vh-100">
    <div class="row h-100 align-items-center">
        <div class="col-8">
            <img src="assets/register dan login/ilustrasi_login_register.png" alt="ilus" class="img-fluid">
        </div>
        <div class="col">
            <div class="card border-cstm-rounded shadow-sm">
                <div class="card-body pt-5 pb-4">
                    <h3 class="text-center fw-bold">Daftar</h3>
                    <form class="p-3" method="post" action="actions/daftar_action.php">
                        <input type="hidden" name="email" value="<?= $_POST['email'] ?>">
                        <input type="hidden" name="password" value="<?= $_POST['password'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="nama">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="jenis_kelamin" name="jenis_kelamin">
                                    <option value="Laki-laki" selected>Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control" aria-label="nomor_hp"
                                    aria-describedby="basic-addon1" name="nomor_hp">
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <a href="daftar.php" class="btn btn-outline-danger fw-bold">Kembali</a>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger bg-red fw-bold">Daftar</button>
                        </div>
                        <hr>
                        <p class="text-center">
                            Sudah punya akun? <a href="login.php"
                                class="text-danger fw-bold text-decoration-none">Masuk</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once("layout/footer.php");