@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach($users as $user)
        <div class="col">
            <div class="card h-100 shadow-sm">
                {{-- Фото с фиксированной высотой и полным отображением --}}
                <div style="height: 150px; overflow: hidden;">
                    <img src="{{ $user->photo }}"
                        class="card-img-top h-100 w-100 object-fit-contain bg-light p-2"
                        alt="{{ $user->name }}"
                        loading="lazy">
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title fs-6 mb-1">{{ $user->name }}</h5>
                    <p class="card-text small text-truncate mb-1">{{ $user->email }}</p>
                    <p class="card-text small text-muted">{{ $user->phone }}</p>
                    <p class="card-text small text-muted">{{ $user->position->name }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div>
            @if($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary">Показать больше</a>
            @else
            <a href="{{ $users->url(1) }}" class="btn btn-primary">Вернуться в начало</a>
            @endif
        </div>

        <div>
            <a href="{{ route('users.create') }}" class="btn btn-success">Добавить пользователя</a>
        </div>
    </div>


</div>

<style>
    /* Уменьшаем размеры карточек */
    .card {
        border-radius: 8px;
    }

    .card-img-top {
        object-position: center;
    }

    .pagination .page-link {
        padding: 0.3rem 0.6rem;
        font-size: 0.875rem;
    }

    .container {
        max-width: 1000px;
        padding: 0 15px;
        padding: 25px;
        max-height: 100vh;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
</style>
@endsection