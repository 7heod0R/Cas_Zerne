<?php
$grille ??= [];
$dates ??= [];
$volontaires ??= [];
$tranches ??= [];
$joursCourts = ['lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.', 'dim.'];
$nombreGardes = 0;
foreach ($grille as $jours) {
    foreach ($jours as $periodes) {
        foreach ($periodes as $activite) {
            $nombreGardes += (int) $activite['garde'];
        }
    }
}
$premiereDate = $dates ? date('d/m/Y', strtotime($dates[0])) : '';
$derniereDate = $dates ? date('d/m/Y', strtotime($dates[count($dates) - 1])) : '';
require __DIR__ . '/header.php';
?>
<section class="page-stack">
    <div class="page-heading">
        <div>
            <span class="eyebrow">PLANNING HEBDOMADAIRE</span>
            <h1>Feuille de garde</h1>
            <p class="page-subtitle">Disponibilités et volontaires désignés par période.</p>
        </div>
        <div class="week-badge"><span>SEMAINE 23</span><strong><?= htmlspecialchars($premiereDate) ?> — <?= htmlspecialchars($derniereDate) ?></strong></div>
    </div>

    <div class="metric-row" aria-label="Résumé de la semaine">
        <div class="metric"><span>VOLONTAIRES</span><strong><?= count($volontaires) ?></strong><small>inscrits au centre</small></div>
        <div class="metric"><span>JOURS PLANIFIÉS</span><strong><?= count($dates) ?></strong><small>dans cette semaine</small></div>
        <div class="metric metric-accent"><span>DÉSIGNATIONS</span><strong><?= $nombreGardes ?></strong><small>gardes attribuées</small></div>
    </div>

    <section class="schedule-section" aria-labelledby="schedule-title">
        <div class="section-heading">
            <div><span class="eyebrow">VUE D’ENSEMBLE</span><h2 id="schedule-title">Disponibilités par période</h2></div>
            <div class="legend" aria-label="Légende des disponibilités">
                <span><i class="legend-swatch swatch-available"></i>Disponible</span>
                <span><i class="legend-swatch swatch-work"></i>Au travail</span>
                <span><i class="legend-swatch swatch-unavailable"></i>Indisponible</span>
                <span><b class="legend-mark">X</b>De garde</span>
            </div>
        </div>
        <div class="table-scroll">
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th class="person-column" rowspan="2" scope="col">Volontaire</th>
                        <th class="bip-column" rowspan="2" scope="col">Bip</th>
                        <?php foreach ($dates as $date): ?>
                            <th class="date-column" colspan="<?= count($tranches) ?>" scope="colgroup"><?= $joursCourts[(int) date('N', strtotime($date)) - 1] ?> <?= date('d/m', strtotime($date)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($dates as $date): ?>
                            <?php foreach ($tranches as $t): ?>
                                <th class="shift-column" scope="col" title="<?= htmlspecialchars($t['libelle']) ?>"><?= htmlspecialchars($t['libelle']) ?></th>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($volontaires as $v): ?>
                        <tr>
                            <th class="person-cell" scope="row"><?= htmlspecialchars($v['nom'] . ' ' . $v['prenom']) ?></th>
                            <td class="bip-cell"><?= htmlspecialchars($v['numeroBip']) ?></td>
                            <?php foreach ($dates as $date): ?>
                                <?php foreach ($tranches as $t): ?>
                                    <?php $case = $grille[$v['id']][$date][$t['id']] ?? null; ?>
                                    <td class="availability d<?= $case ? $case['dispo'] : 3 ?>" title="<?= htmlspecialchars($t['libelle']) ?><?= $case && $case['garde'] ? ' · De garde' : '' ?>"><?= ($case && $case['garde']) ? '<span class="guard-mark">X</span>' : '' ?></td>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
<?php require __DIR__ . '/footer.php'; ?>
