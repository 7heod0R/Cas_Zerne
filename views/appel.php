<?php
$dates ??= [];
$tranches ??= [];
$erreur ??= null;
$appeles ??= null;
$nbAppeles ??= 0;
$nbDemandes ??= 0;
$joursFrancais = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
require __DIR__ . '/header.php';
?>
<section class="page-stack call-page">
    <div class="page-heading">
        <div>
            <span class="eyebrow">CENTRE OPÉRATIONNEL</span>
            <h1>Appel d’équipe</h1>
            <p class="page-subtitle">Composez une équipe pour une période de garde.</p>
        </div>
        <div class="dispatch-stamp"><span>DISPATCH</span><strong>29</strong></div>
    </div>

    <section class="call-layout" aria-label="Préparation d’un appel">
        <form class="call-form" method="post" action="index.php?page=appel">
            <div class="form-heading"><span class="eyebrow">NOUVELLE INTERVENTION</span><h2>Paramètres de mobilisation</h2></div>
            <label class="field-label" for="date">Date de garde</label>
            <select id="date" name="date">
                <?php foreach ($dates as $d): ?>
                    <option value="<?= htmlspecialchars($d) ?>"<?= ($_POST['date'] ?? '') === $d ? ' selected' : '' ?>><?= $joursFrancais[(int) date('N', strtotime($d)) - 1] ?> <?= date('d/m/Y', strtotime($d)) ?></option>
                <?php endforeach; ?>
            </select>
            <label class="field-label" for="tranche">Tranche horaire</label>
            <select id="tranche" name="tranche">
                <?php foreach ($tranches as $t): ?>
                    <option value="<?= (int) $t['id'] ?>"<?= (int) ($_POST['tranche'] ?? 0) === (int) $t['id'] ? ' selected' : '' ?>><?= htmlspecialchars($t['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
            <label class="field-label" for="nbPompiers">Effectif demandé</label>
            <div class="number-field"><input id="nbPompiers" type="number" name="nbPompiers" min="1" value="<?= htmlspecialchars($_POST['nbPompiers'] ?? '3') ?>" required><span>pompiers</span></div>
            <button class="submit-button" type="submit"><span>Lancer l’appel</span><span aria-hidden="true">→</span></button>
            <p class="form-note">Les volontaires disponibles sont appelés en priorité.</p>
        </form>

        <div class="result-area" aria-live="polite">
            <?php if ($erreur): ?>
                <section class="result-panel result-error" role="alert">
                    <span class="result-kicker">APPEL NON TRANSMIS</span>
                    <h2>Vérification nécessaire</h2>
                    <p><?= htmlspecialchars($erreur) ?></p>
                </section>
            <?php elseif ($appeles !== null): ?>
                <section class="result-panel<?= $nbAppeles < $nbDemandes ? ' result-warning' : ' result-success' ?>">
                    <span class="result-kicker"><?= $nbAppeles < $nbDemandes ? 'EFFECTIF INCOMPLET' : 'ÉQUIPE MOBILISÉE' ?></span>
                    <h2><strong><?= $nbAppeles ?></strong> <span>/ <?= $nbDemandes ?> appelés</span></h2>
                    <p><?= $nbAppeles < $nbDemandes ? 'Tous les postes demandés n’ont pas pu être pourvus.' : 'Les volontaires sélectionnés sont prêts à intervenir.' ?></p>
                    <?php if ($appeles): ?>
                        <ul class="crew-list">
                            <?php foreach ($appeles as $texte): ?>
                                <li><span class="crew-dot"></span><?= htmlspecialchars($texte) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="empty-result">Aucun volontaire n’a pu être appelé sur cette période.</p>
                    <?php endif; ?>
                </section>
            <?php else: ?>
                <section class="result-placeholder">
                    <span class="placeholder-index">EN ATTENTE</span>
                    <h2>Équipe d’intervention</h2>
                    <p>Le résultat de la mobilisation apparaîtra ici.</p>
                    <div class="placeholder-rule"></div>
                    <span class="placeholder-meta">CIS OUESSANT <span>·</span> SDIS 29</span>
                </section>
            <?php endif; ?>
        </div>
    </section>
</section>
<?php require __DIR__ . '/footer.php'; ?>
