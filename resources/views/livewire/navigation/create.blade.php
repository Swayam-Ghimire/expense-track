<div class="form-container">
    <div class="form-title">
        <h1><i class="fas fa-plus-circle"></i> Create Expense</h1>
    </div>
    
    <form class="create-form" id="expenseForm">
        <!-- Amount Field -->
        <div class="input-field">
            <label for="amount">Amount <span class="required">*</span></label>
            <input type="number" id="amount" name="amount" placeholder="Eg. 6000" step="0.01" min="0" required>
            <div class="error-message">Please enter a valid amount</div>
        </div>

        <!-- Description Field -->
        <div class="input-field">
            <label for="description">Description <span class="required">*</span></label>
            <textarea id="description" name="description" placeholder="I spent this on tshirt..." required></textarea>
            <div class="error-message">Please provide a description</div>
        </div>

        <!-- Date and Category Row -->
        <div class="form-row">
            <!-- Expense Date -->
            <div class="input-field">
                <label for="expense_date">Expense Date <span class="required">*</span></label>
                <input type="date" id="expense_date" name="expense_date" required>
            </div>

            <!-- Category -->
            <div class="input-field">
                <label for="category">Category <span class="required">*</span></label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="food">Food & Dining</option>
                    <option value="transport">Transportation</option>
                    <option value="shopping">Shopping</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="bills">Bills & Utilities</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="education">Education</option>
                    <option value="travel">Travel</option>
                    <option value="others">Others</option>
                </select>
            </div>
        </div>

        <!-- Form Buttons -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create Expense
            </button>
            {{-- <button type="button" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </button> --}}
        </div>
    </form>
</div>