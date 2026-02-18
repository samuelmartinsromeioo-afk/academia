@extends('layouts.login')
@section('title', 'Login')   
@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            

            {{-- Erros --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <b>Ops:</b>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Cadastrar --}}
            <form action="{{ route('login.edit') }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="senha" class="form-control" placeholder="Senha" value="{{ old('senha') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Usuário</label>
                        <select name="tipo_usuario" class="form-select">
                            <option value="aluno">Aluno</option>
                            <option value="personal">Personal</option>
                            <option value="academia">Academia</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-grid">
                        <button class="btn btn-primary" type="submit">Logar</button>
                    </div>
                </div>
            </form>
            {{-- Voltar --}}
            <a href= "{{ route('login.index') }}">
                            <button class="btn btn-primary" type="submit">Voltar</button>
            </a>
            
        </div>
    </div>
</div>

@endsection