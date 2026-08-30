<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nouvelle demande de stage</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .page {
            width: 100%;
            min-height: 100vh;
            padding: 25px;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .header {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 18px;
            box-shadow: 0 3px 15px rgba(0,0,0,.06);
        }

        .header h1 {
            color: #123b70;
            font-size: 22px;
            margin-bottom: 6px;
        }

        .header p {
            color: #777;
            font-size: 14px;
        }

        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px 0;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 120px;
        }

        .circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #e5eaf2;
            color: #657085;
            font-weight: bold;
            font-size: 13px;
        }

        .step.active .circle {
            background: #1261c9;
            color: white;
        }

        .step span {
            margin-top: 7px;
            font-size: 11px;
            color: #7b8493;
        }

        .step.active span {
            color: #1261c9;
            font-weight: bold;
        }

        .line {
            width: 100px;
            height: 2px;
            background: #e1e5ec;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 18px rgba(0,0,0,.07);
        }

        .card-title {
            font-size: 18px;
            color: #172033;
            margin-bottom: 22px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
            color: #283449;
        }

        label.required::after {
            content: " *";
            color: #e53935;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d9dfe8;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #1261c9;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .error {
            margin-top: 5px;
            color: #d93025;
            font-size: 12px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            gap: 15px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 12px 25px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-back {
            background: #eef2f7;
            color: #344054;
        }

        .btn-primary {
            background: #1261c9;
            color: white;
            min-width: 160px;
        }

        .btn-primary:hover {
            background: #0d4fa8;
        }

        @media(max-width: 650px) {
            .page {
                padding: 12px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .line {
                width: 40px;
            }

            .step {
                min-width: 80px;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <div class="header">
            <h1>Nouvelle demande de stage</h1>
            <p>Remplissez les informations nécessaires à votre demande.</p>
        </div>

        {{-- Étapes --}}
        <div class="steps">

            <div class="step active">
                <div class="circle">1</div>
                <span>Informations</span>
            </div>

            <div class="line"></div>

            <div class="step">
                <div class="circle">2</div>
                <span>Documents</span>
            </div>

            <div class="line"></div>

            <div class="step">
                <div class="circle">3</div>
                <span>Confirmation</span>
            </div>

        </div>

        <div class="card">

            <div class="card-title">
                Informations de la demande
            </div>

            <form method="POST"
                  action="{{ route('etudiant.demandes.informations') }}">

                @csrf

                {{-- Service --}}
                <div class="form-group">

                    <label class="required">
                        Service souhaité
                    </label>

                    <select name="idService">

                        <option value="">
                            Sélectionner un service
                        </option>

                        @foreach($services as $service)

                            <option
                                value="{{ $service->idService }}"
                                {{ old('idService') == $service->idService ? 'selected' : '' }}
                            >
                                {{ $service->nomService }}
                            </option>

                        @endforeach

                    </select>

                    @error('idService')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Dates --}}
                <div class="row">

                    <div class="form-group">

                        <label class="required">
                            Date de début souhaitée
                        </label>

                        <input
                            type="date"
                            name="dateDebut"
                            value="{{ old('dateDebut') }}"
                        >

                        @error('dateDebut')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label class="required">
                            Date de fin souhaitée
                        </label>

                        <input
                            type="date"
                            name="dateFin"
                            value="{{ old('dateFin') }}"
                        >

                        @error('dateFin')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- Thème --}}
                <div class="form-group">

                    <label class="required">
                        Sujet / Thème
                    </label>

                    <input
                        type="text"
                        name="theme"
                        placeholder="Exemple : Développement d'une application web"
                        value="{{ old('theme') }}"
                    >

                    @error('theme')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Motivation --}}
                <div class="form-group">

                    <label class="required">
                        Motivation
                    </label>

                    <textarea
                        name="motivation"
                        placeholder="Présentez brièvement votre motivation pour ce stage..."
                    >{{ old('motivation') }}</textarea>

                    @error('motivation')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="buttons">

                    <a
                        href="{{ route('etudiant.dashboard') }}"
                        class="btn btn-back"
                    >
                        ← Retour
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Suivant →
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>