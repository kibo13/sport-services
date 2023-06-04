@extends('admin.index')

@section('title-admin', __('_section.cards'))

@section('content-admin')
    <section id="cards-index">
        <h3>{{ __('_section.cards') }}</h3>

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
                <th class="w-25 bk-min-w-250">{{ __('_field.type_service') }}</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.action_from') }}</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.action_till') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cards as $card)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $card->client->full_name }}">
                        {{ $card->client->short_name }}
                    </td>
                    <td>
                        <ul>
                            <li class="font-weight-bold">
                                {{ $card->service->activity->name }}
                            </li>
                            <li class="bk-field bk-field--tip">
                                {{ $card->service->name }}
                            </li>
                            <li class="bk-field bk-field--tip">
                                {{ $card->service->unit }}
                                {{ $card->service->unit == 1 ? ' посещение' : ' посещений' }}
                            </li>
                        </ul>
                    </td>
                    <td>{{ format_date_for_display($card->start) }}</td>
                    <td>{{ format_date_for_display($card->end) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
