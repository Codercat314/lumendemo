<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        label{
            display:block;
        }
        .error{
            background-color: pink;
            color: darkred;
        }
    </style>
</head>
<body>
    @if($meddelande)
    <p class="error">{{$meddelande}}</p>
    <h2>Registrera ny</h2>
    <form method="post">
        <label>Namn: <input type="text" name="namn" required></label>
        <label>Epost: <input type="email" name="epost" required></label>
        <label>Lösenord: <input type="password" name="losenord" required></label>
        <input type="submit" value="Registrera!">
    </form>
    @endif
</body>
</html>