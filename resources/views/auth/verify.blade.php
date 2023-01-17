@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Validação do e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo e-mail foi enviado') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifique seu e-mail e clique no link enviado para prosseguir.') }}
                    <br>
                    {{ __('Caso você não tenha recebido um e-mail, verifique a caixa de SPAM ou') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            {{ __('clique aqui para enviar um novo') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
