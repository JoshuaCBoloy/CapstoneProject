<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Calendar</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
  <style>
    #calendar {
      border: 1px solid #ccc;
      padding: 10px;
      background: #fff;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
  <div class="container">
    <h1>Test Calendar</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Test Calendar</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><div id="calendar"></div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <script>
    $(document).ready(function() {
      $("#calendar").datepicker();
    });
  </script>
</body>
</html>
