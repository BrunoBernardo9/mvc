<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>
        <?php echo $title ?>
    </title>

    <link href="<?php echo PATH_URL ?>/assets/css/lib/UIkit/uikit.min.css?v<?php echo filemtime(PATH . '/assets/css/lib/UIkit/uikit.min.css') ?>" rel="stylesheet">
    

    <link href="<?php echo PATH_URL ?>/assets/css/style.css?v<?php echo filemtime('app/assets/css/style.css') ?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Cambay" rel="stylesheet"> 
    
    <?php
        ini_set('display_errors', FALSE);
        if(!empty($css)){
            // Percorre todos os CSS da view.
            // Que foram setadas no controller.
            
            foreach($css as $row){
                if(file_exists('app/assets/css/' . $row)){
                    $caminho = PATH_URL . '/assets/css/' . $row;
                    $version = filemtime(PATH . '/assets/css/' . $row);
                    echo '<link href="'.$caminho.'?v='.$version.'" rel="stylesheet">';
                }
            }
        }
    ?>
</head>
<body>