<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Custom styles */
    body {
      background: url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;
      height: 100vh;
      margin: 0;
    }

    .thank-you-container {
      background: rgba(255, 255, 255, 0.85); /* Translucent white background */
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    .thank-you-icon {
      font-size: 4rem;
      color: #28a745; /* Success green */
      position: relative;
    }

    /* Particle styles */
    .particle {
      position: absolute;
      width: 10px;
      height: 10px;
      background-color: #28a745;
      border-radius: 50%;
      opacity: 0;
      animation: burst 1s ease-out infinite;
    }

    @keyframes burst {
      0% {
        transform: translate(0, 0) scale(1);
        opacity: 1;
      }
      100% {
        transform: translate(calc(150px * var(--x)), calc(150px * var(--y))) scale(0.5);
        opacity: 0;
      }
    }

    /* Helper styles for centering particles around the icon */
    .particle:nth-child(1) { --x: 1; --y: 1; }
    .particle:nth-child(2) { --x: -1; --y: 1; }
    .particle:nth-child(3) { --x: 1; --y: -1; }
    .particle:nth-child(4) { --x: -1; --y: -1; }
    .particle:nth-child(5) { --x: 0; --y: 1; }
    .particle:nth-child(6) { --x: 0; --y: -1; }
    .particle:nth-child(7) { --x: 1; --y: 0; }
    .particle:nth-child(8) { --x: -1; --y: 0; }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center thank-you-container">
      <!-- Particles for animation -->
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>

      <i class="fa-solid fa-check-circle thank-you-icon"></i>
      <h1 class="mt-3">{{ Session::get('success') }}</h1>
      <h5 class="mt-2">Thank you for your request. We will be in touch within 72 Hours. Thank you for your patience.</h5>
      <a href="{{route('home')}}" class="btn btn-primary mt-3">Go to Homepage</a>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FontAwesome Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
