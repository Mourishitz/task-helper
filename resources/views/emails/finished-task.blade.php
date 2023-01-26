@vite('resources/css/app.css')

<x-mail::message>

<h1 style="display: flex; justify-content: center">Parabéns! Você concluiu uma tarefa 🎉</h1>
<br>
<div
    style="
        border: 2px solid {{$task->color}};
        border-top-left-radius: 1em;
        border-top-right-radius: 1em;
        height: 25px;
        width: 100%;
        background: {{ $task->color }};
    ">
</div>
<div
    style="
        display: flex;
        align-items: center;
        flex-direction: column;
        padding: 10px;
        border: 2px solid {{ $task->color }};
        border-bottom-left-radius: 0.5em;
        border-bottom-right-radius: 0.5em;
    ">

## Tarefa: <span style="color: {{ $task->color }}">{{ $task->name }}</span>

## Descrição: <span style="color: {{ $task->color }}">{{ $task->description }}</span>

<br>

### Prioridade: &nbsp; <progress class="progress progress-error w-56" value="{{ $task->importance }}" max="100"></progress>

<br>

### Data limite de conclusão: <span style="color: {{ $task->color }}">{{ $final_date }}</span>
</div>


<x-mail::button url="{{$url}}">
    Acessar a Tarefa
</x-mail::button>

</x-mail::message>

