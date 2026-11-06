# Cas Zerne - Gestion des gardes des pompiers volontaires (SDIS 29)

Projet PHP (MVC + POO) et MySQL, version MVP.

## Fonctionnalités
- **Feuille de garde** : tableau de la semaine (annexe A) avec disponibilités et gardes.
- **Appel d'équipe** : pour une période (date + tranche) et un nombre de pompiers,
  mobilise d'abord les pompiers disponibles, puis ceux au travail (annexes B, C, D).

## Structure
| Dossier | Rôle |
|---|---|
| `sql/` | Création de la base et jeu de test |
| `config/` | Connexion à la base |
| `models/` | Classes métier (POO) et requêtes SQL |
| `controllers/` | Logique de chaque page |
| `views/` | Pages HTML/PHP |
| `public/` | Point d'entrée (`index.php`) |

## Installation
1. Importer `sql/zerne.sql` dans MySQL/MariaDB.
2. Configurer la connexion avec `DB_HOST`, `DB_NAME`, `DB_USER` et `DB_PASSWORD` (par défaut : `localhost`, `zerne`, `root` et `root`, identifiants MySQL usuels de MAMP).
3. Lancer : `php -S localhost:8000 -t public`
4. Ouvrir http://localhost:8000

Pour un autre mot de passe MySQL, définir `DB_PASSWORD` dans l'environnement PHP ou l'adapter dans la configuration MAMP.

## Choix et limites
- Les disponibilités et gardes de la semaine 23 sont reprises de l'annexe A (06/06/2022 au 12/06/2022).
- Le nombre de pompiers par période (`nbPompiers`) n'est pas donné dans le PDF : 3 par défaut. `nbGardes` est à 0.
- Les statuts ("en mission") ne sont pas enregistrés en base : l'appel est calculé à chaque requête.
- Le bip est simulé par une trace dans le journal PHP (`error_log`).
- Méthodes de chargement ajoutées (hors annexes) : `Periode::AjouterDisponible`,
  `Periode::AjouterAuTravail`, `Caserne::AjouterPompier` et les constructeurs de `Pompier`/`Caserne`.
