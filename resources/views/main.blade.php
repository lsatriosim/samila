<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAMILA - Sistem Anti Money Laundering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

</html>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand text-white m-3">
                SAMILA : Sistem Anti Money-Laundering
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="container">
            <h1 class="text-center my-5">Welcome to SAMILA</h1>
            <p class="m-lg-3 text-center">Selamat datang, SAMILA merupakan aplikasi yang menggunakan kecerdasan buatan
                untuk mendeteksi tindak money laundering</p>
            <p class="m-lg-3 text-center">Silahkan unggah laporan keuangan yang dicurigai terdapat tindak pencucian uang
            </p>

            <div class="col-lg-8 mx-auto my-5">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br />
                        @endforeach
                    </div>
                @endif

                <form action="/upload" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <b>File Laporan Keuangan</b><br />
                        <input type="file" id="file" name="file" class="mt-lg-3">
                    </div>

                    <input type="submit" value="Upload" class="btn btn-primary mt-lg-3" onclick="uploadFiles()">
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        <h4>Suspicious Account</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>User Account</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suspiciousAccounts as $s)
                    <tr>
                        <td>{{ $s->userAccount }}</td>
                        <td><a href="/detail/{{ $s->userAccount }}"><button class="btn btn-primary">See
                                    Detail</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";
        import { getStorage, ref, uploadBytes } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-storage.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCWt9YPVeKdf6EyfPTpwlWEePUeKfLvszU",
  authDomain: "samila-f1f2a.firebaseapp.com",
  projectId: "samila-f1f2a",
  storageBucket: "samila-f1f2a.appspot.com",
  messagingSenderId: "188172396902",
  appId: "1:188172396902:web:d6bb8592d9254e92ab80a7",
  measurementId: "G-817CFXFRJT"
};

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const storage = getStorage(app);
        // const storageRef = ref(storage)
        // const file = ref(storage, 'UserAccount');


        console.log("test");
        uploadBytes(file,document).then((snapshot) => {
           console.log("Uploaded a blob or file!");
        }).catch((err) => {
            console.log("Upload error" + err);
        });
      </script>
</body>
