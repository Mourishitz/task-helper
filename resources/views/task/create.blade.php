@extends('layouts.app')

@vite('resources/css/app.css')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Adicionar Tarefa') }}</div>

                    <form method="post" action="{{ route('task.store') }}">
                        @csrf
                        <div class="card-body">
                            <label for="name">Nome da Tarefa</label>
                            <input name="name" id="name" type="text" placeholder="Nome" class="input input-primary w-full max-w-xs" />

                            <br>

                            <div>
                                <label class="label cursor-pointer">
                                    <span class="label-text">Tem prazo final?</span>
                                    <input type="checkbox"
                                           id="has_date"
                                           class="checkbox checkbox-primary"
                                           onchange="
                                               checkbox = document.getElementById('has_date');
                                               date = document.getElementById('date');
                                               div = document.getElementById('date_div')
                                               if(checkbox.checked === true){
                                                   date.disabled = false;
                                                   div.hidden = false;
                                               } else {
                                                   date.disabled = true;
                                                   div.hidden = true;
                                               }
                                    "/>
                                </label>
                            </div>

                            <br>

                            <div id="date_div" hidden>
                                <label for="date">Data Final</label>
                                <input disabled type="date" name="final_date" id="date" class="w-full input input-primary"/>
                                <script>
                                    const today = new Date().toISOString().slice(0, 10);
                                    const input = document.getElementById('date')
                                    input.value = today;
                                </script>
                            </div>

                            <br>

                            <label for="color">Cor da Tarefa</label>
                            <input value="#661AE6" id="color" name="color" type="color" class="w-full" onchange="document.getElementById('color_label').innerText = value"/>
                            <div class="flex justify-content-center" id="color_label"></div>

                            <br>

                            <label for="importance">Nível de Importância</label>
                            <input id="importance" name="importance" type="range" min="0" max="100" step="25" class="w-full range range-primary" />
                            <div class="w-full flex justify-content-between text-xs px-2">
                                <span>0</span>
                                <span>25</span>
                                <span>50</span>
                                <span>75</span>
                                <span>100</span>
                            </div>

                            <br>

                            <label for="description">Descrição da Tarefa</label>
                            <textarea name="description" id="description" class="textarea textarea-primary" placeholder="Descrição"></textarea>

                            <button class="btn btn-outline-primary" type="submit">Criar Tarefa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
