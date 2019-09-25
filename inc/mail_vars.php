<?php

    $key = $_POST['key'];

    $content = "Hi, you have been invited to join MJM consulting... etc. Your registration key is $key. You can also visit 10.178.40.49/branch/MJM-Tax-Services/signup.php?key=$key";

    $myEmail = "testing.mjm.services@gmail.com";

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))->setUsername('testing.mjm.services@gmail.com')->setPassword('hekbqebrdrpfojtn');

    $mailer = new Swift_Mailer($transport);
