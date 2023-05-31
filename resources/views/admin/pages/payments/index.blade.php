@extends('admin.index')

@section('title-admin', __('_section.payments'))

@section('content-admin')
    <section id="payment-index">
        <h3>{{ __('_section.payments') }}</h3>

        @if(is_access('pay_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('payments.create') }}">
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
                    <th class="w-25 bk-min-w-150">{{ __('_field.type') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.amount') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.status') }}</th>
                    @if(is_access('pay_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>
                        {{ format_date_for_display($payment->paid_at) }}
                    </td>
                    @if(is_access('pay_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('payments.edit', $payment) }}"
                               title="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $payment->id }}"
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
    </section>
@endsection
