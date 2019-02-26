<!DOCTYPE html>
<html>
    <head>
        <title>test</title>
        <?php
            if (isset($_POST["submit"])) {

                $targetDir="uploads/";
                $targetFile=$targetDir.basename($_FILES['fileUp']['name']);
                $updateok=1;
                $imageType=strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
                if(isset($_POST['submit'])){
        
                    $check=getimagesize($_FILES['fileUp']['tmp_name']);
                    if($check!==false){
                        print "this is  a real image";
                    }else{
                        print "this is not a image";
                        $updateok=0;
                    }
                }
                if(file_exists($targetFile)){
                    print("file already exists");
                    $updateok=0;
                }
                if($imageType!=="jpg" && $imageType != "png"){
                    print("unspported format");
                    $updateok=0;
                }
                if ($updateok ===1){
                    if(move_uploaded_file($_FILES['fileUp']['tmp_name'],$targetFile)){
                        print basename($_FILES['fileUp']['name'])."successfully uploaded";
                    }else{
                        print "there was an error uploading the file";
                    }
                }
                
            }
        ?>
    </head>
    <body>
    <form action="test.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileUp" id="fileUp">
    <input type="submit" value="Upload" name="submit">
    </form>
    </body>
</html>