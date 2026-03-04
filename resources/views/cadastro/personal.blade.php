<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Personal | GR Power Gym</title>
    
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
            --input-bg: rgba(255, 255, 255, 0.05);
            --error: #ff4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(212, 255, 0, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(212, 255, 0, 0.05) 0%, transparent 20%);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 60px 20px;
        }

        .auth-container { width: 100%; max-width: 800px; animation: fadeIn 0.8s ease-out; }
        .auth-header { text-align: center; margin-bottom: 40px; }
        .logo { font-family: 'Syncopate', sans-serif; font-size: 2.2rem; letter-spacing: 6px; color: var(--primary); text-transform: uppercase; display: block; }

        .auth-card {
            background: var(--card-bg);
            padding: 45px;
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 0 18px;
            transition: 0.3s;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(212, 255, 0, 0.1);
        }

        .input-wrapper i { color: var(--text-dim); font-size: 1rem; width: 20px; margin-right: 10px; text-align: center; }
        .input-wrapper input { flex: 1; background: transparent; border: none; padding: 14px 0; color: #fff; font-size: 0.95rem; outline: none; }

        /* Estilo para CEP Loading */
        .loading-text { font-size: 0.7rem; color: var(--primary); display: none; margin-top: 5px; font-weight: bold; }

        .alert { padding: 15px; border-radius: 14px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-error { background: rgba(255, 68, 68, 0.1); border: 1px solid var(--error); color: var(--error); }
        .alert-success { background: rgba(212, 255, 0, 0.1); border: 1px solid var(--primary); color: var(--primary); }

        .btn-register {
            grid-column: span 2;
            background: var(--primary);
            color: var(--bg-dark);
            border: none;
            padding: 18px;
            border-radius: 16px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 15px;
        }

        .btn-register:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(212, 255, 0, 0.3); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <main class="auth-container">
        <div class="auth-header">
            <span class="logo">FIT<span>SYS</span></span>
            <p style="color: var(--text-dim); margin-top: 10px; letter-spacing: 1px;">CADASTRO DE PERSONAL TRAINER</p>
        </div>

        <div class="auth-card">
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('sucesso'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('personal.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
                @csrf
                
                <div class="form-group full-width">
                    <label>Nome Completo</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Seu nome completo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-id-card"></i>
                        <input type="text" name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-calendar"></i>
                        <input type="date" name="idade" value="{{ old('idade') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>CEP</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-map-pin"></i>
                        <input type="text" name="cep" id="cep" value="{{ old('cep') }}" placeholder="00000000" maxlength="8" required>
                    </div>
                    <span id="cep-loading" class="loading-text"><i class="fa-solid fa-spinner fa-spin"></i> Buscando...</span>
                </div>

                <div class="form-group">
                    <label>Cidade / UF</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-city"></i>
                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" placeholder="Cidade/UF" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Logradouro / Bairro</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" placeholder="Rua, Bairro..." required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>E-mail Profissional</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-shield-halved"></i>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Valor por Sessão (R$)</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <input type="number" step="0.01" name="valor_secao" value="{{ old('valor_secao') }}" placeholder="80.00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Certificado (PDF/IMG)</label>
                    <div class="input-wrapper" style="padding: 10px;">
                        <input type="file" name="certificado" accept=".pdf,.jpg,.png" required>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    Finalizar Cadastro Profissional <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>
    </main>

    <script>
        // Lógica BrasilAPI para Personal
        document.getElementById('cep').addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            const loading = document.getElementById('cep-loading');
            loading.style.display = 'block';

            fetch(`https://brasilapi.com.br/api/cep/v1/${cep}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.errors) {
                        document.getElementById('cidade').value = `${data.city} - ${data.state}`;
                        document.getElementById('endereco').value = `${data.street}, ${data.neighborhood}`;
                    }
                })
                .catch(() => console.error("Erro ao buscar CEP"))
                .finally(() => loading.style.display = 'none');
        });
    </script>

</body>
</html>