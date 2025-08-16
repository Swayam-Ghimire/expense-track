<div class="dashboard-container">
    <livewire:notification.message />
    <!-- Top Action Bar -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            Hello {{ explode(' ', $user->name)[0] }}
        </h1>
        <a wire:navigate href="/create" class="btn-add-expense">
            <i class="fas fa-plus"></i> Add Expense
        </a>
    </div>

    <!-- Financial Summary Cards -->
    <div class="summary-cards">
        <!-- Income Card -->
        <div class="card card-income">
            <h2 class="card-title">
                <i class="fas fa-wallet text-green-600 mr-2"></i>
                Your {{ $this->type }}
            </h2>
            <div class="card-actions">
                @if($showEdit)
                <div id="show">
                    <span><i class="fas fa-rupee-sign text-green-700"></i> {{ $monthlyIncome }}</span>
                </div>
                <button type='button' wire:click='display' class="btn-edit-income">Edit</button>
                @else
                <form wire:submit.prevent='save'>
                    <input type="number" wire:model='monthlyIncome' class="income-input"
                        placeholder="Enter your income">
                    <button type='submit' class="btn-submit-income">Save</button>
                    @error('monthlyIncome')
                    <span class="text-red-500 text-xs mt-1 w-full block">{{ $message }}</span>
                    @enderror
                </form>
                @endif
            </div>
        </div>

        <!-- Amount spent since using the app -->
        <div class="card card-expense-amount">
            <h2 class="card-title">
                <i class="fas fa-rupee-sign text-blue-500 mr-2"></i>
                All Time Amount Spent
            </h2>
            <p class="trend-status"><i class="fas fa-rupee-sign text-blue-500 mr-2"></i> {{ number_format($totalExpense,
                2) }}</p>
        </div>

        <!-- Amount Left Card -->
        <div class="card card-amount-left">
            <h2 class="card-title">
                <i class="fas fa-coins text-green-600 mr-2"></i> Amount left this month
            </h2>
            <p class="amount-value"><i class="fas fa-rupee-sign text-green-600 mr-2"></i> Rs {{
                number_format($amountLeft, 2) }}</p>
        </div>
    </div>


    <!-- Charts Section -->
    <div class="charts-section">
        <div class="chart-box chart-monthly-expense">
            <h3 class="chart-title">Monthly Expenses</h3>
            <canvas id="monthlyExpenseChart"></canvas>
        </div>

        <div class="chart-box chart-expense-vs-income">
            <h3 class="chart-title">Expense vs Income</h3>
            <canvas id="expenseVsIncomeChart"></canvas>
        </div>
    </div>

    <script>
        window.expenseByCategoryChartData = {
            labels: @json(array_keys($expenseByCategory)),
            values: @json(array_values($expenseByCategory))
        };
        window.expenseVsIncomeChartData = {
            labels: @json(array_column($incomeVsExpense, 'year_month')),
            income: @json(array_column($incomeVsExpense, 'income')),
            expense: @json(array_column($incomeVsExpense, 'expense'))
        };
    </script>

    <!-- Monthly Saving History Table -->
    <div class="savings-history">
        <h3 class="section-title">Last 6 Months Monthly Saving History</h3>
        <table class="savings-table">
            <thead>
                <tr>
                    <th>Year and Month</th>
                    <th>Income</th>
                    <th>Expenses</th>
                    <th>Savings</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 11; $i >= 6 ; $i--)
                <tr>
                    <td>{{ $incomeVsExpense[$i]['year_month'] }}</td>
                    <td>{{ $incomeVsExpense[$i]['income'] }}</td>
                    <td>{{ $incomeVsExpense[$i]['expense'] }}</td>
                    <td>{{ $incomeVsExpense[$i]['saving'] }}</td>
                </tr>                  
                @endfor
            </tbody>
        </table>
    </div>
</div>