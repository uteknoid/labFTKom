<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Aplikasi peminjaman alat di laboratorium komputer FTKOM UNCP">
    <meta name="author" content="UTeknoID">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title><?= $title; foreach ($option as $u) { echo $u->nama; } ?></title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/fontawesome-all.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/swiper.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/magnific-popup.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('assets/img/'); foreach ($option as $u) { echo $u->icon; }?>">
</head>

<body data-spy="scroll" data-target=".fixed-top">