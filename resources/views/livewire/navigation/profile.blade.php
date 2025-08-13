<div class="profile-container">
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <h2>
                <i class="fas fa-user-circle"></i>
                Profile Settings
            </h2>
        </div>

        <form wire:submit.prevent='save'>
            <div class="profile-content">

                <!-- Profile Information Section -->
                <div class="profile-form">
                    <h3 id="section-title">
                        <i class="fas fa-user-edit"></i>
                        Account Information
                    </h3>

                    <!-- Username Field -->
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input wire:model='name' class="input-field-profile" type="text" id="username" value="{{ $user->name }}"
                            placeholder="Enter your username">
                    </div>

                    <!-- User Type Field -->
                    <div class="input-group">
                        <label for="user_type">Type</label>
                        <div class="select-wrapper">
                            <i class="fas fa-users"></i>
                            <select wire:model.live="user_type" class="input-field-profile" name="type" id="user_type" required>
                                <option value="">Select one</option>
                                <option value="Student">Student</option>
                                <option value="Employee">Employee</option>
                            </select>
                        </div>
                    </div>

                    <!-- Password Change Section -->
                    <div class="password-section">
                        <h4>
                            <i class="fas fa-lock"></i>
                            Change Password
                        </h4>

                        <div class="password-row">
                            <div class="password-group">
                                <label for="current">Current Password</label>
                                <input class="password-field" type="password" id="current" wire:model='current'
                                    placeholder="Enter current password">
                            </div>

                            <div class="password-group">
                                <label for="new">New Password</label>
                                <input class="password-field" wire:model='new' type="password" id="new"
                                    placeholder="Enter new password">
                            </div>
                        </div>

                        <div class="password-group password-confirm">
                            <label for="confirm">Confirm New Password</label>
                            <input class="password-field" type="password" name="password_confirmation" id="confirm"
                                wire:model='confirm' placeholder="Confirm new password">
                        </div>
                    </div>
                </div>

                <!-- Profile Picture Section -->
                <div class="profile-picture">
                    <h3>
                        <i class="fas fa-camera"></i>
                        Profile Picture
                    </h3>

                    <!-- Profile Image -->
                    <div class="image-container">
                        @if($user->img_path)
                        <img class="profile-image" src="{{ asset('storage/' . $user->img_path) }}" alt="Profile Photo">
                        @else
                        <img class="profile-image"
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=FFFFFF&background=dc2626"
                            alt="Profile photo">
                        @endif

                        <!-- Camera Icon Overlay -->
                        <label for="profileUpload" class="camera-overlay">
                            <i class="fas fa-camera"></i>
                        </label>

                        <input type="file" wire:model='photo' id="profileUpload" class="hidden">
                    </div>

                    <!-- User Name Display -->
                    <h2 class="profile-name">{{ $user->name }}</h2>

                    <!-- Update Button -->
                    <button type="submit" class="update-btn">
                        <i class="fas fa-save"></i>
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>