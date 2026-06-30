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

        <div style="position: relative;">
            <input type="password" name="password" id="password-field" placeholder="Password"
                required class="input-field" style="padding-right: 2.5rem;">
            <button type="button" id="togglePassword"
                style="position: absolute; right: 0.8rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center;">
<svg id="eyeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-7-11-7a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 7 11 7a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
    <line x1="1" y1="1" x2="23" y2="23"></line>
</svg>
            </button>
        </div>
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

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const field = document.getElementById('password-field');
        const icon = document.getElementById('eyeIcon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.innerHTML = '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"></path><circle cx="12" cy="12" r="3"></circle>';
        } else {
            field.type = 'password';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-7-11-7a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 7 11 7a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        }
    });
</script>
</x-guest-layout>