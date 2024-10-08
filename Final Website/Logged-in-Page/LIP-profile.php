<?php
session_start();
include 'db.php'; // Include your database connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch all user details
$stmt = $conn->prepare('SELECT first_name, last_name, email, phone_number FROM user WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $phone_number);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare('SELECT number_people, start_date, end_date, days, any, status, tourguide_status FROM user WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($number_people, $start_date, $end_date, $days, $any, $status, $tourguide_status);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['profile_save'])) {
      // Update user profile details
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $phone_number = $_POST['phone'];

      $stmt = $conn->prepare('UPDATE user SET first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE id = ?');
      $stmt->bind_param('ssssi', $first_name, $last_name, $email, $phone_number, $user_id);
      $stmt->execute();
      $stmt->close();

      // Refresh the page to fetch updated details
      header('Location: LIP-profile.php');
      exit;
  } elseif (isset($_POST['booking_save'])) {
      // Update booking details
      $number_people = $_POST['number_people'];
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      $days = $_POST['days'];
      $any = $_POST['any'];
      $status = 1;
      $tourguide_status = 1;

      $stmt = $conn->prepare('UPDATE user SET number_people = ?, start_date = ?, end_date = ?, days = ?, any = ?, status = ?, tourguide_status = ? WHERE id = ?');
      $stmt->bind_param('sssisiii', $number_people, $start_date, $end_date, $days, $any, $status, $tourguide_status, $user_id);
      $stmt->execute();
      $stmt->close();

      // Refresh the page to fetch updated details
      header('Location: LIP-profile.php');
      exit;
  } elseif (isset($_POST['cancel_booking'])) {
      // Handle booking cancellation
      $stmt = $conn->prepare('UPDATE user SET number_people = NULL, start_date = NULL, end_date = NULL, any = NULL, status = NULL, new_status = NULL, tourguide_status = NULL, package = NULL, days = NULL WHERE id = ?');
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->close();

      // Refresh the page to fetch updated details
      header('Location: LIP-profile.php');
      exit;
  }
}


