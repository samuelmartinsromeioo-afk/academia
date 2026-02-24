<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'RG Power Gym')</title>

    <!-- BELEZA DO SITE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-link {
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ffffff !important;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(218, 10, 10, 0.08);
        }
    </style>
</head>

<div class="selecao-container">
    <h2>Como você deseja se cadastrar?</h2>

    <div class="cards">
        <a href="{{ route('cadastro.ir', ['tipo' => 'personal']) }}" class="card">
            <h3>Sou Personal</h3>
            <p>Quero gerenciar meus alunos.</p>
        </a>

        <a href="{{ route('cadastro.ir', ['tipo' => 'cliente']) }}" class="card">
            <h3>Sou Aluno</h3>
            <p>Quero treinar e ver minha evolução.</p>
        </a>

        <a href="{{ route('cadastro.ir', ['tipo' => 'academia']) }}" class="card">
            <h3>Sou Academia</h3>
            <p>Quero gerenciar meu estabelecimento.</p>
        </a>
    </div>
</div>