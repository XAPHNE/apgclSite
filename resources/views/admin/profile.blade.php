@extends('components.layouts.adminLTE')

@section('title')
    Profile
@endsection

@section('page_title')
    Profile
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Profile</li>
    <li class="breadcrumb-item active">{{ auth()->user()->name }}</li>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>            
        </div>
    @endif

    @if ($errors->has('current_password'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('current_password') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (auth()->user()->must_change_passwd)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            You must change your password before proceeding.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center equal-height-cards">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">{{ __('My Profile Information') }}</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Department:</strong> {{ $user->department }}</p>
                    <p><strong>Role:</strong>
                        @if ($user->roles->isNotEmpty())
                            @foreach ($user->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                    <p><strong>Permissions:</strong>
                        @if ($user->roles->contains('name', 'Super Admin'))
                            <span class="badge badge-danger">All Access</span>
                        @elseif ($user->permissions->isNotEmpty())
                            @foreach ($user->permissions as $permission)
                                <span class="badge badge-success">{{ $permission->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                    <p><strong>Created at:</strong> {{ $user->created_at->format('M d Y, h:i A') }}</p>
                    <p><strong>Last updated at:</strong> {{ $user->updated_at->format('M d Y, h:i A') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .equal-height-cards {
            display: flex;
            align-items: stretch;
        }

        .equal-height-cards .card {
            flex: 1; /* Make cards take equal width and stretch in height */
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".equal-height-cards .card");
            let maxHeight = 0;

            // Determine the maximum height
            cards.forEach(card => {
                maxHeight = Math.max(maxHeight, card.offsetHeight);
            });

            // Apply the maximum height to all cards
            cards.forEach(card => {
                card.style.height = maxHeight + "px";
            });
        });
    </script>
@endpush