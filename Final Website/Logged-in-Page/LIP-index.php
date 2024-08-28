<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: LIP-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="image/ELT.png" />

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <!-- remix icon cdn link  -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css" />
    <script>
    window.history.pushState(null, "", window.location.href);        
    window.onpopstate = function() {
        window.history.pushState(null, "", window.location.href);
    };
</script>
    <title>Everything La Trinidad</title>
  </head>
  <body>
    <!-- header section starts  -->

    <header class="header">
      <a href="./LIP-index.php" class="logo"
        ><i class="ri-map-pin-fill"></i><span>Everything La Trinidad</span></a
      >

      <ul class="navbar">
        <li><a href="LIP-index.php" class="active">Home</a></li>
        <li><a href="LIP-index.php#about">About</a></li>
        <li><a href="LIP-choose-tourguide.php">Booking</a></li>
        <li><a href="LIP-services.html">Services</a></li>
        <li><a href="LIP-news.html">News</a></li>
        <li>
          <a href="LIP-logout.php" class="btn-warning">Logout</a>
        </li>
      </ul>

      <div class="icons">
        <a href="../index.php" class="chat"
          ><span><i class="ri-chat-3-line" aria-hidden="true"></i></span
          ><span>Chat</span></a>

        <a href="LIP-profile.php" class="login"
          ><span><i class="ri-user-line"></i></span><span>Profile</span></a>

        <a href="./LIP-maps.html" class="map"><span><i class="ri-map-pin-line"></i></span><span>Map</span></a>

        <a href="./LIP-notification.html" class="notification"><span><i class="ri-notification-line"></i></span><span>Notif</span></a>

        <div class="bx bx-menu" id="menu-icon"></div>


      </div>
    </header>
    <!-- header section ends  -->

    <!-- search-form start -->

    <!-- search-form end -->

    <!-- home section starts  -->

    <section class="home" id="home">
      <div class="content">
        <span>&nbsp &nbsp &nbsp &nbsp Welcome to Everything La Trinidad</span>
        <h3>Exploring the Municipality With a Touch of Tranquility</h3>
        <p>
          Filled with natural resources and covered with beautiful forestry,
          visit La Trinidad and get away from busy streets and concrete jungles.
        </p>
        <a href="LIP-popular.html" class="btn">Check it out!</a>
      </div>

      <div class="image">
        <img src="image/home-image.png" alt="" class="home-img" />
        <img
          src="image/home-parallax-img.png"
          alt=""
          class="home-parallax-img"
        />
      </div>
    </section>

    <!-- custom js file link  -->
    <script>
      document.querySelector(".home").onmousemove = (e) => {
        let x = (window.innerWidth - e.pageX * 2) / 90;
        let y = (window.innerHeight - e.pageX * 2) / 90;

        document.querySelector(
          ".home .home-parallax-img"
        ).style.transform = `translateX(${y}px) translateY(${x}px)`;
      };

      document.querySelector(".home").onmouseleave = () => {
        document.querySelector(
          ".home .home-parallax-img"
        ).style.transform = `translateX(0px) translateY(0px)`;
      };
    </script>

    <!-- home section ends  -->

    <!-- category section starts  -->

    <section class="category">
      <a href="LIP-dashboard-cafe.html" class="box">
        <img src="image/cafe.png" alt="" />
        <h3>Cafe</h3>
      </a>

      <a href="LIP-dashboard-restaurant.html" class="box">
        <img src="image/restaurant.png" alt="" />
        <h3>Restaurant</h3>
      </a>

      <a href="LIP-dashboard-hotel.html" class="box">
        <img src="image/hotel.png" alt="" />
        <h3>Accommodations</h3>
      </a>

      <a href="LIP-dashboard-touristspot.html" class="box">
        <img src="image/landmark.png" alt="" />
        <h3>Tourist Spots</h3>
      </a>
    </section>

    <!-- category section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">
      <div class="image">
        <img src="image/stobely.png" alt="" />
      </div>

      <div class="content">
        <span>Everything La Trinidad</span>
        <h3 class="title">Why La Trinidad?</h3>
        <p>
          We selected this municipality as the ideal location to launch our
          touring and booking app due to its limited exposure in the tourism
          industry. By focusing on an area that has yet to fully harness its
          potential, we aim to bring attention to hidden gems and create new
          opportunities for local businesses. Our innovative platform is poised
          to shine a spotlight on the unique attractions and experiences this
          municipality has to offer, fostering both economic growth and a
          vibrant tourism community.
        </p>
        <div class="icons-container">
          <div class="icons">
            <img src="image/serv-3.png" alt="" width="40" />
            <h3>Strawberry & Rose Capital of the Philippines</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- about section ends -->

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- highlight cafes section starts  -->

    <section class="restaurant" id="restaurants">
      <div class="heading">
        <span>High Ratings & Most Visited Cafes</span>
        <h3></h3>
      </div>

      <div class="box-container">
        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Kai Cafe </a>
            </h3>
            <img src="image/c1.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>From Avva Writes</h1>
            <p>
              From the moment you step into Kai Cafe, you'll be greeted by its
              warm and inviting atmosphere. The rustic decor combined with a
              touch of modern elegance creates the perfect ambiance to unwind
              and enjoy your favorite cup of joe. ☕️✨
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Sinner Or Saint Cafe </a>
            </h3>
            <img src="image/c2.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Eka Masoumi</h1>
            <p>
              The place has a warm feeling to it. Their cakes are yummy. It has
              parking but is very limited. I love their seafood pasta here.
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Fiika Cafe </a>
            </h3>
            <img src="image/c3.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Bryan March</h1>
            <p>
              Food is okay. Place is peaceful and can be conductive for studying
              for students. Parking spaces are available and you can even shop
              on the Japan Surplus store beside the cafe. You can dine inside or
              outside the cafe. Lot of chairs are available. Sort of an
              underrated cafe in La Trinidad.
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Labz Cafe </a>
            </h3>
            <img src="image/c6.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>MgC</h1>
            <p>
              Loved everything! Milk tea was perfect. Carbonara was superb!
              Fries were crisp! Oatmeal cookies were refreshing! Highly
              recommended.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- highlight cafes section ends -->

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- highlight restaurants section starts  -->

    <section class="restaurant" id="restaurants">
      <div class="heading">
        <span>High Ratings & Most Visited Restaurants</span>
        <h3></h3>
      </div>

      <div class="box-container">
        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Dampa Express </a>
            </h3>
            <img src="image/r1.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Enier Go</h1>
            <p>
              Foods were just so great, it’s addictive. Atmosphere is just
              perfect specially when you hit the golden hour. Their stuffs were
              also very accommodating. Place inside itself provides a proper
              ventilation. So, Go and have a visit with your friends, Family, or
              even with your partner. 
            </p>
            
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#">
                <i class="fas fa-tag"></i> Ayatori Japanese Cuisine
              </a>
            </h3>
            <img src="image/r4.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Aly Bee</h1>
            <p>
              Everything was good, with it's service, food, and even it's
              service tea! We were feeling a bit down due to the bad weather,
              but this place sure did lighten our moods up. The food was
              fantastic, especially the Beef Gyudon (which was not in the menu,
              but you can just order this to their staff), Sakura Roll, and
              Kakiage. 
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Kalei's Grill </a>
            </h3>
            <img src="image/r5.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Francis Ducat</h1>
            <p>
              I just had my early dinner 🍽️ and the place is nice 👍. Friendly
              service with a great food menu. A place good to have a get
              together with family and friends.
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#">
                <i class="fas fa-tag"></i> Taste & Cups By Joanna C
              </a>
            </h3>
            <img src="image/r8.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Nate J</h1>
            <p>
              Good view of La Trinidad Strawberry farms. Good food. Parking was
              an issue especially if it is packed. Overall, will definitely
              recommend this place. The shrimp and vegetables was so good with
              rice.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- highlight restaurants section ends -->

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- highlight tourist spots section starts  -->

    <section class="restaurant" id="restaurants">
      <div class="heading">
        <span>High Ratings & Most Visited Tourist Spots</span>
        <h3></h3>
      </div>

      <div class="box-container">
        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Bell Church </a>
            </h3>
            <img src="image/t1.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Heide General</h1>
            <p>
              This place feels like a China tourist spot. It features dragons
              that symbolizes strength, knowledge, and supernatural power for
              Chinese culture. I really love how the red colour can be seen all
              over the place. There's also an overview of distant houses of La
              Trinidad, Benguet. 
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Strawberry Farm </a>
            </h3>
            <img src="image/t2.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Bon Salinas</h1>
            <p>
              Our visit to La Trinidad Strawberry Farm was nothing short of
              exceptional! From the moment we arrived, we were swept away by the
              natural beauty surrounding us. The lush fields of vibrant red
              strawberries against the backdrop of the picturesque mountains
              made for a truly breathtaking sight.
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Sunflower Farm </a>
            </h3>
            <img src="image/t5.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Talis Man</h1>
            <p>
              Beautiful place for flower lovers, but your driver must prepare
              for the stiff climb & narrow roads. 😁
            </p>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <h3>
              <a href="#"> <i class="fas fa-tag"></i> Mt. Kalugong </a>
            </h3>
            <img src="image/t6.jpg" alt="" />
          </div>
          <div class="content">
            <h3>Comments & Reviews:</h3>
            <br />
            <h1>Karlo Guevarra</h1>
            <p>
              You'll really enjoy the beauty of nature here. The hike is neither
              long nor difficult, perfect for beginners. The rock formations are
              perfect for picture taking. Just avoid wearing shorts because you
              might get wounded by the sharp rocks. Also, make sure your shoes
              are not slippery. 
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- highlight tourist spots section ends -->

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- footer section starts  -->

    <section class="footer">
      <div class="box-container">
        <div class="box">
          <h3>quick links</h3>
          <a href="#home"> <i class="fas fa-arrow-right"></i> home </a>
          <a href="#about"> <i class="fas fa-arrow-right"></i> about </a>
          <a href="LIP-choose-tourguide.php">
            <i class="fas fa-arrow-right"></i> booking
          </a>
        </div>

        <div class="box">
          <h3>extra links</h3>
          <a href="LIP-profile.php">
            <i class="fas fa-arrow-right"></i> my account
          </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> terms of use </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a>
        </div>
      </div>

      <div class="bottom">
        

        <div class="credit">
          <span>Everything La Trinidad</span> | all rights reserved 2023
        </div>
      </div>
    </section>
    <!-- footer section ends -->
     <script src="js/script.js"></script>
     
  </body>
</html>
