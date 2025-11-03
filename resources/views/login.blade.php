<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label{
            display: block;
        }
        .err{
            background-color:pink;
            color: darkred;
        }
    </style>
</head>
<body>
    <p class="err">{{$message ?? ''}}</p>
    <h1>Login</h1>
    <form method="post">

        <label>
            Epost:
            <input type="email" name="epost" placeholder="Ange epost">
        </label>
        <label>
            Lösenord
            <input type="password" placeholder="Ange lösenord" name="losenord">

        </label>
        
        <input type="submit" value="Logga in">
    </form>
</body>
</html>