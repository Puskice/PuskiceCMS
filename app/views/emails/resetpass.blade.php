<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Promenite lozinku za svoj Puškice nalog</h2>
 
        <div>
            Poštovani {{$username}},
        </div>
        <p>Podneli ste zahtev za promenu lozinke na vašem Puškice nalogu.</p>
        <p>Da biste nastavili sa procedurom potrebno je da kliknete na link <a href="{{$confirmurl}}">{{$confirmurl}}</a>.</p>
        <p>Ukoliko niste podneli zahtev za promenu lozinke, ignorišite ovu poruku.</p>
        {{$confirmurl}}
        
    </body>
</html>