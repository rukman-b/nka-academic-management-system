{{-- <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
                <h4>Student Login</h4>
            </div>
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input wire:model.live="email" type="email" class="form-control" placeholder="Enter email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input wire:model.live="password" type="password" class="form-control" placeholder="Enter password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
 --}}


    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card login-card">
                    <div class="login-header">
                        <h3><i class="fas fa-graduation-cap"></i> Student Portal</h3>
                        <p>Sign in to access your dashboard</p>
                    </div>
                    
                    <div class="login-body">
                        @if (session()->has('error'))
                             <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form wire:submit.prevent="login">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input wire:model.live="email" type="text" class="form-control" placeholder="Student Email" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input wire:model.live="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                <a href="{{ route('student.password.request') }}" class="forgot-password float-right">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-login btn-block">Login</button>
                            
                            <div class="divider">
                                <span class="divider-text">OR CONNECT WITH</span>
                            </div>
                            
                            <div class="text-center">
                                <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-microsoft"></i></a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="login-footer">
                        Don't have an account? <a href="#" class="forgot-password">Contact administrator</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

