<?php

    $myEmail = "testing.mjm.services@gmail.com";

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))->setUsername('testing.mjm.services@gmail.com')->setPassword('hekbqebrdrpfojtn');

    $mailer = new Swift_Mailer($transport);
