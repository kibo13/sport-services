<table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.topic') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.trainer') }}</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.status') }}</th>
            <th class="no-sort">{{ __('_action.this') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->subject }}</td>
            <td>{{ $order->activity->name }}</td>
            <td title="{{ $trainer->full_name }}">{{ $trainer->short_name }}</td>
            <td>{{ $order->status->name }}</td>
            <td>
{{--                <div class="bk-btn-actions">--}}
{{--                    <a class="bk-btn-action bk-btn-action--edit btn btn-warning"--}}
{{--                       href="{{ route('orders.edit', $order) }}"--}}
{{--                       title="{{ __('_action.edit') }}" ></a>--}}
{{--                    <a class="bk-btn-action bk-btn-action--delete btn btn-danger"--}}
{{--                       href="javascript:void(0)"--}}
{{--                       data-id="{{ $order->id }}"--}}
{{--                       data-toggle="modal"--}}
{{--                       data-target="#bk-delete-modal"--}}
{{--                       title="{{ __('_action.delete') }}" ></a>--}}
{{--                </div>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
