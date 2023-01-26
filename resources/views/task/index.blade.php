@extends('layouts.app')

@vite('resources/css/app.css')
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header flex justify-content-center">
                        Tarefas
                    </div>



                    <div class="z-1 absolute inset-0 hidden justify-center items-center" id="overlay">
                        <div class="bg-gray-200 max-w-sm py-2 px-3 rounded shadow-xl text-gray-800">
                            <div class="flex justify-between items-center">
                                <h4>Concluir Tarefa?</h4>
                                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="mt-2 text-sm">
                                <p>Você poderá visualizar a tarefa em 'Tarefas Concluídas'</p>
                            </div>
                            <div class="mt-3 flex justify-end space-x-3">
                                <button class="btn btn-sm btn-outline-warning" id="cancel">Cancelar</button>
                                <button class="btn btn-sm btn-outline-danger" id="finish">Concluir Tarefa</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        window.addEventListener('DOMContentLoaded', () =>{
                            const cancel = document.querySelector('#cancel')
                            const finish = document.querySelector('#finish')
                            const overlay = document.querySelector('#overlay')
                            const checkbox = document.querySelector('#checkbox')
                            const closeBtn = document.querySelector('#close-modal')

                            const toggleModal = () => {
                                overlay.classList.toggle('hidden')
                                overlay.classList.toggle('flex')
                            }

                            checkbox.addEventListener('click', toggleModal)
                            overlay.addEventListener('focus', toggleModal)
                            closeBtn.addEventListener('click', ()=>{
                                toggleModal();
                                if(checkbox.checked === true){
                                    checkbox.checked = false
                                }
                            })
                            finish.addEventListener('click', ()=>{
                                toggleModal();
                                if(checkbox.checked === true){
                                    checkbox.checked = false
                                }
                            })
                            cancel.addEventListener('click', ()=>{
                                toggleModal();
                                if(checkbox.checked === true){
                                    checkbox.checked = false
                                }
                            })
                        })

                    </script>

                    <div class="card-body">
                        <div class="overflow-x-auto w-full">

                            <div class="flex justify-content-around w-full">
                                <form action="{{ url()->to('task/create') }}" class="m-3 w-full" {{ $type === 'finished' ? 'hidden' : '' }}>
                                    <button class="btn btn-outline-success w-full">Criar Nova Tarefa</button>
                                </form>

                                <form action="{{ $type === 'active' ? url()->to('finished-tasks') : url()->to('task') }}" class="m-3 w-full">
                                    <button class="btn btn-outline-danger w-full">Tarefas {{ $type === 'active' ? 'Concluídas' : 'Ativas' }}</button>
                                </form>
                            </div>
                            <br>
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>
                                        &nbsp;
                                    </th>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Importância</th>
                                    <th>Prazo Final</th>
                                    <th>Criado em:</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $key => $t)
                                <tr>
                                    <th>
                                        <label>
                                            <input
                                                id="checkbox"
                                                type="checkbox"
                                                class="checkbox"
                                            />
                                        </label>
                                    </th>
                                    <td>
                                        <div class="flex items-center space-x-3">
                                            <div>
                                                <div class="font-bold">{{ $t['id'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $t['name'] }}
                                    </td>
                                    <td>
                                        <div class="radial-progress"
                                             style="
                                                --value:{{ $t['importance'] }};
                                                 --size: 4rem;
                                                 color: {{ $t['color'] }};
                                             ">

                                            {{ $t['importance'] }}%

                                        </div>
                                    </td>
                                    <td>
                                        @if(date('d/m/Y - D', strtotime($t['final_date'])) === '01/01/1970 - Thu')
                                            Nenhum
                                        @else
                                            {{date('d/m/Y - D', strtotime($t['final_date']))}}
                                        @endif
                                    </td>
                                    <td>
                                        {{date('d/m/y H:i', strtotime($t['created_at']))}}
                                    </td>
                                    <th>
                                        <div class="flex justify-content-center mt-3">
                                            <form action="{{ url()->to("task/{$t['id']}")}}">
                                                <button class="btn btn-active btn-ghost">Visualizar</button>
                                            </form>
                                            &nbsp;
                                            <form action="{{ url()->to("task/") }}">
                                                <button class="btn btn-active btn-success">Concluir</button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </table>
                            <div class="flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{ $tasks->previousPageUrl() }}">
                                        <button class="btn">«</button>
                                    </a>
                                        @for($i = 1; $i <= $tasks->lastPage(); $i++)
                                            <a  href="{{ $tasks->url($i) }}">
                                                <button
                                                    class="btn {{ $tasks->currentPage() === $i ? 'active' : '' }}"
                                                >
                                                    {{ $i }}
                                                </button>
                                            </a>
                                        @endfor
                                    <a href="{{ $tasks->nextPageUrl() }}">
                                        <button class="btn" type="submit">»</button>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <form action="{{ url()->to('home') }}" class="w-full">
                                <button class="btn btn-outline-primary w-full">Dashboard</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

