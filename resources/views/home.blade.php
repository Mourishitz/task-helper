@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Olá {$name}!") }}</div>

                <div class="card-body">
                    <div class="stats shadow text-content">

                        <div class="stat">
                            <div class="stat-title">Você tem</div>
                            <div class="stat-value">{{ $active_tasks }}</div>
                            <div class="stat-title">Tarefas</div>
                            <div class="stat-actions">
                                <a class="btn btn-sm btn-success" href="{{ url()->to('task') }}">Visualizar</a>
                            </div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Foram criadas</div>
                            <div class="stat-value">{{ $month_tasks }}</div>
                            <div class="stat-title">tarefas esse mês</div>
                            <div class="stat-actions">
                                <span class="inline-block py-1 px-2 mb-2 text-xs text-white bg-green-500 rounded-full">
                                    {{ $month_tasks - $active_tasks }} Realizadas
                                </span>
                            </div>
                        </div>
                    </div>

                    <section class="py-8">
                        <div class="container px-4 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                <div class="w-full md:w-1/2 lg:w-1/4 p-4">
                                    <div class="pt-6 text-center bg-white rounded">
                                        <h4 class="mb-2 text-xs text-gray-500">Ultima tarefa realizada:</h4>
                                        <p class="mb-1 text-4xl font-bold">{{ $latest_task_days === 0 ? 'Hoje' : "$latest_task_days dias" ?? 'Não há registros'}}</p>
                                        <span class="inline-block py-1 px-2 mb-2 text-xs text-white bg-green-500 rounded-full">{{ $latest_task }}</span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/4 p-4">
                                    <div class="pt-6 text-center bg-white rounded">
                                        <h4 class="mb-2 text-xs text-gray-500">Tarefas com prazo</h4>
                                        <p class="mb-1 text-4xl font-bold">{{ $tasks_to_finish }}</p>
                                        <span class="inline-block py-1 px-2 mb-2 text-xs text-white bg-red-500 rounded-full">{{ $first_date_task }}</span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/4 p-4">
                                    <div class="pt-6 text-center bg-white rounded">
                                        <h4 class="mb-2 text-xs text-gray-500">Tarefas Importantes</h4>
                                        <p class="mb-1 text-4xl font-bold">{{ $over_50_importance_task }}</p>
                                        <span class="inline-block py-1 px-2 mb-2 text-xs text-white bg-red-500 rounded-full">{{$over_75_importance_task }} acima de 75</span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/4 p-4">
                                    <div class="pt-6 text-center bg-white rounded">
                                        <h4 class="mb-2 text-xs text-gray-500">Membro desde:</h4>
                                        <p class="mb-1 text-4xl font-bold">{{ date('M Y', strtotime($member_since)) }}</p>
                                        <span class="inline-block py-1 px-2 mb-2 text-xs text-white bg-green-500 rounded-full">
                                            {{ date('d/m/y H:i', strtotime($member_since)) }}
                                        </span>
                                        <div class="chart" data-type="area-small" data-variant="orange"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
