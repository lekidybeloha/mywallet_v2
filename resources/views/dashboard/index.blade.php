<x-dashboard-layout>
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">@lang('label.bank')</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bank"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ number_format(Auth::user()->bank->sold, 2, ',', ' ') }} {{ Auth::user()->devise }}</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">@lang('label.cash')</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ number_format(Auth::user()->checkout->sold, 2, ',', ' ') }} {{ Auth::user()->devise }}</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">@lang('label.available')</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cash"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ number_format((Auth::user()->checkout->sold + Auth::user()->bank->sold), 2, ',', ' ') }} {{ Auth::user()->devise }}</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">@lang('label.recent_transaction') <a href="{{ route('dashboard', ['filter'=>'all']) }}" class="btn btn-primary">@lang('label.all_transaction')</a></h5>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('label.date')</th>
                                    <th scope="col">@lang('label.source')</th>
                                    <th scope="col">@lang('label.type')</th>
                                    <th scope="col">@lang('label.comment')</th>
                                    <th scope="col">@lang('label.category')</th>
                                    <th scope="col">@lang('label.amount')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $one)
                                    <tr>
                                        <td>{{ $one->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $one->transaction_source }}</td>
                                        <td>{{ $one->transaction_type }}</td>
                                        <td>{{ $one->comments }}</td>
                                        <td>{{ $one->category ? $one->category->name : '' }}</td>
                                        <td>{{ number_format($one->amount, 2, ',', ' ') }} {{ Auth::user()->devise }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $transactions->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</x-dashboard-layout>
