@extends('layouts.app')

@vite('resources/css/app.css')
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex justify-content-center" style="background-color: {{ $task->color }}">
                    </div>

                    <fieldset disabled>
                        <div class="card-body">
                            <label for="name">Nome da Tarefa</label>
                            <input name="name" id="name" type="text" value="{{ $task->name }}" class="input input-primary w-full max-w-xs" />

                            <div class="flex justify-content-start">
                                <span>Prazo final: &nbsp;</span>
                                @if(date('d/m/Y - D', strtotime($task->final_date)) === '01/01/1970 - Thu')
                                    Nenhum
                                @else
                                    {{date('d/m/Y - D', strtotime($task->final_date))}}
                                @endif
                            </div>

                            <label for="importance">Nível de Importância</label>
                            <input id="importance" value="{{ $task->importance }}" name="importance" type="range" min="0" max="100" step="25" class="w-full range range-primary" />
                            <div class="w-full flex justify-content-between text-xs px-2">
                                <span>0</span>
                                <span>25</span>
                                <span>50</span>
                                <span>75</span>
                                <span>100</span>
                            </div>
                            <label for="description">Descrição da Tarefa</label>
                            <textarea name="description" id="description" class="textarea textarea-primary">{{ $task->description }}</textarea>

                        </div>
                    </fieldset>
                    <form action="{{ url()->previous() }}" class="m-3">
                        <button class="btn btn-outline-primary w-full">Voltar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

