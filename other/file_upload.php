<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Result</title>
</head>
<body>
<?php
    ini_set("display_error", "1"); //php의 설정을 runtime으로 지정, php.ini의 설정을 이 코드 내에서만 바꿔서 실행

    //upload_dir : 임시 디렉토리에 저장된 업로드된 파일을 원하는 파일디렉토리에 지정하기위한 경로
    $upload_dir = 'C:\Bitnami\wampstack-7.4.9-0\apache2\htdocs\Mystudy\other\\'; 
    //upload_file = 임시 디렉토리에 머물고 있는 파일을 어느 파일 디렉토리에 어느 파일명으로 저장하는 가를 지정
    $upload_file = $upload_dir . basename($_FILES['userfile']['name']);
    echo '<pre>';
    
    if(move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file)) {
        echo "파일이 유효하고 정상적으로 업로드 되었습니다. \n";
    } else {
        print "파일 업로드 공격의 가능성이 있습니다! \n";
    }
    echo "자세한 디버깅 정보입니다.";
    print_r($_FILES);

    echo '</pre>';
?>
<img src="file/<?php echo$_FILES['userfile']['name'] ?>" />
</body>
</html>