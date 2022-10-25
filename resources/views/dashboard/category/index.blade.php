<x-dashboard-layout>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout de catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editer une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('category.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="" name="category_id" id="category_id">
                        <input type="text" name="name" class="form-control" id="category_name" value="" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
                            <h5 class="card-title">Catégories</h5>
                            <div class="float-end">
                                <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                    <i class="bi bi-card-text"></i>
                                    Nouvelle catégorie
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Toutes les catégories</h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Auth::user()->categories as $one)
                                    <tr>
                                        <td>
                                            {{ $one->name }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal"
                                                        data-bs-category="{{ $one->id }}"
                                                        data-bs-name="{{ $one->name }}"
                                                >
                                                    <i class="bi bi-brush"></i>
                                                </button>
                                                <form
                                                    class="ms-2"
                                                    method="POST"
                                                    action="{{ route('category.delete', ['category_id' => $one->id]) }}"
                                                    onsubmit="return confirm('Voulez vous vraiment supprimer cette catégorie ?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>

    <x-slot name="script">
        <script>
            var exampleModal = document.getElementById('editCategoryModal')
            exampleModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var category_id = button.getAttribute('data-bs-category')
                var category_name = button.getAttribute('data-bs-name')
                document.getElementById('category_id').value = category_id
                document.getElementById('category_name').value = category_name
            })

        </script>
    </x-slot>
</x-dashboard-layout>
