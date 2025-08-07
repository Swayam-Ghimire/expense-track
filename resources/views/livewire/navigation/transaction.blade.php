<div class="transaction-container">
    <div class="transaction-header">
        <h2 class="transaction-title">
            <i class="fas fa-history text-red-600 mr-2"></i>
            Transaction History
        </h2>
    </div>
    
    <div class="transaction-table-wrapper">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- data goes here -->
                    <td>1</td>
                    <td class="amount-cell">
                        <i class="fas fa-rupee-sign text-red-600 mr-1"></i>
                        1,500
                    </td>
                    <td>
                        <span class="category-badge">Food</span>
                    </td>
                    <td class="date-cell">2024-01-15</td>
                    <td class="description-cell">Grocery shopping</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="pagination-wrapper">
        <!-- pagination here -->
        <div class="pagination-info">
            <span class="pagination-text">Showing 1 to 10 of 50 entries</span>
        </div>
    </div>
</div>
