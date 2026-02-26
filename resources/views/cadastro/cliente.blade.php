<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente | Sistema Fitness</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #d4ff00;
            --bg-dark: #0a0b0d;
            --card-bg: #16181d;
            --text-main: #ffffff;
            --text-dim: #9ca3af;
            --error: #ff4d4d;
            --success: #22c55e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            background-image:
                radial-gradient(circle at 10% 20%, rgba(212, 255, 0, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(212, 255, 0, 0.05) 0%, transparent 20%);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            padding: 2rem;
            text-align: center;
        }

        .logo {
            font-family: 'Syncopate', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 4px;
            color: var(--primary);
            text-transform: uppercase;
        }

        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: var(--card-bg);
            padding: 50px;
            border-radius: 24px;
            width: 100%;
            max-width: 600px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: 0.3s;
        }

        .card:hover {
            border-color: var(--primary);
            box-shadow: 0 0 25px rgba(212,255,0,0.1);
        }

        .card h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .card p {
            color: var(--text-dim);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 0.85rem;
            color: var(--text-dim);
            display: block;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: #0f1115;
            color: var(--text-main);
            outline: none;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(212,255,0,0.2);
        }

        textarea.form-control {
            resize: none;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: var(--primary);
            color: var(--bg-dark);
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212,255,0,0.2);
        }

        .error-message {
            color: var(--error);
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .success-message {
            background: rgba(34,197,94,0.1);
            color: var(--success);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">FIT<span>SYS</span></div>
</header>

<div class="container">
    <div class="card">
        <h2>Cadastro de Cliente</h2>
        <p>Preencha as informações abaixo</p>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cliente.store') }}">
            @csrf

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                @error('nome')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
                @error('senha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Altura (m)</label>
                <input type="number" step="0.01" name="altura" class="form-control" value="{{ old('altura') }}" required>
                @error('altura')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Peso (kg)</label>
                <input type="number" step="0.01" name="peso" class="form-control" value="{{ old('peso') }}" required>
                @error('peso')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Data de Nascimento</label>
                <input type="date" name="idade" class="form-control" value="{{ old('idade') }}" required>
                @error('idade')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Sexo</label>
                <select name="sexo" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>
                @error('sexo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Frequência Semanal</label>
                <input type="number" name="frequencia_semanal" class="form-control" value="{{ old('frequencia_semanal') }}" required>
                @error('frequencia_semanal')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Resumo do Objetivo</label>
                <textarea name="resumo_objetivo" class="form-control" rows="3" required>{{ old('resumo_objetivo') }}</textarea>
                @error('resumo_objetivo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Condição Clínica</label>
                <textarea name="condicao_clinica" class="form-control" rows="3" required>{{ old('condicao_clinica') }}</textarea>
                @error('condicao_clinica')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Cadastrar Cliente
            </button>

        </form>
    </div>
</div>

</body>
</html>