<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        .input-field {
            width: 100%;
            border: 1.5px solid #d1d5db;
            border-radius: 0.4rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #374151;
            margin-bottom: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-field:focus { border-color: #6366f1; }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 1.25rem;
        }
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .forgot-link {
            font-size: 0.85rem;
            color: #6b7280;
            text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }
        .btn-login {
            background-color: #34d399;
            color: white;
            font-weight: 600;
            padding: 0.55rem 1.5rem;
            border: none;
            border-radius: 0.4rem;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background-color 0.2s;
        }
        .btn-login:hover { background-color: #10b981; }
        .error-msg { color: #ef4444; font-size: 0.8rem; margin-top: -0.75rem; margin-bottom: 0.75rem; }
    </style>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Email"
            value="{{ old('email') }}" required autofocus
            class="input-field">
        @error('email')<p class="error-msg">{{ $message }}</p>@enderror

        <input type="password" name="password" placeholder="Password"
            required class="input-field">
        @error('password')<p class="error-msg">{{ $message }}</p>@enderror

        <label class="remember-label">
            <input type="checkbox" name="remember"> Remember me
        </label>

        <div class="form-actions">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Forgot your password?</a>
            @endif
            <button type="submit" class="btn-login">Log in</button>
        </div>
    </form>
</x-guest-layout>