<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpTask | <?php echo($titulo) ?? ''; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="assets/sweetalert2.css">
    <link rel="icon" type="image/png" href="build/img/icono.svg" />
</head>
<body class="noclick">
    <?php echo $contenido; ?>
    <?php echo $script ?? ''; ?>
    <script src="build/js/modernizr.js"></script>
</body>
</html>