<?php
$con = mysqli_connect('localhost', 'root', '', 'login_db');
$sql = mysqli_query($con, "SELECT * FROM user");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($con, "UPDATE user SET status='$status' WHERE id='$id'");
    header("Location: admindashboard.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['new_status']) && isset($_GET['tourguide_id'])) {
    $id = $_GET['id'];
    $new_status = $_GET['new_status'];
    $tourguide_id = $_GET['tourguide_id'];
    $tourguide_status = ($new_status == 2) ? 2 : 3;

    // Update the user table with the selected tour guide ID
    mysqli_query($con, "UPDATE user SET new_status='$new_status', tourguide_status='$tourguide_status', tourguide_id='$tourguide_id' WHERE id='$id'");
    header("Location: admindashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background: #f8f9fa;
    }

    .container {
      margin-top: 50px;
      max-width: 1200px;
    }

    #sidebar .btn {
      width: 100%;
      margin-bottom: 10px;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .card-title {
      color: #333;
      font-size: 1.5rem;
      margin-bottom: 20px;
    }

    .form-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .form-group label {
      position: absolute;
      top: 50%;
      left: 40px;
      transform: translateY(-50%);
      color: #999;
      font-size: 18px;
      transition: 0.3s;
    }

    .form-group input {
      width: 100%;
      padding: 10px 10px 10px 40px;
      font-size: 1rem;
      color: #555;
      background: none;
      border: none;
      border-bottom: 2px solid #d9d9d9;
      outline: none;
      transition: 0.4s;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -10px;
      font-size: 14px;
      color: #38d39f;
    }

    .form-group input:focus {
      border-bottom-color: #38d39f;
    }

    .form-group .icon {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #999;
      transition: 0.3s;
    }

    .form-group input:focus ~ .icon {
      color: #38d39f;
    }

    .btn-primary {
      background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
      border: none;
      border-radius: 25px;
      color: #fff;
      font-size: 1rem;
      text-transform: uppercase;
      transition: 0.5s;
    }

    .btn-primary:hover {
      background-position: right;
    }

    .btn-secondary {
      border-radius: 25px;
      font-size: 1rem;
      text-transform: uppercase;
    }

    .table-container {
      overflow-x: auto;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table thead th {
      border-bottom: 2px solid #dee2e6;
      padding: 10px;
      background: #f8f9fa;
      text-align: center;
      white-space: nowrap;
    }

    .table tbody td {
      border-top: 1px solid #dee2e6;
      padding: 10px;
      text-align: center;
      white-space: nowrap;
    }

    .table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .table-container h5 {
      margin-bottom: 20px;
    }

    .modal-body .form-group {
      margin-bottom: 1.5rem;
      padding: 10px 0;
    }

    .modal-body .form-group input, .modal-body .form-group textarea {
      padding: 10px 20px;
    }

    .modal-body .form-group label {
      top: -10px;
      left: 20px;
      font-size: 14px;
      color: #999;
    }

    .modal-content {
      padding: 20px;
    }

    .modal-footer {
      padding: 20px;
    }

    #calendar {
      border: 1px solid #ccc;
      padding: 10px;
      background: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Admin Dashboard</h1>
    <div class="row mt-4">
      <div class="col-md-3" id="sidebar">
        <button id="btnDashboard" class="btn btn-light">Dashboard</button>
        <button id="btnBooking" class="btn btn-secondary">Profile</button>
        <button id="btnProfile" class="btn btn-primary">Booking</button>
      </div>
      <div class="col-md-9">
        <div id="dashboard" class="card">
          <div class="card-body">
            <h5 class="card-title">Dashboard</h5>
            <p>Welcome to your dashboard. Use the buttons on the left to navigate.</p>
          </div>
        </div>
        <div id="booking" class="card" style="display:none;">
          <div class="card-body">
            <h5 class="card-title">Profile Page</h5>
            <p>Click <a href="index.html" style="text-decoration: underline;">here</a> to go to website.</p>
            <p>Click <a href="adminlogin.php" style="text-decoration: underline;">here</a> to Logout</p>
          </div>
        </div>
        <div id="profile" class="card" style="display:none;">
          <div class="card-body">
            <h5 class="card-title">Booking Details</h5>
            <div class="table-container">
              <table class="table">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Number People</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Number of Days</th>
                    <th>Additional Information</th>
                    <th>Package</th>
                    <th>Response</th>
                    <th>Booking Status</th>
                    <th>Tour Guide Status</th>
                    <th>Tour Guide</th>
                    <th>Tour Guide Booking Schedule</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) { ?>
                      <tr>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['number_people']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['days']); ?></td>
                        <td><?php echo htmlspecialchars($row['any']); ?></td>
                        <td><?php echo htmlspecialchars($row['package']); ?></td>
                        <td>
                          <select onchange="updateBookingStatus(this.value, '<?php echo $row['id']; ?>')">
                            <option value="1">Update Status</option>
                            <option value="2">Accept</option>
                            <option value="3">Decline</option>
                          </select>
                        </td>
                        <td><?php 
                          if ($row['status'] == 1) {
                            echo "Pending";
                          } elseif ($row['status'] == 2) {
                            echo "Accepted";
                          } elseif ($row['status'] == 3) {
                            echo "Declined";
                          }
                        ?></td>
                        <td>
                          <select onchange="updateTourGuideStatus(this.value, '<?php echo $row['id']; ?>')">
                          <option value="1">Update Status</option>
                          <?php
                          $tourGuides = [2 => 'Tourguide 1', 3 => 'Tourguide 2'];
                          foreach ($tourGuides as $tgId => $tgName) {
                            $conflictQuery = mysqli_query($con, "SELECT * FROM user WHERE tourguide_status='$tgId' AND (start_date <= '{$row['end_date']}' AND end_date >= '{$row['start_date']}')");
                            if (mysqli_num_rows($conflictQuery) == 0) {
                              echo "<option value='$tgId'>$tgName</option>";
                            }
                          }
                          ?>
                          </select>
                        </td>
                        <td><?php 
                          if ($row['tourguide_status'] == 1) {
                            echo "Pending";
                          } elseif ($row['tourguide_status'] == 2) {
                            echo "Tourguide 1";
                          } elseif ($row['tourguide_status'] == 3) {
                            echo "Tourguide 2";
                          }
                        ?></td>
                        <td>
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBookingModal" onclick="editBooking(this)">Click Here</button>
                        </td>
                      </tr>
                      <?php }
                  } else {
                      echo "<tr><td colspan='11'>No bookings found.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div type="text" id="calendar" class="form-control"></div>
        </div>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
    function updateBookingStatus(value, id) {
      let url = "admindashboard.php?id=" + id + "&status=" + value;
      window.location.href = url;
    }

    function updateTourGuideStatus(value, id) {
    let tourguide_id = value; // The selected tour guide ID is passed as 'value'
    let url = "admindashboard.php?id=" + id + "&new_status=" + value + "&tourguide_id=" + tourguide_id;
    window.location.href = url;
  }
  </script>

  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script>
    document.getElementById('btnDashboard').addEventListener('click', function() {
      window.location.href = 'index.html';
    });

    document.getElementById('btnProfile').addEventListener('click', function() {
      document.getElementById('dashboard').style.display = 'none';
      document.getElementById('profile').style.display = 'block';
      document.getElementById('booking').style.display = 'none';
      this.classList.add('btn-primary');
      this.classList.remove('btn-secondary');
      document.getElementById('btnBooking').classList.add('btn-secondary');
      document.getElementById('btnBooking').classList.remove('btn-primary');
      document.getElementById('btnDashboard').classList.add('btn-light');
      document.getElementById('btnDashboard').classList.remove('btn-primary');
    });

    document.getElementById('btnBooking').addEventListener('click', function() {
      document.getElementById('dashboard').style.display = 'none';
      document.getElementById('profile').style.display = 'none';
      document.getElementById('booking').style.display = 'block';
      this.classList.add('btn-primary');
      this.classList.remove('btn-secondary');
      document.getElementById('btnProfile').classList.add('btn-secondary');
      document.getElementById('btnProfile').classList.remove('btn-primary');
      document.getElementById('btnDashboard').classList.add('btn-light');
      document.getElementById('btnDashboard').classList.remove('btn-primary');
    });

    $(document).ready(function() {
  // Reinitialize the datepicker when the modal is shown
  $('#editBookingModal').on('shown.bs.modal', function () {
    $("#calendar").datepicker(); // Ensure the calendar is reinitialized
  });
  
  document.getElementById('btnProfile').click(); // Default view

  function editBooking(button) {
    $('#editBookingModal').modal('show');
  }
});

  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
