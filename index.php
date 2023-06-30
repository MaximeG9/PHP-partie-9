<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- EXERCICE 1 -->

    <?php
    $date = date('d/m/Y');
    echo $date . "<br>";
    ?>


    <!-- EXERCICE 2 -->

    <?php
    $date = date('d-m-y');
    echo $date . "<br>";
    ?>


    <!-- EXERCICE 3 -->

    <?php
    setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
    $date = strftime("%A %d %B %G");
    echo $date . "<br>";
    ?>


    <!-- EXERCICE 4 -->

    <?php
    $timestamp = time();
    echo $timestamp . "<br>";

    $date2 = "02-08-2016 15:00:00";
    $timestamp2 = strtotime($date2);
    echo $timestamp2;
    "<br>";
    ?>


    <!-- EXERCICE 5 -->
    <br>
    <?php
    $dateDay = time();
    $datePast = "16-05-2016";

    $datePast2 = strtotime($datePast);

    $nbJoursTimestamp = $dateDay - $datePast2;
    $nbJours = $nbJoursTimestamp / 86400;

    echo 'Nombre de jours : ' . $nbJours;
    ?>
    <br>


    <!-- EXERCICE 6 -->

    <?php
    $number = cal_days_in_month(CAL_GREGORIAN, 2, 2016);
    echo "Il y avait " . $number . " jours en février 2016";
    ?>
    <br>


    <!-- EXERCICE 7 -->

    <?php
    echo date('d/m/Y', strtotime(" + 20 days"));
    ?>
    <br>


    <!-- EXERCICE 8 -->

    <?php
    echo date('d/m/Y', strtotime(" - 22 days"));
    ?>
    <br>


    <!-- TP -->

    <h1>Choisir un mois et une année</h1>
    <form action="" method="post">
        <label for="mois">Mois :</label>
        <select name="mois" id="mois">
            <option value="1">Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Août</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
        </select>
        <label for="annee">Année :</label>
        <select name="annee" id="annee">
            <?php
            $anneeCourante = date('Y');
            for ($annee = $anneeCourante - 10; $annee <= $anneeCourante + 10; $annee++) {
                echo "<option value=\"$annee\">$annee</option>";
            }
            ?>
        </select>
        <input type="submit" value="Afficher le calendrier">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];

        // Générer et afficher le calendrier correspondant au mois et à l'année choisis
        echo generateCalendar($mois, $annee);
    }

    function generateCalendar($mois, $annee)
    {
        $html = "<h2>Calendrier $mois/$annee</h2>";
        $timestamp = mktime(0, 0, 0, $mois, 1, $annee);
        $joursDansMois = date('t', $timestamp);
        $premierJour = date('N', $timestamp); // 1 (lundi) à 7 (dimanche)

        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<th>Lundi</th>";
        $html .= "<th>Mardi</th>";
        $html .= "<th>Mercredi</th>";
        $html .= "<th>Jeudi</th>";
        $html .= "<th>Vendredi</th>";
        $html .= "<th>Samedi</th>";
        $html .= "<th>Dimanche</th>";
        $html .= "</tr>";

        $jour = 1;
        $html .= "<tr>";
        for ($i = 1; $i <= 7; $i++) {
            if ($i < $premierJour) {
                $html .= "<td></td>";
            } else {
                $html .= "<td>$jour</td>";
                $jour++;
            }
        }
        $html .= "</tr>";

        while ($jour <= $joursDansMois) {
            $html .= "<tr>";
            for ($i = 1; $i <= 7 && $jour <= $joursDansMois; $i++) {
                $html .= "<td>$jour</td>";
                $jour++;
            }
            $html .= "</tr>";
        }

        $html .= "</table>";

        return $html;
    }
    ?>


    <!-- Le formulaire HTML est créé avec deux listes déroulantes 
    <select> : une pour le mois et une pour l'année. 
        Les options des listes déroulantes sont générées dynamiquement 
        à l'aide d'une boucle for. Les années sont générées sur une 
        plage de 10 ans autour de l'année courante.


Lorsque le formulaire est soumis (lorsque l'utilisateur clique sur 
le bouton "Afficher le calendrier"), le code PHP à l'intérieur de la balise 
<?php ?> est exécuté.


