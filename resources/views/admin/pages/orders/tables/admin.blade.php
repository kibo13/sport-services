<div class="my-2 bk-callout">
    <ul>
        <li>
            <span class="font-weight-bold">Кол-во новых заявок:</span>
            <span class="text-primary">
                {{ $newOrdersCount }}
            </span>
        </li>
        <li>
            <span class="font-weight-bold">Кол-во завершенных заявок:</span>
            <span class="text-primary">
                {{ $completedOrdersCount }}
            </span>
        </li>
        <li>
            <span class="font-weight-bold">Кол-во отклоненных заявок:</span>
            <span class="text-primary">
                {{ $rejectedOrdersCount }}
            </span>
        </li>
    </ul>
</div>

<table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.topic') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.trainer') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.client') }}</th>
            <th class="w-00 bk-min-w-200">{{ __('_field.status') }}</th>
            @if(auth()->user()->isAdmin())
            <th class="no-sort">{{ __('_action.this') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->subject }}</td>
            <td>{{ $order->activity->name }}</td>
            <td title="{{ $order->trainer->full_name }}">{{ $order->trainer->short_name }}</td>
            <td title="{{ $order->client->full_name }}">{{ $order->client->short_name }}</td>
            <td style="color: {{ $order->status->color }}">
                <b>{{ $order->status->name }}</b>
            </td>
            @if(auth()->user()->isAdmin())
            <td>
                <div class="bk-btn-actions">
                    <a class="bk-btn-action bk-btn-action--info btn btn-info"
                       href="{{ route('orders.edit', $order) }}"
                       title="{{ __('_action.look') }}" ></a>
                </div>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
