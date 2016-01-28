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
        <p>Uspešno ste napravili Puškice nalog.</p>
        <p>Da bi nalog postao aktivan, potrebno je da ga <a href="{{$confirmurl}}">aktivirate</a>.</p>
        {{$confirmurl}}
        
    </body>
</html>