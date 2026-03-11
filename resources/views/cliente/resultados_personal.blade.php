<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Personais próximos</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body{
        background-color:#f4f6f9;
    }

    .navbar-brand{
        font-weight:bold;
        letter-spacing:1px;
    }

    .card{
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.08);
        transition:0.2s;
    }

    .card:hover{
        transform:translateY(-3px);
    }
</style>
```

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand">
            <i class="bi bi-lightning-charge-fill me-2"></i>
            RG Power Gym
        </a>

```
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto gap-2">

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person"></i> Perfil
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bell"></i> Notificações
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-badge"></i> Personais
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-building"></i> Academias
                </a>
            </li>

        </ul>
    </div>
</div>
```

</nav>

<div class="container">

<h3 class="mb-4">
<i class="bi bi-geo-alt-fill"></i>
Personais próximos do CEP {{ $cep }}
</h3>

<div class="row">

@forelse($personals as $personal)

<div class="col-md-4 mb-4">

<div class="card p-3">

<h5 class="mb-2">
<i class="bi bi-person-circle"></i>
{{ $personal->nome }}
</h5>

<p class="mb-1">
<strong>Cidade:</strong> {{ $personal->cidade }}
</p>

<p class="mb-1">
<strong>Valor da sessão:</strong>
R$ {{ number_format($personal->valor_secao,2,',','.') }}
</p>

<p class="mb-1">
<strong>Avaliação:</strong>
{{ $personal->avaliacao }}
</p>

<p class="mb-2">
<strong>Distância:</strong>
{{ number_format($personal->distancia,2) }} km
</p>

<button class="btn btn-primary w-100">
<i class="bi bi-check-circle"></i>
Contratar Personal
</button>

</div>

</div>

@empty

<div class="alert alert-warning">
Nenhum personal encontrado próximo desse CEP.
</div>

@endforelse

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
