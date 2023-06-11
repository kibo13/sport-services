@extends('admin.index')

@section('title-admin', __('_section.clients'))

@section('content-admin')
    <section id="clients-index">
        <h3>{{ __('_section.clients') }}</h3>

        @if(is_access('client_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-success" href="{{ route('clients.export') }}">
                {{ __('_action.export') }}
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
                    <th class="w-25 bk-min-w-250">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.phone') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.email') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.discount') }}</th>
                    @if(is_access('client_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $client->full_name }}">{{ $client->short_name }}</td>
                    <td>
                        <a href="tel:{{ $client->phone }}">
                            {{ format_phone_number_for_display($client->phone) }}
                        </a>
                    </td>
                    <td>
                        <a href="mailto:{{ $client->email }}">
                            {{ $client->email }}
                        </a>
                    </td>
                    <td>
                        @if($client->benefit_id)
                        <div class="bk-zoom">
                            <span class="text-success">
                                {{ format_discount_for_display($client->benefit->discount) }}
                            </span>
                            <span class="{{ $client->certificate ? 'text-primary' : 'text-secondary' }}">
                                {{ $client->certificate ? "(посмотреть)" : null }}
                            </span>
                            <img class="bk-zoom__img"
                                 src="{{ $client->certificate ? asset('storage/' . $client->certificate) : null }}"
                                 alt="{{ $client->certificate }}"
                                 tabindex="0">
                            <div class="bk-zoom__bg"></div>
                        </div>
                        @else
                        <span class="text-secondary">
                            Отсутствует
                        </span>
                        @endif
                    </td>
                    @if(is_access('client_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('clients.edit', $client) }}"
                               title="{{ __('_action.edit') }}" ></a>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
