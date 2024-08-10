<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

trait DatatableTrait
{

    public function getDataTable(Request $request, $data, $additionalColumns = [], $rawColumns = [], $sortable = false, $routeClass = null, $actionButtons = []): JsonResponse
    {
        $dataTable = DataTables::of($data)
            ->addIndexColumn();

        foreach ($additionalColumns as $columnName => $callback) {
            $dataTable->addColumn($columnName, $callback);
        }

        $dataTable->addColumn('action', function ($row) use ($routeClass, $actionButtons) {
            $baseClassName = $routeClass ?? Str::plural(strtolower(class_basename($row)));
            $route = $route2 = "";
            $actionBtn = ($actionButtons instanceof \Closure ? $actionButtons($row) : $actionButtons);
            if (isset($actionBtn["edit"])) {
                if ($actionBtn["edit"] != false) {
                    $route2 .= $actionBtn["edit"];
                }
                unset($actionBtn["edit"]);
            } else {
                $route2 .= view('components.table.edit_btn', [
                    'routeEdit' => route('admin.' . $baseClassName . '.edit', $row->id),
                ])->render();
            }
            if (isset($actionBtn["delete"])) {
                if ($actionBtn["delete"] != false) {
                    $route2 .= $actionBtn["delete"];
                }
                unset($actionBtn["delete"]);
            } else {
                $route2 .= view('components.table.delete_btn', [
                    'routeDestroy' => route('admin.' . $baseClassName . '.destroy', $row->id),
                ])->render();
            }
            if (isset($actionBtn["status"])) {
                if ($actionBtn["status"] != false) {
                    $route2 .= $actionBtn["status"];
                }
                unset($actionBtn["status"]);
            } else {
                $route2 .= view('components.form.switch', [
                    'model' => $row,
                    'attribute' => 'status',
                ])->render();
            }

            foreach ($actionBtn as $ab) {
                $route .= $ab;
            }
            $fullroute = $route . $route2;
            if (strlen($fullroute) > 0) {
                return
                    '<div class="d-flex">' . $fullroute .
                    '</div>';
            }
            return "";
        })->rawColumns(array_merge(['action'], $rawColumns));

        if ($sortable === true) {
            $dataTable->setRowAttr([
                'data-id' => function ($row) {
                    return $row->id;
                },
            ])->setRowClass('row1');
        }

        return $dataTable->make(true);
    }
}
