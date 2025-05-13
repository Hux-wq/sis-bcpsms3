<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="p-2">
            <div class=" text-center pt-5">
        
                <x-application-logo class="w-25"/>
           
            </div>
            <form method="POST" class="mx-auto card p-3 mt-4" action="{{ route('login') }}" style="max-width: 400px;">
                @csrf
                <h5 class="text-center">Student Information System</h5>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"  autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
    
                    <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="current-password" />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
               
    
                <div class="d-flex justify-items-center justify-content-between mb-4">
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    
    
                
                </div>

                <x-primary-button class="">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>
        </div>
</x-guest-layout>
