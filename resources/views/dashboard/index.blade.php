<x-dashboard-layout>
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Banque</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bank"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ Auth::user()->bank->sold }}</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Caisse</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ Auth::user()->checkout->sold }}</h6>


                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Recentes Transaction</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">Montant</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</x-dashboard-layout>
