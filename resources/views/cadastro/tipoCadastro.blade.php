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