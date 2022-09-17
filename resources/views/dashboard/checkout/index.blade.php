<x-dashboard-layout>
    <div class="modal fade" id="addSoldModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout de solde</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('checkout.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" value="1" name="source">
                        <input type="hidden" value="1" name="type">
                        <input type="hidden" value="0" name="category">
                        <input type="hidden" value="Ajout initial de solde" name="comments">
                        <input type="number" min="0" step="0.01" name="amount" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cashierTransfertModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfert vers la banque</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('transaction.execute') }}">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" value="1" name="source">
                        <input type="hidden" value="0" name="type">
                        <input type="hidden" value="0" name="category">
                        <input type="hidden" value="1" name="trans_to_bank">
                        <input type="number" min="0" step="0.01" name="amount" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('transaction.execute') }}">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" value="1" name="source">
                        <label class="mt-3">Type de transaction</label>
                        <select class="form-select" name="type" required>
                            <option value=""></option>
                            <option value="0">Débit</option>
                            <option value="1">Crédit</option>
                        </select>
                        <label class="mt-3">Catégorie</label>
                        <select class="form-select" name="category" required>
                            <option value="0">Aucun</option>
                            @foreach(Auth::user()->categories as $one)
                                <option value="{{ $one->id }}">{{ $one->name }}</option>
                            @endforeach
                        </select>
                        <label class="mt-3">Montant</label>
                        <input type="number" min="0" step="0.01" name="amount" class="form-control">
                        <label class="mt-3">Commentaire</label>
                        <textarea name="comments" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Caisse</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ number_format(Auth::user()->checkout->sold, 2, ',', ' ') }} {{ Auth::user()->devise }}</h6>

                                </div>
                            </div>
                            @if(Auth::user()->checkout->sold == 0)
                                <div class="col-sm ml-1">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSoldModal">
                                        Ajouter une somme
                                    </button>
                                </div>
                            @endif
                            <div class="float-end">
                                <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#transactionModal">
                                    <i class="bi bi-arrow-left-right"></i>
                                    Nouvelle transaction
                                </button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cashierTransfertModal">
                                    <i class="bi bi-cash-coin"></i>
                                    Transfert vers la banque
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Transactions récentes <a href="{{ route('checkout', ['filter'=>'all']) }}" class="btn btn-primary">Toutes les transactions</a></h5>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Commentaire</th>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">Montant</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $one)
                                    <tr>
                                        <td>{{ $one->created_at->format('Y-m-d') }}</td>
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
