@extends('layouts.app') 

@section('content')
<div class="form-group">
<form action="{{ route('cliente.buscar') }}" method="POST">
    @csrf
    <input type="text" name="cep" placeholder="Digite seu CEP" required>
    <button type="submit">Buscar</button>
</form>
</div>
@endsection