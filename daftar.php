<?php
    include_once("layout/header.php")
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
                    <form class="p-3" method="post" action="daftar2.php" id="form-daftar1">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                id="password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password2"
                                id="password2" onkeyup="checkConfirmPassword()">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger bg-red fw-bold">Selanjutnya
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                </svg>
                            </button>
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