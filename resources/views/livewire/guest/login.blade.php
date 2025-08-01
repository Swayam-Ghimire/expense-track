<div>
    <x-left-section />
    <!-- Right Section -->
    <div class="custom-form-container" id="register">
        <h1 class="custom-form-title">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="custom-input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="(e.g abc@gmail.com)" required>
                <label for="email">E-mail</label>
            </div>

            <div class="custom-input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" value="Login" class="custom-btn" name="Login">
        </form>
        <div class="custom-links">
            <p>Don't have an account yet?</p>
            <a href="/register">Register</a>
        </div>
    </div>
</div>
</div>