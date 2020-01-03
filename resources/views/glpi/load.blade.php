@extends('glpi.layout')

@section('content')

<br>
<div class="row">
    <div class="col-12">

    </div>
</div>


<table class="table table-bordered">
    <tr>
        <th>Тип</th>
        <th>Имя</th>
        <th>Контакт</th>
        <th>Инвентарный номер</th>
        <th>МОЛ</th>
        <th>Местоположение</th>

    </tr>
    @foreach ($computers as $c)
    <tr>
        <td>
            @if (!empty($c->getComputerDetais('ComputerType')->name))
                {{ $c->getComputerDetais('ComputerType')->name }}
            @endif
        </td>
        <td>{{ $c->name }}</td>
        <td>{{ $c->contact }}</td>
        <td>{{ $c->otherserial }}</td>
        <td>
            @if (!empty($c->getComputerDetais('User')->name))
                {{ $c->getComputerDetais('User')->name }}
            @else
                Пусто!
            @endif

        </td>
        <td>
            @if (!empty($c->getComputerDetais('Location')->name))
                {{ $c->getComputerDetais('Location')->name }}
            @else
                Пусто!
            @endif

        </td>
    </tr>
    @endforeach
</table>

@endsection