// Fetch user details to show in the booking section
$booking_sql = $conn->prepare('SELECT * FROM user WHERE id = ?');
$booking_sql->bind_param('i', $user_id);
$booking_sql->execute();
$booking_result = $booking_sql->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
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

    #sidebar {
      width: 20%;
    }

    #sidebar .btn {
      width: 100%;
      margin-bottom: 10px;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 100%;
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
      pointer-events: none;
    }

    .form-group input, .form-group textarea {
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
    .form-group input:not(:placeholder-shown) + label,
    .form-group textarea:focus + label,
    .form-group textarea:not(:placeholder-shown) + label {
      top: -10px;
      font-size: 14px;
      color: #38d39f;
    }

    .form-group input:focus,
    .form-group textarea:focus {
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

    .form-group input:focus ~ .icon,
    .form-group textarea:focus ~ .icon {
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
      width: 100%;
      margin-left: auto;
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
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">User Dashboard</h1>
    <div class="row mt-4">
      <div class="col-md-3" id="sidebar">
        <button id="btnDashboard" class="btn btn-light">Dashboard</button>
        <button id="btnProfile" class="btn btn-primary">Profile</button>
        <button id="btnBooking" class="btn btn-secondary">Booking</button>
      </div>
      <div class="col-md-9">
        <div id="dashboard" class="card">
          <div class="card-body">
            <h5 class="card-title">Dashboard</h5>
            <p>Welcome to your dashboard. Use the buttons on the left to navigate.</p>
          </div>
        </div>

        <div id="profile" class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Profile</h5>
            <form method="post" action="LIP-profile.php">
              <div class="form-group">
                <i class="fas fa-user icon"></i>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                <label for="first_name">First Name</label>
              </div>
              <div class="form-group">
                <i class="fas fa-user icon"></i>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                <label for="last_name">Last Name</label>
              </div>
              <div class="form-group">
                <i class="fas fa-envelope icon"></i>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <label for="email">Email</label>
              </div>
              <div class="form-group">
                <i class="fas fa-phone icon"></i>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                <label for="phone">Phone Number</label>
              </div>
              <button type="submit" name="profile_save" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>

        <div id="booking" class="card">
          <div class="card-body">
            <h5 class="card-title">Your Bookings</h5>
            <div class="table-container">
              <table class="table">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Number of People</th>
                    <th>Starting Date</th>
                    <th>End Date</th>
                    <th>Number of Days</th>
                    <th>Additional Information</th>
                    <th>Chosen Package</th>
                    <th>Booking Status</th>
                    <th>Tourguide Status</th>
                    <th>Actions</th>
                    <th>Pending for Approval</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($booking_result->num_rows > 0) {
                      while ($row = $booking_result->fetch_assoc()) { ?>
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
                    <td><?php 
                      if ($row['status'] == 1) {
                          echo "Pending";
                      } elseif ($row['status'] == 2) {
                          echo "Accepted";
                      } elseif ($row['status'] == 3) {
                          echo "Declined";
                      } ?></td>
                    <td><?php 
                      if ($row['tourguide_status'] == 1) {
                          echo "Pending";
                      } elseif ($row['tourguide_status'] == 2) {
                          echo "Tourguide 1";
                      } elseif ($row['tourguide_status'] == 3) {
                          echo "Tourguide 2";
                      } ?></td>
                    <td>
                      <button class="btn btn-warning btn-sm" onclick="editBooking(this)"
                        id="<?php echo $row['id']; ?>"
                        number_people="<?php echo $row['number_people']; ?>"
                        start_date="<?php echo $row['start_date']; ?>"
                        end_date="<?php echo $row['end_date']; ?>"
                        days="<?php echo $row['days']; ?>"
                        any="<?php echo $row['any']; ?>"
                        status="<?php echo $row['any']; ?>"
                        tourguide_status="<?php echo $row['any']; ?>">Edit</button>
                      <button class="btn btn-danger btn-sm" onclick="cancelBooking(<?php echo $row['id']; ?>)">Cancel</button>
                    </td>
                    <td>You will receive an <br>confirmation email <br>for the next 24hrs</td>
                  </tr>
                  <?php }
                  } else {
                      echo "<tr><td colspan='12'>No bookings found.</td></tr>";
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

  <!-- Modal -->
  <div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="LIP-profile.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="editNumberPeople">Number of People</label>
            <input type="number" id="editNumberPeople" name="number_people" value="<?php echo htmlspecialchars($number_people); ?>">
          </div>
          <div class="form-group">
            <label for="editStartDate">Starting Date</label>
            <input type="date" id="editStartDate" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
          </div>
          <div class="form-group">
            <label for="editEndDate">End Date</label>
            <input type="date" id="editEndDate" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
          </div>
          <div class="form-group">
            <label for="editNumberPeople" hidden>Number of Days</label>
            <input type="number" id="editBookingStatus" name="days" hidden>
          </div>
          <div class="form-group">
            <label for="editAdditionalInfo">Additional Information</label>
            <textarea id="editAdditionalInfo" name="any" rows="3"><?php echo htmlspecialchars($any); ?></textarea>
          </div>
          <div class="form-group">
            <label for="editNumberPeople" hidden>Booking Status</label>
            <input type="text" id="editBookingStatus" name="status" hidden>
          </div>
          <div class="form-group">
            <label for="editNumberPeople" hidden>Tourguide Status</label>
            <input type="text" id="editTourguideStatus" name="tourguide_status" hidden>
          </div>
          <button type="submit" name="booking_save" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.getElementById('btnDashboard').addEventListener('click', function() {
      // Redirect to the specific file (replace 'your-dashboard-file.html' with the actual file path)
      window.location.href = 'LIP-index.php';
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

    // Default view
    document.getElementById('btnProfile').click();

    function cancelBooking(bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        // Create a form dynamically and submit it
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'LIP-profile.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cancel_booking';
        input.value = bookingId;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
}

    function editBooking(button) {
    var id = button.getAttribute('data-id');
    var numberPeople = button.getAttribute('number_people');
    var startDate = button.getAttribute('start_date');
    var endDate = button.getAttribute('end_date');
    var any = button.getAttribute('any');
    var status = button.getAttribute('status');
    var tourguideStatus = button.getAttribute('tourguide_status');

    $('#editBookingId').val(id);
    $('#editNumberPeople').val(numberPeople);
    $('#editStartDate').val(startDate);
    $('#editEndDate').val(endDate);
    $('#editAdditionalInfo').val(any);
    $('#editBookingStatus').val(1);
    $('#editTourguideStatus').val(1);
    $('#editBookingModal').modal('show');
}

    $('#editBookingForm').on('submit', function(e) {
      e.preventDefault();
      const bookingData = {
        booking_id: $('#editBookingId').val(),
        number_people: $('#editNumberPeople').val(),
        start_date: $('#editStartDate').val(),
        end_date: $('#editEndDate').val(),
        any: $('#editAdditionalInfo').val(),
        status: $('#editBookingStatus').val(1),
        tourguide_status: $('#editTourguideStatus').val(1)
      };

      $.ajax({
        url: 'LIP-profile.php',
        type: 'POST',
        data: bookingData,
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            alert('Booking updated successfully');
            location.reload();
          } else {
            alert('Failed to update booking: ' + response.message);
          }
        }
      });
    });
  </script>
</body>
</html>