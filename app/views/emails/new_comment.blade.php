<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Cenzura komentara</h2>
 
        <div>
            Podaci:
        </div>
        <p><strong>{{ $username }} ({{ $email }})</strong> je komentarisao:
        @if($news == 1) 
            <a href="{{Request::root()}}/uprava/articles/edit/{{$news_id}}">
            <strong>{{$title}}</strong></a>
        @endif
        @if($news == 0)
            <a href="{{Request::root()}}/uprava/memes/edit/{{$news_id}}">
            <strong>{{$title}}</strong></a>
        @endif
        </p>
        <p>{{ $content }}</p>
        <p>Komentar možete ga pogledati na sledećoj adresi:<br/>
            <a href="{{$url}}">{{$url}}</a>
        </p>
        <p>Ako vam se komentar sviđa, možete ga odobriti klikom na sledeći link
            <a href="{{$approve_url}}">{{$approve_url}}</a>
        </p>
        <p>Ako vam se komentar ne sviđa, klik <a href="{{$delete_url}}">ovde da ga obrišete</a></p>
        
    </body>
</html>