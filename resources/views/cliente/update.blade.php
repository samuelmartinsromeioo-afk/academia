```html
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Perfil</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Inter:wght@300;400;600;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #d4ff00;
            --bg-dark: #0a0b0d;
            --card-bg: #16181d;
            --text-main: #ffffff;
            --text-dim: #9ca3af;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo {
            font-family: 'Syncopate', sans-serif;
            letter-spacing: 3px;
            color: var(--primary);
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .header span {
            color: var(--primary);
        }

        .form-card {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            color: var(--text-dim);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            background: #0f1115;
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 10px;
            color: white;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        .btn {
            margin-top: 30px;
            background: var(--primary);
            color: black;
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .success {
            background: #1f3d1f;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .error {
            background: #3d1f1f;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">RG POWER</div>
    </div>

    <div class="container">

        <div class="header">
            <h1>Editar <span>Perfil</span></h1>
        </div>

        <div class="form-card">

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.update', $cliente->id) }}">

                @csrf
                @method('PUT')

                <div class="grid">

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" value="{{ $cliente->nome }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $cliente->email }}">
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha">
                    </div>

                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="cep" value="{{ $cliente->cep }}">
                    </div>

                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" name="rua" value="{{ $cliente->rua }}">
                    </div>

                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" name="bairro" value="{{ $cliente->bairro }}">
                    </div>

                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" value="{{ $cliente->cidade }}">
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <input type="text" name="estado" value="{{ $cliente->estado }}">
                    </div>

                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" name="complemento" value="{{ $cliente->complemento }}">
                    </div>

                    <div class="form-group">
                        <label>Altura (m)</label>
                        <input type="number" step="0.01" name="altura" value="{{ $cliente->altura }}">
                    </div>

                    <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" value="{{ $cliente->peso }}">
                    </div>

                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <input type="date" name="idade" value="{{ $cliente->idade }}">
                    </div>

                    <div class="form-group">
                        <label>Sexo</label>
                        <select name="sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Frequência semanal</label>
                        <input type="number" name="frequencia_semanal" value="{{ $cliente->frequencia_semanal }}">
                    </div>

                    <div class="form-group">
                        <label>Resumo objetivo</label>
                        <textarea name="resumo_objetivo">{{ $cliente->resumo_objetivo }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Condição clínica</label>
                        <textarea name="condicao_clinica">{{ $cliente->condicao_clinica }}</textarea>
                    </div>

                </div>

                <button class="btn">
                    Salvar Alterações
                </button>

            </form>

        </div>

    </div>

</body>

</html>
```