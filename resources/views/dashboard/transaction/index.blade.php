<x-dashboard-layout>
    <h2>Dépenses</h2>
    <!-- Sales Card -->
    <div class="col-xxl-12 col-md-12">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Tableau des dépenses</h5>

                <div class="d-flex align-items-center">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        @foreach($depenses['categories'] as $name=>$one)
                            <tbody>
                            <tr>
                                <td>
                                    {{ $name }}
                                </td>
                                <td>
                                    {{ !is_null($one->sum) ? number_format($one->sum, 2, ',', ' ') : 0 }} {{ Auth::user()->devise }}
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Sales Card -->
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Courbe</h5>

                    <!-- Line Chart -->
                    <canvas id="lineChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#lineChart'), {
                                type: 'line',
                                data: {
                                    labels: [
                                        @foreach($depenses['days'] as $one)
                                        "{{ $one }}",
                                        @endforeach
                                    ],
                                    datasets: [
                                        @foreach($depenses['transactions'] as $index=>$one)
                                        {
                                            label: "{{ $index }}",
                                            data: [
                                                @foreach($depenses['days'] as $d)
                                                    {{ $one[$d]->sum != null ? $one[$d]->sum : 0 }},
                                                @endforeach
                                            ],
                                            fill: false,
                                            borderColor: 'rgb({{ rand(0,255) }}, {{ rand(0,255) }}, {{ rand(0,255) }})',
                                            tension: 0.5
                                        },
                                        @endforeach
                                        ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <!-- End Line CHart -->

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Diagrammes</h5>

                    <!-- Bar Chart -->
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#barChart'), {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @foreach($depenses['days'] as $one)
                                            "{{ $one }}",
                                        @endforeach
                                    ],
                                    datasets: [
                                        @foreach($depenses['transactions'] as $index=>$one)
                                        {
                                            label: "{{ $index }}",
                                            data: [
                                                @foreach($depenses['days'] as $d)
                                                    {{ $one[$d]->sum != null ? $one[$d]->sum : 0 }},
                                                @endforeach
                                            ],
                                            backgroundColor: [
                                                @foreach($depenses['days'] as $d)
                                                    'rgba({{ rand(0,255) }}, {{ rand(0,255) }}, {{ rand(0,255) }}, 0.2)',
                                                @endforeach
                                            ],
                                            borderColor: [
                                                @foreach($depenses['days'] as $d)
                                                    'rgb({{ rand(0,255) }}, {{ rand(0,255) }}, {{ rand(0,255) }})',
                                                @endforeach
                                            ],
                                            borderWidth: 1
                                        },
                                        @endforeach
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <!-- End Bar CHart -->

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Diagramme circulaire</h5>

                    <!-- Pie Chart -->
                    <canvas id="pieChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#pieChart'), {
                                type: 'pie',
                                data: {
                                    labels: [
                                        @foreach($depenses['categories'] as $name=>$one)
                                        "{{ $name }}",
                                        @endforeach
                                    ],
                                    datasets: [{
                                        label: '',
                                        data: [
                                            @foreach($depenses['categories'] as $name=>$one)
                                                {{ !is_null($one->sum) ? $one->sum : 0 }},
                                            @endforeach
                                        ],
                                        backgroundColor: [
                                            @foreach($depenses['categories'] as $one)
                                                'rgb({{ rand(0,255) }}, {{ rand(0,255) }}, 1{{ rand(0,255) }}32)',
                                            @endforeach
                                        ],
                                        hoverOffset: 4
                                    }]
                                }
                            });
                        });
                    </script>
                    <!-- End Pie CHart -->

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Graphique en anneau</h5>

                    <!-- Doughnut Chart -->
                    <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#doughnutChart'), {
                                type: 'doughnut',
                                data: {
                                    labels: [
                                        @foreach($depenses['categories'] as $name=>$one)
                                            "{{ $name }}",
                                        @endforeach
                                    ],
                                    datasets: [{
                                        label: '',
                                        data: [
                                            @foreach($depenses['categories'] as $name=>$one)
                                                {{ !is_null($one->sum) ? $one->sum : 0 }},
                                            @endforeach
                                        ],
                                        backgroundColor: [
                                            @foreach($depenses['categories'] as $one)
                                                'rgb({{ rand(0,255) }}, {{ rand(0,255) }}, 1{{ rand(0,255) }}32)',
                                            @endforeach
                                        ],
                                        hoverOffset: 4
                                    }]
                                }
                            });
                        });
                    </script>
                    <!-- End Doughnut CHart -->

                </div>
            </div>
        </div>

    </div>
    <hr>
    <!--<h2>Entrées</h2>-->
</x-dashboard-layout>
