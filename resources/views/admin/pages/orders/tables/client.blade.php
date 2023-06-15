<table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.topic') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.trainer') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.status') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->subject }}</td>
            <td>{{ $order->activity->name }}</td>
            <td title="{{ $order->trainer->full_name }}">{{ $order->trainer->short_name }}</td>
            <td style="color: {{ $order->status->color }}">
                <b>{{ $order->status->name }}</b>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
