<html>
<head>
</head>
<style type="text/css">
    body {
        font-family: "Arial Rounded MT Bold", Helvetica, sans-serif;
        font-size: 30px;
    }
    label {
        font-weight: bold;
        width: 100px;
        font-size: 14px;
    }

    .box {
        border: #666666 solid;
        border-width: 1px 30px;
    }

    input[type=submit] {
        background-color: forestgreen;
        color: floralwhite;
    }
</style>

<body>
<div align="center">
    <div style="font-family:'Arial'; font-size: xx-large; margin-bottom: 25px"><h3>Employee Login Form</h3></div>
    <div style="width:300px; border: solid 1px #333333; " align="left">
        <div style="background-color: forestgreen; color: floralwhite; padding:6px; font-family: Arial; font-size: xx-large">
            <b>Login</b></div>
        <div style="margin: 30px">
        <form method="post" action="employeelogin-proc.php">
            <label>Employee UserName:</label>
            <input type="text" name="username">
            <br>
            <label>Employee Password:</label>
            <input type="password" name="" password">
            <br>
            <input type="submit" value="Submit">
            <input type="submit" value="Cancel">
        </div>
    </div>
</div>
</form>
</body>
</html>