Le code vérifie si la méthode de requête utilisée est POST 
(à l'aide de $_SERVER['REQUEST_METHOD'] === 'POST'). 
Cela permet de s'assurer que le code ne s'exécute que lorsque le formulaire est soumis.


Les valeurs sélectionnées dans les listes déroulantes (le mois et l'année) 
sont récupérées à l'aide de $_POST['mois'] et $_POST['annee'] respectivement.


La fonction generateCalendar est appelée en passant le mois et l'année 
choisis en tant que paramètres. Cette fonction génère le code HTML du 
calendrier en utilisant les informations fournies.


La fonction generateCalendar utilise la fonction mktime pour 
obtenir un timestamp correspondant au premier jour du mois et de l'année sélectionnés.
 Le timestamp est utilisé pour déterminer le nombre de jours dans le mois 
 ($joursDansMois) et le jour de la semaine du premier jour ($premierJour).


La fonction génère ensuite le code HTML du calendrier en utilisant une boucle 
while et des boucles for. La boucle while est utilisée pour générer les lignes 
du tableau du calendrier. La boucle for à l'intérieur de la boucle while est utilisée 
pour générer les cellules du tableau représentant les jours du mois.


Le code HTML du calendrier est retourné par la fonction generateCalendar et 
affiché à l'emplacement correspondant dans la page.


Les styles CSS intégrés dans la balise <style> permettent de définir 
    l'apparence du tableau du calendrier. Les cellules des jours de la semaine 
    ont un fond gris clair (#f2f2f2), tandis que les cellules des jours du mois 
    ont un fond blanc (#ffffff). -->





    <!-- Ce passage de code PHP traite la soumission du formulaire et génère le 
    calendrier correspondant au mois et à l'année choisis.

Voici une explication ligne par ligne :

La condition if ($_SERVER['REQUEST_METHOD'] === 'POST') vérifie si la 
méthode de requête utilisée est POST. Cela permet de s'assurer que le code 
ne s'exécute que lorsque le formulaire est soumis.

Les valeurs sélectionnées dans les listes déroulantes (le mois et l'année) 
sont récupérées à l'aide de $_POST['mois'] et $_POST['annee'] respectivement. 
Ces valeurs sont assignées aux variables $mois et $annee.

La fonction generateCalendar est appelée en passant le mois et l'année 
choisis en tant que paramètres. Cette fonction génère le code HTML du 
calendrier en utilisant les informations fournies.

La fonction generateCalendar commence par initialiser une variable $html 
avec la balise <h2> pour afficher le mois et l'année sélectionnés.

En utilisant la fonction mktime, un timestamp est généré pour le premier 
jour du mois et de l'année sélectionnés. Le timestamp est utilisé pour déterminer 
le nombre de jours dans le mois ($joursDansMois) et le jour de la semaine du premier 
jour ($premierJour).

La balise <table> est ajoutée à la variable $html, suivie de la première 
    ligne du tableau contenant les en-têtes des jours de la semaine 
    (Lundi, Mardi, Mercredi, etc.).

Le compteur $jour est initialisé à 1 et une boucle for est utilisée pour générer 
la première ligne du tableau du calendrier. Si le jour de la semaine ($i) est 
inférieur au premier jour du mois ($premierJour), une cellule vide est ajoutée. 
Sinon, la cellule contenant le numéro du jour est ajoutée et le compteur $jour 
est incrémenté.

Une boucle while est utilisée pour générer les lignes suivantes du tableau du 
calendrier. La boucle for à l'intérieur de la boucle while est utilisée pour 
générer les cellules du tableau représentant les jours du mois. 
Le compteur $jour est incrémenté à chaque itération.

Une fois que toutes les lignes et les cellules du tableau du calendrier 
ont été générées, la balise de fermeture </table> est ajoutée à la variable $html.

La variable $html, qui contient le code HTML du calendrier, est retournée par 
la fonction generateCalendar.

Le code echo generateCalendar($mois, $annee); affiche le calendrier généré 
dans la page HTML, à l'emplacement correspondant.

Cela explique le fonctionnement du code pour générer le calendrier en 
fonction des choix de mois et d'année faits par l'utilisateur. -->


</body>

</html>