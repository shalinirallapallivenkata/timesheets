<html>

<head>
    <style type="text/css">
        ul.contents{
            list-style-type: square;
        }
    </style>
</head>
<body>

<div align="center">
    <h1>Employer Home</h1>
    <br>
    <h2>Welcome <?php echo $_GET['username'], "!" ?></h2>
    <br>
</div>
<ul class ="contents">
    <a href="createemployer.php?username=<?=$_GET['username']?>" >Create Employer</a>
    <!--        <a href="createemployer.php">Create Employer</a>-->
    <br>
    <a href="Employees.php?username=<?=$_GET['username']?>" >Employees</a>
    <!--        <a href="createemployee.php">Create Employer</a>-->
</ul>
</body>

</html>

