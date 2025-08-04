<div class="form-container">
    <div class="form-title">
        <h1><i class="fas fa-plus-circle"></i> Create Expense</h1>
    </div>

    <form wire:submit.prevent='save' class="create-form">
        <!-- Amount Field -->
        <div class="input-field">
            <label for="amount">Amount<span class="required">*</span></label>
            <input type="number" name="amount" wire:model='amount' placeholder="Eg. 6000" min="0">
            @error('amount')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="input-field">
            <label for="description">Description <span class="required">*</span></label>
            <textarea wire:model='description' name="description" placeholder="I spent this on tshirt..."></textarea>
            @error('description')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date and Category Row -->
        <div class="form-row">
            <!-- Expense Date -->
            <div class="input-field">
                <label for="expense_date">Expense Date <span class="required">*</span></label>
                <input wire:model='date' type="date" name="expense_date" id="expensedate">
                @error('date')
                <div class="error-message">Please provide a description</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="input-field">
                <label for="category">Category <span class="required">*</span></label>
                <select name="category" wire:model='selectedCategory'>
                    <option value="" selected>Select one</option>
                    @foreach($this->categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                    @endforeach
                </select>
                @error('selectedCategory')
                <div class="error-message">Please provide a description</div>
                @enderror
            </div>
        </div>

        <!-- Form Buttons -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create Expense
            </button>
            <button type="button" wire:click='clear' class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </form>
</div>