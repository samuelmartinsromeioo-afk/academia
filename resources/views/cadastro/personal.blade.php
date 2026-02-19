<form action="{{ route('personal.store') }}" method="POST">
    @csrf
    <h2>Cadastro de Personal Trainer</h2>

    <input type="text" name="nome" placeholder="Nome Completo" required>
    <input type="text" name="cpf" placeholder="CPF" required>
    <input type="email" name="email" placeholder="E-mail" required>
    
    <label>Data de Nascimento:</label>
    <input type="date" name="idade" required>


    <form action="{{ route('personal.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Anexe seu Certificado (PDF ou Imagem):</label>
    <input type="file" name="certificado" required>
    
    <button type="submit">Cadastrar</button>
    
</form>
    <label>Valor por Seção (R$):</label>
    <input type="number" name="valor_secao" step="0.01" placeholder="Ex: 80.00">

    <button type="submit">Finalizar Cadastro</button>
</form>