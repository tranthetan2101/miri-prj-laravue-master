<?php

namespace App\Http\Livewire;

use App\Domains\Auth\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class OrdersTable.
 */
class OrdersTable extends TableComponent
{
    /**
     * @var string
     */
    public $sortField = 'id';

    public $sortDirection = 'desc';

    /**
     * @var string
     */
    public $status;

    /**
     * @param  string  $status
     */
    public function mount($status = 'all'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Order::with(['user']);

        switch ($this->status)
        {
            case 'pending':
                $query->where('order_status', 0);
                break;
            case 'paid':
                $query->where('order_status', 1);
                break;
            case 'shipping':
                $query->where('order_status', 2);
                break;
            case 'completed':
                $query->where('order_status', 3);
                break;
        }

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('User'))
                ->view('backend.order.includes.user', 'order')
            ,
            Column::make(__('Name'), 'name')
                ->searchable(),
            Column::make(__('Email'), 'email')
                ->searchable(),
            Column::make(__('Phone'), 'phone_number')
                ->searchable(),
            Column::make(__('Order Key'), 'uuid')
                ->searchable(),
            Column::make(__('Payment Method'))
                ->view('backend.order.includes.payment', 'order'),
            Column::make(__('Total'), 'total'),
            Column::make(__('Sub Total'), 'subtotal'),
            Column::make(__('Order Date'), 'order_date')
                ->customAttribute()
                ->html(function(Order $model) { return timezone()->convertToLocal($model->order_date, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Payment Date'), 'payment_date')
                ->customAttribute()
                ->html(function(Order $model) { return timezone()->convertToLocal($model->payment_date, 'Y-m-d H:i');})
                ->sortable(),
            Column::make(__('Status'))
                ->view('backend.order.includes.status', 'order'),

            Column::make(__('Actions'))
                ->view('backend.order.includes.actions', 'order'),
        ];
    }
}
