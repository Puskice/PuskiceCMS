<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Aktivirajte svoj Puškice nalog</h2>
 
        <div>
            Poštovani {{$username}},
        </div>
        
        <p>Uspešno ste nalog napravili putem Fejsbuka.</p>
        <p>Vaše korisničko ime je: <strong>{{$username}}</strong></p>
        <p>Vaša lozinka je: <strong>{{$password}}</strong></p>
        
        <p>Sa ovim podacima se možete logovati na portalu <a href="{{Request::root()}}/login">Puškice</a>, kao i na Puškice sistemu za učenje <a href="https://testovi.puskice.org">testovi.puskice.org</a></p>
    </body>
</html>

