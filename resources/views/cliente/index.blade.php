<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personais Próximos - RG POWER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #d4ff00;
            --bg-dark: #0a0b0d;
            --card-bg: #16181d;
            --text-main: #ffffff;
            --text-dim: #9ca3af;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--bg-dark);
            background-image:
                radial-gradient(circle at 10% 20%, rgba(212, 255, 0, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(212, 255, 0, 0.05) 0%, transparent 20%);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo {
            font-family: 'Syncopate', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 3px;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-links { display: flex; gap: 25px; }
        .nav-links a {
            text-decoration: none;
            color: var(--text-dim);
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-links a:hover { color: var(--primary); }

        /* CONTEÚDO */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 60px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 { font-size: 2.5rem; font-weight: 800; }
        .header span { color: var(--primary); }
        .header p { margin-top: 10px; color: var(--text-dim); }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
            margin-bottom: 20px;
        }

        .no-img-icon {
            width: 80px;
            height: 80px;
            background: rgba(212, 255, 0, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 2rem;
        }

        .card h3 { margin-bottom: 5px; color: var(--text-main); }
        .specialty {
            color: var(--primary);
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 15px;
            display: block;
        }

        .card p {
            color: var(--text-dim);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .btn {
            display: block;
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            background: var(--primary);
            color: black;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover { filter: brightness(1.1); }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            border: 1px dashed var(--text-dim);
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="/" class="logo">RG POWER</a>
        <div class="nav-links">
            <a href="{{ route('cliente.update') }}"><i class="fa-solid fa-user"></i> Perfil</a>
            <a href="{{ route('cliente.buscarPersonal') }}"><i class="fa-solid fa-dumbbell"></i> Personais</a>
            <a href="{{ route('cliente.buscarAcademias') }}"><i class="fa-solid fa-building"></i> Academias</a>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>Personais <span>próximos</span></h1>
            <p>Mostrando treinadores em um raio de <strong>{{ $distancia_referencia ?? '15km' }}</strong></p>
        </div>

        <div class="grid">
            {{-- Loop pelos personais --}}
            @forelse($academias as $personal)
                <div class="card">
                    <div>
                        {{-- Verifica se tem foto, senão usa ícone --}}
                        @if($personal->foto)
                            <img src="{{ asset('storage/' . $personal->foto) }}" alt="{{ $personal->nome }}" class="profile-img">
                        @else
                            <div class="no-img-icon">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        @endif

                        <h3>{{ $personal->nome }}</h3>
                        <span class="specialty">{{ $personal->especialidade ?? 'Personal Trainer' }}</span>
                        
                        <p>{{ Str::limit($personal->biografia ?? 'Especialista pronto para te ajudar.', 120) }}</p>
                    </div>

                    <a href="#" class="btn">Ver Perfil Completo</a>
                </div>
            @empty
                <div class="empty-state">
                    <p>Nenhum personal encontrado nesta região.</p>
                </div>
            @endforelse
        </div> {{-- Fim do Grid --}}
    </div> {{-- Fim do Container --}}
</body>
</html>