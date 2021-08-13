<?php
    session_start();
    include_once("layout/header.php");

    if (isset($_SESSION['nama'])) {
        header('Location: home.php');
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
                    <h3 class="text-center fw-bold">Masuk</h3>
                    <form class="p-3" method="post" action="actions/login_action.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger bg-red fw-bold">Login</button>
                        </div>
                        <hr>
                        <p class="text-center">
                            Belum punya akun? <a href="daftar.php"
                                class="text-danger fw-bold text-decoration-none">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once("layout/footer.php");