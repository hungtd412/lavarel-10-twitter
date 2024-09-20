<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    This is a secure area of the application. Please confirm your password before continuing.
</div>

<form method="POST" action="{{ route('confirm-password') }}">
    @csrf
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" />
        @error('password')
        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-end mt-4">
        <button type="submit">
            Confirm
        </button>
    </div>
</form>