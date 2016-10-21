<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify Your Email Address</h2>

<div>

    Dziękujemy za wysłanie zgłoszenia do konkursu, prosimy o potwierdzenie adresu email, klikając w poniższy link
    {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>

</div>

</body>
</html>