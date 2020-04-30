<html>
<head>
    <style>
       body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box}
    label{
        width: 15%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }
       input{
           border: #666666 solid;
           border-width: 1px;
       }
       input[type=submit]{
       background-color: #4CAF50;
       color: white;
       padding: 14px 20px;
       margin: 8px 0;
       border: none;
       cursor: pointer;
       width: 50%;
       opacity: 0.9;float: left;width: 50%
       }
       input[value=Cancel]{
           background-color: #f44336;
           color: white;
           padding: 14px 20px;
           margin: 8px 0;
           border: none;
           cursor: pointer;
           width: 50%;
           opacity: 0.9;
       }
       .container {
           padding: 16px;
       }

    </style>
</head>
<body>
<h1> Create Employer</h1>
    <form method="post" action="createemployer-proc.php">
        <div class="container">
        <label>* First Name:</label>
        <input type="text" size="50" name="First Name" required>
        <br>
        <label>Middle Name:</label>
        <input type="text" size="50" name="Middle Name">
        <br>
        <label>* Last Name:</label>
        <input type="text" size="50" name="Last Name" required>
        <br>
        <label>* ID:</label>
        <input type="text" size="50" name="ID" required>
        <br>
        <label>Address:</label>
        <input type="text" size="50" name="Address">
        <br>
        <label>* Contact Number</label>
        <input type="text" size="50" name="Contact Number" required>
        <br>
        <label>* Email</label>
        <input type="text" size="50" name="Employer email" required>
        <br>
        <input type="submit" value="Submit">
        <input type="submit" value="Cancel">
        </div>
    </form>
</body>
</html>