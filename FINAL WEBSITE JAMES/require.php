<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <title>Everything La Trinidad</title>
</head>

<body>

   
    <!-- header section starts  -->

    <header class="header">

        <a href="index.html" class="logo"> <i class="ri-map-pin-fill"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="Logged-in-Page/LIP-login.php">Booking</a>
            <a href="services.html">services</a>
            <a href="news.html">news</a>
            <a href="maps.html">maps</a>
        </nav>

        <div class="icons">
            <div id="search-btn" class="ri-search-line"></div>
            <div id="login-btn" class="ri-user-line"></div>
            <script>
                document.querySelector('#login-btn').onclick = () => {
                    window.location.href = 'profile.php';
                }
            </script>
            <div id="notif-btn" class="ri-notification-2-line"></i>
        </div>

    </header>

    <!-- header section ends  -->


    <!-- search-form start -->

    <section class="search-form-container">

        <form action="">
            <input type="search" placeholder="search here..." id="search-box">
            <label for="search-box" class="ri-search-line"></label>
        </form>

    </section>

    <section>
        <div class="see-more-btn">
            <a class="btn" href="Logged-in-Page/LIP-login.php" id="see-more">Login Here</a>
        </div>
    </section>

</body>
</html>