<?php

namespace App\Http\Services;

// $heads = [
//     'ID',
//     'Name',
//     ['label' => 'Phone', 'width' => 40],
//     ['label' => 'Actions', 'no-export' => true, 'width' => 5],
// ];

// $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
//                 <i class="fa fa-lg fa-fw fa-pen"></i>
//             </button>';
// $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
//                   <i class="fa fa-lg fa-fw fa-trash"></i>
//               </button>';
// $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
//                    <i class="fa fa-lg fa-fw fa-eye"></i>
//                </button>';

// $config = [
//     'data' => [
//         [22, 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
//         [19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
//         [3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
//     ],
//     'order' => [[1, 'asc']],
//     'columns' => [null, null, null, ['orderable' => false]],
// ];

// <x-adminlte-datatable id="table1" :heads="$heads">
//               @foreach($config['data'] as $row)
//                   <tr>
//                       @foreach($row as $cell)
//                           <td>{!! $cell !!}</td>
//                       @endforeach
//                   </tr>
//               @endforeach
//           </x-adminlte-datatable>

class DataTablesService
{
    public function __construct(
        private ?array $heads = [], // colunas
        private ?array $data = [], // linhas
        private ?array $order = [], // ordenação
        private ?array $columns = [], // config colunas
    ) {}

    public function config(): array
    {
        return [
            'heads' => $this->heads,
            'data' => $this->data,
            'order' => $this->order,
            'columns' => $this->columns,
        ];
    }

    public function heads(array $columns): array
    {
        $this->heads = $columns;

        return $this->heads;
    }

    public function data(array $rows): array
    {
        $this->data = $rows;

        return $this->data;
    }

    public function order(array $order): array
    {
        $this->order = $order;

        return $this->order;
    }

    public function columns(array $columns): array
    {
        $this->columns = $columns;

        return $this->columns;
    }

    public function btnEdit(string $route, array $parameters): string
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
    }

    public function btnDelete(string $route, array $parameters): string
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </a>';
    }

    public function btnDetails(string $route, array $parameters): string
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
    }

    public function btnAdd(string $route, array $parameters, string $label): string
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-default text-success mx-1 shadow" title="Add '.$label.'">
                    <i class="fa fa-lg fa-fw fa-plus"></i>
                </a>';
    }
}
