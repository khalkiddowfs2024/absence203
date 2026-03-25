<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bulletin d'Absences - {{ $etudiant->nom }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 20px; }
        .info { margin-top: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: right; font-size: 0.9em; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 0.8em; }
        .absent { color: #d9534f; }
        .justified { color: #5cb85c; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bulletin d'Absences</h1>
        <p>Année Scolaire : 2025/2026</p>
    </div>

    <div class="info">
        <p><strong>Étudiant :</strong> {{ $etudiant->prenom }} {{ $etudiant->nom }}</p>
        <p><strong>Classe :</strong> {{ $etudiant->classe->libelle ?? '-' }}</p>
        <p><strong>Massar ID :</strong> {{ $etudiant->massar_id }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Matière</th>
                <th>Type</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absences as $absence)
                <tr>
                    <td>{{ optional($absence->date_saisie)->format('d/m/Y') ?? optional(optional($absence->seance)->date)->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $absence->seance->emploiDuTemps->matiere->libelle ?? 'N/A' }}</td>
                    <td>{{ ucfirst($absence->type) }}</td>
                    <td class="{{ $absence->is_justifiee ? 'justified' : 'absent' }}">
                        {{ $absence->is_justifiee ? 'Justifiée' : 'Non Justifiée' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Fait à ____________________, le {{ date('d/m/Y') }}</p>
        <p>Signature de la Direction</p>
    </div>
</body>
</html>
