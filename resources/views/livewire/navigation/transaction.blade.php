<div>
    <livewire:notification.message />
    <div class="transaction-container">
        <div class="transaction-header">
            <h2 class="transaction-title">
                <i class="fas fa-history text-red-600 mr-2"></i>
                &nbsp All Transactions
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
                    @forelse ($expenses as $expense)
                    <tr wire:key='{{ $expense->id }}'>
                        <td>{{ $loop->iteration }}</td>
                        <td class="amount-cell">
                            <i class="fas fa-rupee-sign text-red-600 mr-1"></i>
                            {{ $expense->amount }}
                        </td>
                        <td>
                            <span class="category-badge">{{ $expense->category->category }}</span>
                        </td>
                        <td class="date-cell">{{ date('F d, Y', strtotime($expense->transaction_date)) }}</td>
                        <td class="description-cell">{{ $expense->description }}</td>
                        <td>
                            <div class="action-buttons">
                                @if(date('Y-m', strtotime($expense->transaction_date)) == now()->format('Y-m'))
                                    <a wire:navigate href='{{ route('edit', $expense->id) }}' class="btn-edit">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                @endif
                                <button wire:click='delete({{ $expense->id }})' class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No transaction found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $expenses->links() }}
        </div>
    </div>
</div>