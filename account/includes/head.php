
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Paypertag user Dashboard account">
  <meta name="author" content="Navjot singh">
  
  <?php
  	
    if(!empty($_SESSION['loggedin']))     
    {
        echo ' <title>Tagger Dashboard</title>';
    }
    else
    {
        echo '<title>Login | Register</title>';
    }
  ?>
 
  
  
  <!-- Extra details for Live View on GitHub Pages -->
 
  <!-- Favicon -->
  <link rel="icon" href="https://paypertag.tk/account/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
  
  <!-- Argon CSS -->
  <link rel="stylesheet" href="https://paypertag.tk/account/assets/css/argon.mine209.css?v=1.0.0" type="text/css">
  
  
  