@props([
    'id' => $id,
    'chartType' => 'bar',
    'chartLabel' => 'Bar Chart',
    'labels' => $labels,
    'data' => $data,
    'view' => null,
])
<div class="card">
    <div class="card-body">
        <canvas id="{{ $id }}"></canvas>
    </div>
    {{-- @if ($view)
        <div>
            <a href="{{ $view }}" class="btn btn-link btn-sm">view all</a>
        </div>
    @endif --}}
</div>
<script>
    let _labels{{ $id }} = "<?php echo $labels; ?>";

    _labels{{ $id }} = JSON.parse(_labels{{ $id }}.replace(/&quot;/g, '"'));

    let _chart{{ $id }} = {
        type: '{{ $chartType }}',
        data: {
            labels: _labels{{ $id }},
            datasets: [{
                label: '{{ $chartLabel }}',
                data: {{ @json_encode($data) }},
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }

    chart = new Chart(document.querySelector("#{{ $id }}"), _chart{{ $id }});
    chart.render();
</script>
