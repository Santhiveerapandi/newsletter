<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <?php
        /* Bootstrap v4.6.0 */
        /* Jquery v3.6.0 */
    ?>
    <link
        href="<?=base_url('assets/css/fontawesome-free/css/all.min.css')?>"
        rel="stylesheet" type="text/css">
    <link
        href="<?=base_url('assets/css/sb-admin-2.min.css')?>"
        rel="stylesheet" type="text/css" />
    <!-- 
    <link
        href="<?=base_url('assets/css/bootstrap/bootstrap.scss')?>"
    rel="stylesheet" type="text/css" /> -->

    <script
        src="<?= base_url('assets/js/jquery/jquery.min.js')?>">
    </script>

    <script src="https://cdn.tiny.cloud/1/8z7d2boc9tnexp7938thib8kpcgueuz2jm4qvsxifmt8vm7o/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mail_content',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>

</head>

<body>