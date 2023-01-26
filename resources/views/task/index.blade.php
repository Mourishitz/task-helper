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
                                <tbody id="table">
                                @foreach($tasks as $key => $t)
                                    <tr>
                                        <th>
                                            @if($type == 'active')
                                                <label>
                                                    <input
                                                        id="{{$t['id']}}"
                                                        type="checkbox"
                                                        class="checkbox"
                                                        onclick=""
                                                    />
                                                </label>
                                            @endif
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
