<?php
    include("vendor/autoload.php");
    $storage = new \Upload\Storage\FileSystem('../../../docs');
    $file = new \Upload\File('foo', $storage);

    $new_filename = date("D M d, Y G:i:s");
    $file->setName($new_filename);
    
    $file->addValidations(array(
        //new \Upload\Validation\Mimetype('image/png'),
        new \Upload\Validation\Mimetype('text/plain'),
        new \Upload\Validation\Size('1M')
    ));
    
    try {
        $file->upload();
    } catch (\Exception $e) {
        $errors = $file->getErrors();
        foreach ($errors as $errorMsg) {
            echo $errorMsg;
        }
    }
