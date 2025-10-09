<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label{
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Användare</h1>
    <form method="post">
        <label>namn:

            <input type="text" name="namn" placeholder="Ange namn" value="{{$user -> namn ?? ''}}">
        </label>
        <label>Epost:
            <input type="email" name="epost" placeholder="Ange epost" value="{{$user -> epost ?? ''}}">
            
        </label>
        <input type="submit" value="spara">
        <input type="reset" value="Ångra">
    </form>
    @if (!empty($lista))
    <h2>Användarlista</h2>
    <ul>
        @foreach($lista as $u)
        <li>
            {{$u->id}}
            <a href="/anvandare/{{$u->id}}">{{$u->namn}}</a>
            {{$u->epost}}
        </li>
        @endforeach
    </ul>
    @endif
</body>
</html>