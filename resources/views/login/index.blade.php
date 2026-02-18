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

            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Login</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.index') }}">
                        @csrf

                        <div class="mb-3">
                           <a href="{{ route('login.cadastrar') }}">
                            <button type="button" class="btn btn-secondary w-100">
                                Cadastrar-se
                            </button>
                            </a>
                        </div>

                        <div class="mb-3">
                            <a href="{{ route('login.logar') }}">
                            <button type="button" class="btn btn-secondary w-100">
                                Logar-se
                            </button>
                            </a>

                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection