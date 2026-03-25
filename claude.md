Tu es un expert Laravel 12. Conçois et développe une application web professionnelle 
de gestion des absences des étudiants pour un établissement scolaire marocain, 
en utilisant Laravel 12, MySQL et le thème AdminLTE 3 
(https://adminlte.io/themes/v3/) comme interface visuelle de référence.

═══════════════════════════════════════════════════════
🎯 CONTEXTE MÉTIER
═══════════════════════════════════════════════════════

L'application est destinée à un établissement scolaire marocain (lycée ou collège).
Elle doit gérer :
- Les absences et retards des étudiants par séance/matière
- La justification des absences (avec pièces jointes)
- Les notifications automatiques aux parents/tuteurs
- Les seuils d'absences réglementaires (système marocain : 
  avertissement à partir de 10% d'absences non justifiées)
- Les rapports officiels et statistiques
- Un calendrier scolaire marocain (semestres, congés officiels)
- Interface bilingue : Arabe (RTL) et Français

═══════════════════════════════════════════════════════
🗄️ BASE DE DONNÉES MYSQL — SCHÉMA COMPLET
═══════════════════════════════════════════════════════

Crée les migrations pour les tables suivantes :

1. etablissements (id, nom, adresse, ville, telephone, directeur, logo, academie)
2. annees_scolaires (id, libelle, date_debut, date_fin, is_active)
3. niveaux (id, libelle, cycle [college|lycee], ordre)
4. filieres (id, libelle, niveau_id)
5. classes (id, libelle, niveau_id, filiere_id, annee_scolaire_id, 
            capacite, titulaire_id)
6. matieres (id, libelle, code, coefficient, volume_horaire_hebdo, 
             type [theorique|pratique|sport])
7. emplois_du_temps (id, classe_id, matiere_id, enseignant_id, 
                     jour [1-6], heure_debut, heure_fin, salle, semestre)
8. etudiants (id, cin_etudiant, massar_id, nom, prenom, date_naissance, 
              lieu_naissance, sexe, photo, adresse, ville, 
              nom_parent, telephone_parent, email_parent, 
              classe_id, annee_scolaire_id, statut [actif|transfere|exclu])
9. users (id, name, email, password, role [admin|directeur|enseignant|surveillant|parent])
10. enseignants (id, user_id, cin, nom, prenom, specialite, 
                grade, telephone, date_embauche)
11. seances (id, emploi_du_temps_id, date, statut [planifiee|realisee|annulee], 
             observation)
12. absences (id, etudiant_id, seance_id, type [absence|retard], 
              duree_retard_min, is_justifiee, motif, piece_jointe, 
              saisie_par, date_saisie, date_justification)
13. notifications_parents (id, etudiant_id, type [sms|email|whatsapp], 
                           contenu, statut, date_envoi)
14. sanctions (id, etudiant_id, type [avertissement|convocation|conseil_discipline],
               date, description, annee_scolaire_id)
15. parametres (id, cle, valeur, description)

═══════════════════════════════════════════════════════
👥 RÔLES & PERMISSIONS (Spatie Laravel Permission)
═══════════════════════════════════════════════════════

Implémente les rôles suivants avec leurs permissions :

- ADMIN : accès total (configuration, utilisateurs, rapports globaux)
- DIRECTEUR : consultation globale + validation sanctions + rapports
- ENSEIGNANT : saisie absences de ses séances uniquement + consultation ses classes
- SURVEILLANT : saisie absences toutes classes + gestion justifications
- PARENT : consultation absences de son/ses enfants uniquement

Utilise le package spatie/laravel-permission.

═══════════════════════════════════════════════════════
🖥️ INTERFACE ADMINLTE 3 — INTÉGRATION COMPLÈTE
═══════════════════════════════════════════════════════

Installe et configure le package jeroennoten/laravel-adminlte pour 
intégrer le thème AdminLTE 3. Respecte fidèlement :

✅ Layout principal :
- Sidebar sombre avec logo de l'établissement
- Topbar avec : notifications en temps réel (badge), 
  profil utilisateur, sélecteur de langue (FR/AR), 
  bouton plein écran
- Footer avec nom établissement et version app
- Breadcrumbs sur chaque page
- Menu latéral avec icônes Font Awesome, regroupés par section

✅ Dashboard (page d'accueil) avec :
- 4 InfoBoxes colorées AdminLTE style :
  * Total absences du jour (rouge, icône fa-user-times)
  * Séances réalisées aujourd'hui (vert, icône fa-check-circle)
  * Étudiants en dépassement seuil (orange, icône fa-exclamation-triangle)
  * Taux d'assiduité global (bleu, icône fa-percent)
- Graphique Chart.js : évolution hebdomadaire des absences (line chart)
- Graphique Donut : répartition absences justifiées vs non justifiées
- Tableau des absences récentes du jour (DataTables)
- Widget calendrier scolaire (FullCalendar.js)
- Liste des étudiants proche du seuil d'avertissement (top 5)

═══════════════════════════════════════════════════════
📱 MODULES FONCTIONNELS À DÉVELOPPER
═══════════════════════════════════════════════════════

── MODULE 1 : SAISIE DES ABSENCES ──
- Interface de saisie par séance (liste classe avec cases à cocher)
- Saisie rapide type "appel" : liste des étudiants, 
  bouton Présent / Absent / Retard pour chacun
- Possibilité de saisir la durée du retard (en minutes)
- Validation instantanée (AJAX/Livewire)
- Historique des saisies par enseignant

── MODULE 2 : GESTION DES JUSTIFICATIONS ──
- Formulaire de dépôt de justification avec upload de pièce jointe
- Workflow de validation : Soumis → En cours → Validé / Rejeté
- Motifs prédéfinis : maladie, décès famille, compétition sportive, autre
- Notification automatique à l'enseignant concerné

── MODULE 3 : TABLEAU DE BORD STATISTIQUES ──
- Absences par étudiant / classe / matière / période
- Évolution mensuelle (graphiques Chart.js)
- Classement des matières avec le plus d'absences
- Taux d'assiduité par classe
- Filtres dynamiques : année, semestre, classe, matière, période

── MODULE 4 : ALERTES & NOTIFICATIONS ──
- Seuils configurables dans les paramètres
- Alerte automatique quand un étudiant dépasse le seuil
- Envoi email aux parents (Laravel Mail + Mailtrap/SMTP)
- Log des notifications envoyées
- Tableau des étudiants en situation critique

── MODULE 5 : RAPPORTS & EXPORT ──
- Bulletin individuel d'absences par étudiant (PDF avec DomPDF)
- Rapport global classe (Excel avec Maatwebsite/Excel)
- Rapport mensuel à l'administration
- Fiche de convocation des parents (PDF imprimable)
- Export DataTables en CSV / Excel / PDF

── MODULE 6 : CONFIGURATION ──
- Gestion des années scolaires (activation/désactivation)
- Paramétrage des seuils d'absences (en heures ou en %)
- Gestion du calendrier (congés officiels marocains, jours fériés)
- Configuration SMTP pour les emails
- Logs d'activité (spatie/laravel-activitylog)

═══════════════════════════════════════════════════════
🔧 STACK TECHNIQUE COMPLÈTE
═══════════════════════════════════════════════════════

Backend :
- Laravel 12 (PHP 8.3+)
- MySQL 8.0
- Spatie Laravel Permission (rôles/permissions)
- Spatie Laravel ActivityLog (audit trail)
- Maatwebsite/Laravel-Excel (exports Excel)
- barryvdh/laravel-dompdf (export PDF)
- Laravel Sanctum (API auth si besoin)

Frontend :
- AdminLTE 3.2.0 (via jeroennoten/laravel-adminlte)
- Bootstrap 4 (inclus dans AdminLTE)
- Chart.js (graphiques dashboard)
- DataTables avec boutons d'export (tableaux)
- FullCalendar.js (calendrier scolaire)
- Select2 (selects améliorés)
- SweetAlert2 (confirmations/alertes)
- Toastr.js (notifications toast)
- Font Awesome 5 (icônes)

═══════════════════════════════════════════════════════
📂 STRUCTURE DES DOSSIERS À RESPECTER
═══════════════════════════════════════════════════════

app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── AbsenceController.php
│   ├── EtudiantController.php
│   ├── ClasseController.php
│   ├── SeanceController.php
│   ├── JustificationController.php
│   ├── RapportController.php
│   └── ParametreController.php
├── Models/
│   ├── Absence.php (avec scopes: today, justified, byClasse)
│   ├── Etudiant.php (avec méthodes: tauxAbsence(), isEnDanger())
│   ├── Seance.php
│   └── ... (tous les modèles)
├── Services/
│   ├── AbsenceService.php (logique métier)
│   ├── NotificationService.php
│   └── RapportService.php
├── Exports/
│   ├── AbsencesExport.php
│   └── ClasseAbsencesExport.php
└── Policies/
    └── AbsencePolicy.php

resources/views/
├── layouts/
│   ├── app.blade.php (layout AdminLTE principal)
│   └── auth.blade.php (layout login)
├── dashboard/
│   └── index.blade.php
├── absences/
│   ├── index.blade.php
│   ├── saisie.blade.php
│   └── show.blade.php
├── etudiants/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php (fiche complète + historique absences)
├── rapports/
│   ├── index.blade.php
│   └── pdf/bulletin.blade.php
└── parametres/
    └── index.blade.php

═══════════════════════════════════════════════════════
🌍 SPÉCIFICITÉS MAROCAINES À IMPLÉMENTER
═══════════════════════════════════════════════════════

1. Identifiant MASSAR : chaque étudiant a un ID Massar (ex: J135123456)
2. Calendrier : respecter les congés officiels du Maroc 
   (Aïd, Fête du Trône, Aid Al Mawlid, etc.)
3. Système semestriel : S1 (sept → jan) et S2 (fév → juin)
4. Volume horaire : calcul en heures (non en jours)
5. Seuil légal : déclencher alerte à 10% d'absences non justifiées 
   du volume total de la matière
6. Langue arabe : supporter RTL avec Bootstrap RTL dans les vues 
   (attribut dir="rtl" dynamique selon la langue choisie)
7. Format dates : utiliser le format DD/MM/YYYY dans les affichages

═══════════════════════════════════════════════════════
🚀 ORDRE DE GÉNÉRATION DU CODE
═══════════════════════════════════════════════════════

Génère dans cet ordre précis :

1. composer.json et configuration packages
2. Toutes les migrations (ordre logique des dépendances)
3. Tous les Models avec relations Eloquent, scopes et accessors
4. Seeders et Factories (données de test réalistes)
5. Configuration AdminLTE (adminlte.php)
6. Layout principal Blade (AdminLTE)
7. Routes (web.php) groupées par rôle avec middleware
8. Controllers avec toutes les méthodes CRUD
9. Services (AbsenceService, NotificationService)
10. Vues Blade (dashboard, absences, étudiants, rapports)
11. Exports Excel et PDF
12. Fichiers JavaScript (charts, datatables, interactions)
13. Migrations de seeders pour les paramètres par défaut

Pour chaque fichier généré :
- Indique le chemin complet du fichier
- Fournis le code complet sans troncature
- Ajoute des commentaires en français
- Respecte les PSR-12 et les conventions Laravel

═══════════════════════════════════════════════════════
✅ EXIGENCES DE QUALITÉ
═══════════════════════════════════════════════════════

- Validation des formulaires : Form Requests Laravel pour chaque entité
- Sécurité : CSRF, XSS protection, vérification des permissions sur chaque route
- Performance : eager loading (with()), pagination sur toutes les listes
- UX : messages flash (success/error), confirmations SweetAlert2 avant suppression
- Responsive : l'interface doit fonctionner sur tablette (usage en classe)
- Code DRY : utiliser des composants Blade réutilisables
- Transactions DB : utiliser DB::transaction() pour les opérations critiques

Commence par le fichier README.md avec les instructions 
d'installation complètes, puis génère les fichiers dans l'ordre indiqué.