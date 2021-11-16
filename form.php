<?php

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'uploads/';

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid() . '.' . $extension;

    $authorizedExtension = ['jpg', 'jpeg', 'png'];

    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtension))) {
        $errors[] = 'Veuillez mettre un fichier avec une extension jpg, jpeg ou png';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = 'Le fichier doit faire moins de 1M';
    }

    if (empty($errors)) {
        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

        if ($result) {
            echo "envoyé avec succès !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Ajouter un fichier</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Envoyer</button>
    </form>
</body>

</html>