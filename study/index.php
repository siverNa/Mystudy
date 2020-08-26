<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
    <body>
        <h3>WEB</h3>
        <ol>
            <li><a href="index.php?id=html">HTML</a></li>
            <li><a href="index.php?id=css">CSS</a></li>
            <li><a href="index.php?id=javascript">JavaScript</a></li>
        </ol>
        <h2>
            <?php echo $_GET['id']; ?>
        </h2>
        <p>
            샘플 텍스트
        </p>
    </body>
</html>