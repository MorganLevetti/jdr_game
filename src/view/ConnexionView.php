<?php
class ConnexionView
{
    public function render()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion</title>
        </head>

        <body>
            <form action="" method="post">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="S'inscrire">
            </form>
        </body>

        </html>
<?php
    }
}
?>