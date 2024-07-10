<x-guest-layout>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter the code sent to your email</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verify.store') }}">
                @csrf

                <!-- Two-Factor Code -->
                <div class="input-group mb-3">
                    <input type="text" name="two_factor_code" class="form-control" placeholder="Two-Factor Code" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('two_factor_code')" class="mt-2" />

                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('verify.resend') }}">Resend Code</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Verify</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
