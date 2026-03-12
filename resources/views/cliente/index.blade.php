<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Personais próximos</title>


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


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand">
            <i class="bi bi-lightning-charge-fill me-2"></i>
            RG Power Gym
        </a>


    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto gap-2">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('cliente.index') }}">
                    <i class="bi bi-person"></i> Perfil
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bell"></i> Notificações
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('buscar.personal') }}">
                    <i class="bi bi-person-badge"></i> Personais
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('buscar.academias') }}">
                    <i class="bi bi-building"></i> Academias
                </a>
            </li>

        </ul>
    </div>
</div>


</nav>





</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
