@if(is_access('method_full'))
<div class="my-2 btn-group">
    <a class="btn btn-primary" href="{{ route('methods.create') }}">
        {{ __('_record.new') }}
    </a>
</div>
@endif

@if(session()->has('success'))
<div class="my-2 alert alert-success" role="alert">
    {{ session()->get('success') }}
</div>
@endif

<table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
            <th class="w-25 bk-min-w-100">{{ __('_field.lesson') }}</th>
            <th class="w-50 bk-min-w-300 no-sort">{{ __('_field.content') }}</th>
            @if(is_access('method_full'))
            <th class="no-sort">{{ __('_action.this') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($methods as $method)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $method->activity->name }}</td>
            <td>{{ $method->number }}</td>
            <td>
                <div class="bk-btn-info">
                    {{ $method->note }}
                    @if($method->note)
                    <i class="fa fa-eye bk-btn-info--fa"></i>
                    @endif
                </div>
            </td>
            @if(is_access('method_full'))
            <td>
                <div class="bk-btn-actions">
                    <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                       href="{{ route('methods.edit', $method) }}"
                       title="{{ __('_action.edit') }}" ></a>
                    <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                       href="javascript:void(0)"
                       data-id="{{ $method->id }}"
                       data-toggle="modal"
                       data-target="#bk-delete-modal"
                       title="{{ __('_action.delete') }}" ></a>
                </div>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
