@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>{!! implode('<br>', $errors->all(':message')) !!}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
