import Chart from 'chart.js/auto';

let monthlyExpenseChartInstance = null;
let incomeVsExpenseChartInstance = null;

function renderMonthlyExpenseChart(data) {
    const ctx = document.getElementById('monthlyExpenseChart');
    if (!ctx) return;

    // Destroy existing chart
    if (monthlyExpenseChartInstance) {
        monthlyExpenseChartInstance.destroy();
    }

    const hasData = (data.labels && data.labels.length) > 0 && (data.values && data.values.length) > 0;

    if (!hasData) {
        // Show empty state
        ctx.parentElement.innerHTML = `
            <div class="chart-empty">
                <i class="fas fa-chart-pie chart-empty-icon"></i>
                <p>No expense data available for this month</p>
            </div>
        `;
        return;
    }

    monthlyExpenseChartInstance = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Amount Spent',
                data: data.values,
                backgroundColor: [
                    '#dc2626', // Red
                    '#a31621', // Dark Red
                    '#f59e0b', // Amber
                    '#10b981', // Emerald
                    '#3b82f6', // Blue
                    '#8b5cf6', // Violet
                    '#f97316', // Orange
                    '#ef4444', // Light Red
                    '#06b6d4', // Cyan
                    '#84cc16', // Lime
                    '#f472b6', // Pink
                    '#6b7280'  // Gray
                ],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverBorderWidth: 4,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            family: 'Ubuntu, sans-serif',
                            weight: '500'
                        },
                        color: '#374151',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 12,
                        boxHeight: 12
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.9)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#dc2626',
                    borderWidth: 2,
                    cornerRadius: 10,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        title: function (context) {
                            return `Category: ${context[0].label}`;
                        },
                        label: function (context) {
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `Amount: ₹${value.toLocaleString()} (${percentage}%)`;
                        },
                        afterLabel: function (context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            return `Total Expenses: ₹${total.toLocaleString()}`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 1200,
                easing: 'easeInOutQuart'
            },
            layout: {
                padding: {
                    top: 10,
                    bottom: 10,
                    left: 10,
                    right: 10
                }
            }
        }
    });
}

function renderIncomeVsExpenseChart(data) {
    const ctx = document.getElementById('expenseVsIncomeChart');
    if (!ctx) return;

    // Destroy existing chart
    if (incomeVsExpenseChartInstance) {
        incomeVsExpenseChartInstance.destroy();
    }
    const hasData = (data.labels && data.labels.length > 0) && (data.income && data.income.length > 0) && (data.expense && data.expense.length > 0);

    if (!hasData) {
        // Show empty state
        ctx.parentElement.innerHTML = `
            <div class="chart-empty">
                <i class="fas fa-chart-pie chart-empty-icon"></i>
                <p>No expense data available for this month</p>
            </div>
        `;
        return;
    }

    const sampleData = {
        months: data.labels,
        income: data.income,
        expenses: data.expense
    };

    incomeVsExpenseChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: sampleData.months,
            datasets: [
                {
                    label: 'Income',
                    data: sampleData.income,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 1,
                    fill: true,
                    tension: 0.2,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 1,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#10b981',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3
                },
                {
                    label: 'Expenses',
                    data: sampleData.expenses,
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.2,
                    pointBackgroundColor: '#dc2626',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 1,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#dc2626',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: {
                            size: 13,
                            family: 'Ubuntu, sans-serif',
                            weight: '600'
                        },
                        color: '#374151',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 15,
                        boxHeight: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.9)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#dc2626',
                    borderWidth: 2,
                    cornerRadius: 10,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        title: function (context) {
                            return `Month: ${context[0].label}`;
                        },
                        label: function (context) {
                            const label = context.dataset.label || '';
                            const value = context.parsed.y || 0;
                            return `${label}: ₹${value.toLocaleString()}`;
                        },
                        afterBody: function (context) {
                            if (context.length >= 2) {
                                const income = context.find(item => item.dataset.label === 'Income')?.parsed.y || 0;
                                const expense = context.find(item => item.dataset.label === 'Expenses')?.parsed.y || 0;
                                const savings = income - expense;
                                const savingsText = savings >= 0 ? 'Saved' : 'Overspent';
                                return `${savingsText}: ₹${Math.abs(savings).toLocaleString()}`;
                            }
                            return '';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.06)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11,
                            family: 'Ubuntu, sans-serif'
                        },
                        padding: 10
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.06)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11,
                            family: 'Ubuntu, sans-serif'
                        },
                        padding: 10,
                        callback: function (value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            },
            elements: {
                line: {
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round'
                }
            },
            layout: {
                padding: {
                    top: 10,
                    bottom: 10,
                    left: 10,
                    right: 10
                }
            }
        }
    });
}

// Initialize charts
function initializeCharts() {
    if (window.expenseByCategoryChartData) {
        renderMonthlyExpenseChart(window.expenseByCategoryChartData);
    }
    if (window.expenseVsIncomeChartData) {
        renderIncomeVsExpenseChart(window.expenseVsIncomeChartData);
    }
}

// Event listeners
document.addEventListener('livewire:navigated', initializeCharts);
document.addEventListener('DOMContentLoaded', initializeCharts);

// Listen for Livewire updates
document.addEventListener('livewire:updated', () => {
    setTimeout(initializeCharts, 100);
});