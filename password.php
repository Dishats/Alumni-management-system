<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
    form {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0px 0px 10px #888888;
      padding: 20px;
      margin: 20px auto;
      max-width: 500px;
    }
    h1 {
      color: #4CAF50;
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }
    label {
      display: block;
      font-size: 16px;
      margin-bottom: 10px;
    }
    input[type="email"], input[type="password"] {
      border-radius: 3px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-size: 16px;
      margin-bottom: 20px;
      padding: 10px;
      width: 100%;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      border: none;
      border-radius: 3px;
      color: white;
      cursor: pointer;
      font-size: 16px;
      padding: 10px;
      width: 100%;
    }
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    .success {
      background-color: #dff0d8;
      border: 1px solid #d6e9c6;
      border-radius: 3px;
      color: #3c763d;
      margin-bottom: 20px;
      padding: 15px;
      text-align: center;
    }
  </style>
</head>
<body>
  <form>
    <h1>Forgot Password</h1>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <input type="submit" value="Submit">
    <div class="success" style="display:none;">Password updated successfully!</div>
  </form>
  <script>
    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      // Your code to update the password goes here
      document.querySelector('.success').style.display = 'block';
    });
  </script>
</body>
</html>