<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Prijava za članstvo</h2>
 
        <div>
            Podaci:
        </div>
        <div>Ime i prezime: {{ $name }}</div>
        <div>Email: {{ $email }} </div>
        <div>Godina studija: {{ $godina }} </div>
        <div>Fejsbuk: {{ $fb }} </div>
        <div>Tviter: {{ $tw }} </div>
        <div>Linkedin: {{ $in }} </div>
        <div>Motivacija: {{ $motivacija }} </div>
        <div>Interesovanje:</div>
        <?php foreach($interesovanje as $int): ?>
            <div>{{ $int }} </div>
        <?php endforeach;?>
    </body>
</html>