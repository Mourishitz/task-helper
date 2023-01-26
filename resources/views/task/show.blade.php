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
                    <fieldset disabled id="fieldset">
                        <form action="{{ route('task.update', ['task' => $task->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input name="_method" type="hidden" value="PUT">

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
                                <input
                                    id="importance"
                                    value="{{ $task->importance }}"
                                    name="importance"
                                    type="range"
                                    min="0"
                                    max="100"
                                    step="25"
                                    class="w-full range range-primary"
                                />
                                <div class="w-full flex justify-content-between text-xs px-2">
                                    <span>0</span>
                                    <span>25</span>
                                    <span>50</span>
                                    <span>75</span>
                                    <span>100</span>
                                </div>
                                <label for="description">Descrição da Tarefa</label>
                                <textarea name="description" id="description" class="textarea textarea-primary">{{ $task->description }}</textarea>
                                <button id="edit-button" class="btn btn-primary" type="submit" hidden>Atualizar</button>
                            </div>
                        </form>
                    </fieldset>

                    <button
                        onclick="
                            const button = document.getElementById('edit-button');
                            const fieldset = document.getElementById('fieldset');

                            fieldset.disabled = !fieldset.disabled;
                            button.hidden = !button.hidden;
                        "
                        class="btn btn-outline-warning m-3 mb-0"
                    >
                        Editar
                    </button>
                    <form action="{{ url()->to('task') }}" class="m-3 mt-2">
                        <button class="btn btn-outline-primary w-full">Visualizar todas as tarefas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

