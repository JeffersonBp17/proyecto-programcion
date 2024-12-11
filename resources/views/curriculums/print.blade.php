<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo de {{ $person->first_name }} {{ $person->last_name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        h1 {
            font-size: 32px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 22px;
            color: #34495e;
            margin-bottom: 10px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
            margin-top: 20px;
        }

        h3 {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        p {
            font-size: 15px;
            margin: 4px 0;
        }

        .section {
            margin-bottom: 30px;
        }

        .data-label {
            font-weight: bold;
            color: #555;
        }

        .data-content {
            color: #333;
        }

        .contact-info p {
            display: inline-block;
            margin-right: 20px;
        }

        .contact-info a {
            color: #3498db;
            text-decoration: none;
        }

        .list-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .list-items li {
            font-size: 15px;
            margin-bottom: 8px;
            color: #333;
        }

        .skills-list,
        .languages-list {
            display: inline-block;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .skills-list span,
        .languages-list span {
            font-size: 15px;
            color: #2c3e50;
            margin-right: 10px;
        }

        .skills-list span,
        .languages-list span {
            margin-right: 15px;
        }

        .separator {
            margin-left: 5px;
            margin-right: 5px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Currículo de {{ $person->first_name }} {{ $person->last_name }}</h1>

        <!-- Información básica de la persona -->
        <div class="section contact-info">
            <h2>Información Personal</h2>
            <p><span class="data-label">Nombre completo:</span> <span class="data-content">{{ $person->first_name }} {{ $person->last_name }}</span></p>
            <p><span class="data-label">Teléfono:</span> <span class="data-content">{{ $person->phone }}</span></p>
            <p><span class="data-label">Correo:</span> <span class="data-content">{{ $person->email }}</span></p>
            <p><span class="data-label">LinkedIn:</span> <a href="{{ $person->linkedin }}" class="data-content">{{ $person->linkedin }}</a></p>
            <p><span class="data-label">Fecha de nacimiento:</span> <span class="data-content">{{ \Carbon\Carbon::parse($person->birth_date)->format('d/m/Y') }}</span></p>
            <p><span class="data-label">Dirección:</span> <span class="data-content">{{ $person->address }}</span></p>
        </div>

        <!-- Sección de Educación -->
        <div class="section">
            <h2>Educación</h2>
            @forelse ($person->educationHistories as $education)
            <p><strong class="data-content">{{ $education->academic_degree }}</strong> en {{ $education->institution }} <span class="data-content">({{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($education->end_date)->format('Y') }})</span></p>
            @empty
            <p>No se ha registrado información de educación.</p>
            @endforelse
        </div>

        <!-- Sección de Experiencia Laboral -->
        <div class="section">
            <h2>Experiencia Laboral</h2>
            @forelse ($person->workExperiences as $experience)
            <p><strong class="data-content">{{ $experience->position }}</strong> en {{ $experience->company }} <span class="data-content">({{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($experience->end_date)->format('Y') }})</span></p>
            <p>{{ $experience->description }}</p>
            @empty
            <p>No se ha registrado experiencia laboral.</p>
            @endforelse
        </div>

        <!-- Sección de Certificaciones -->
        <div class="section">
            <h2>Certificaciones</h2>
            @forelse ($person->certifications as $certification)
            <p><strong class="data-content">{{ $certification->certification }}</strong> en {{ $certification->institution }} <span class="data-content">({{ \Carbon\Carbon::parse($certification->obtained_date)->format('Y') }})</span></p>
            @empty
            <p>No se han registrado certificaciones.</p>
            @endforelse
        </div>

        <!-- Sección de Habilidades -->
        <div class="section">
            <h2>Habilidades</h2>
            <div class="skills-list">
                @forelse ($person->skills as $skill)
                <span>{{ $skill->skill }} ({{ $skill->level }})</span><span class="separator">•</span>
                @empty
                <p>No se han registrado habilidades.</p>
                @endforelse
            </div>
        </div>

        <!-- Sección de Idiomas -->
        <div class="section">
            <h2>Idiomas</h2>
            <div class="languages-list">
                @forelse ($person->languages as $language)
                <span>{{ $language->language }} ({{ $language->level }})</span><span class="separator">•</span>
                @empty
                <p>No se han registrado idiomas.</p>
                @endforelse
            </div>
        </div>

        <!-- Sección de Intereses -->
        <div class="section">
            <h2>Intereses</h2>
            <ul class="list-items">
                @forelse ($person->interests as $interest)
                <li>{{ $interest->interest }}</li>
                @empty
                <p>No se han registrado intereses.</p>
                @endforelse
            </ul>
        </div>

        <div class="footer">
            <p>Este currículo fue generado automáticamente. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>