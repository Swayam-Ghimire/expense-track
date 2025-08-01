<div class="custom-input-group">
    <i class="fas fa-users"></i>
    <select wire:model.live="user_type" name="type" id="user_type" required>
        <option value="">Select one</option>
        <option value="Student">Student</option>
        <option value="Employee">Employee</option>
    </select>
    <label for="user_type">Register as</label>

    @if($user_type != '')
    <div id="alert-5" class="flex items-center p-4 rounded-lg bg-gray-50 dark:bg-gray-800" role="alert">
        <svg class="shrink-0 w-4 h-4 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>&nbsp&nbsp
        <div class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-300">
            @if ($user_type === 'Student')
                {{ $std_message }}
                &nbsp&nbsp<a href="https://www.linkedin.com/in/swayam-ghimire-689076266/" target="_blank"
                    class="font-semibold underline hover:no-underline">Swayam Ghimire</a>.
            @elseif ($user_type === 'Employee')
                {{ $emp_message }}
                &nbsp&nbsp<a href="https://www.linkedin.com/in/swayam-ghimire-689076266/"
                    class="font-semibold underline hover:no-underline">Swayam Ghimire</a>.
            @endif
        </div>
    </div>
    @endif

</div>