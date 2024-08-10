@props([
    'id' => $id,
    'chartType' => 'line',
    'title' => $title,
    'labels' => $labels,
    'data' => $data,
    'view' => null,
])
<?php
// dd($labels, $data);
?>
<div class="card">
    <div class="card-body">
        <canvas id="{{ $id }}"></canvas>
    </div>
    @if ($view)
        <div>
            <a href="{{ $view }}" class="btn btn-link btn-sm">view all</a>
        </div>
    @endif
</div>
<script>
    const _chart{{ $id }} = {
        type: "{{ $chartType }}",
        data: {
            datasets: <?= json_encode($data) ?>,
        },
        options: {
            responsive: true,
            parsing: {
                xAxisKey: 'id',
                yAxisKey: 'value'
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: "{{ $title }}"
                }
            }
        },
    };
    chart = new Chart(document.querySelector("#{{ $id }}"), _chart{{ $id }});
    chart.render();
</script>
