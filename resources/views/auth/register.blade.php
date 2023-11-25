<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <!----------------------- Main Container -------------------------->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box bg-primary shadow-md">
           <div class="featured-image mb-3">
            <img src="/assets/img/DigiTek.png" class="img-fluid rounded-3" style="width: 100%; height:100%">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Healty Poliklinik</p>
           
       </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Hello,Again</h2>
                     <p>We are happy to have you back.</p>
                </div>
                <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="nama" name="name">
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password Confirmation" name="password_confirmation">
                </div>
                <div class="input-group">
                <select class="form-select form-select-lg bg-light fs-6 mb-3" aria-label="Large select example" name="sekolah_id">
                    <option disabled selected>Pilih Sekolah</option>
                    @foreach ($sekolahs as $sekolah)
                    <option value="{{ $sekolah->id }}">{{ $sekolah->nama }}</option>
                    @endforeach
                </select>
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                    </div>
                    <div class="forgot">
                        <small><a href="#">Forgot Password?</a></small>
                    </div>
                </div>
                <input type="text" value="user" name="role" hidden>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6" value="register">Daftar</button>
                </div>
                </form>
          </div>
       </div> 
      </div>
    </div>
</body>
</html>