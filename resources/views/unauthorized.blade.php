@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Acesso negado.") }}</div>

                <div class="card-body">
                    <h1>Você não possui permissão para acessar esta rota.</h1>
                    <form action="{{ url()->to('home') }}" class="w-full">
                        <button class="btn btn-danger w-full">Voltar a Home</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
