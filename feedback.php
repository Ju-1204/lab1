<?php
// Eingabe übernehmen
$bewertung = $_POST['bewertung'] ?? '';
$gueltigeBewertungen = ['gut', 'schlecht'];

if (!in_array($bewertung, $gueltigeBewertungen, true)) {
    http_response_code(400);
    $bewertungText = 'Ungültige Eingabe';
} else {
    $bewertungText = $bewertung === 'gut' ? 'Gut' : 'Schlecht';
}
?>
<!-- Feedback-Seite erzeugen -->
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vielen Dank</title>
</head>
<body>
  <h1>Vielen Dank für Ihre Bewertung!</h1>
  <p>Ihre Bewertung der Lieferzeit: <strong><?= htmlspecialchars($bewertungText, ENT_QUOTES, 'UTF-8') ?></strong></p>
  <p><a href="index.html">Zurück zum Formular</a></p>
</body>
</html>
<?php
// Aktion anstoßen
if (in_array($bewertung, $gueltigeBewertungen, true)) {
  exec('pinctrl set 17 op dl');
  exec('pinctrl set 27 op dl');
  if ($bewertung === 'gut') {
    exec('pinctrl set 17 op dh');
  } else {
    exec('pinctrl set 27 op dh');
  }
}
?>