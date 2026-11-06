<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cas Zerne | CIS Ouessant</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php $pageActive = $_GET['page'] ?? 'feuille'; ?>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="index.php?page=feuille" aria-label="CIS Ouessant, accueil">
            <span class="brand-mark">29</span>
            <span class="brand-copy"><strong>CAS ZERNE</strong><small>SDIS 29 · FINISTÈRE</small></span>
        </a>
        <div class="station-label">CENTRE DE SECOURS</div>
        <div class="station-name">CIS Ouessant</div>
        <nav class="primary-nav" aria-label="Navigation principale">
            <a href="index.php?page=feuille" class="nav-link<?= $pageActive === 'feuille' ? ' is-active' : '' ?>"<?= $pageActive === 'feuille' ? ' aria-current="page"' : '' ?>>
                <span class="nav-index">01</span><span>Feuille de garde</span>
            </a>
            <a href="index.php?page=appel" class="nav-link<?= $pageActive === 'appel' ? ' is-active' : '' ?>"<?= $pageActive === 'appel' ? ' aria-current="page"' : '' ?>>
                <span class="nav-index">02</span><span>Appel d’équipe</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <span class="status-dot"></span>
            <span>Centre opérationnel</span>
            <small>OUESSANT, BRETAGNE</small>
        </div>
    </aside>
    <div class="main-shell">
        <header class="topbar">
            <div><span class="topbar-kicker">GESTION DES GARDES</span><span class="topbar-divider">/</span><span>CIS Ouessant</span></div>
            <span class="topbar-status"><span class="status-dot"></span> Semaine 23 · 2022</span>
        </header>
        <main class="content">
