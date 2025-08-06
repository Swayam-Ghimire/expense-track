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
            @foreach ($this->data as $row)
                <tr>
                    <td>{{ $row['year_month'] }}</td>
                    <td>{{ $row['income'] }}</td>
                    <td>{{ $row['expense'] }}</td>
                    <td>{{ $row['saving'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
