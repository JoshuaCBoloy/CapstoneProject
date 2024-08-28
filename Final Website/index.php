<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat Box</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label style="font-weight: bold;">First Name</label>
          <input type="text" name="fname" placeholder="Enter your firstname" required>
        </div>
        <div class="field input">
          <label style="font-weight: bold;">Last Name</label>
          <input type="text" name="lname" placeholder="Enter your lastname" required>
        </div>
        <div class="field image">
          <label style="font-weight: bold;">Select Profile</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
        <div class="home"><a href="Logged-in-Page/LIP-index.php" style="color: black;">Home</a>
        <style>
          .home {
            font-size: 19px;
            text-align: center;
            font-weight: bold;
            font-family: 'Poppins';
          }
        </style>
        </div>
      </form>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
