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
                    <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.service') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.expiration_at') }}</th>
                    <th class="no-sort">{{ __('_action.this') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cards as $card)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $card->service->activity->name }}</td>
                    <td>
                        <ul>
                            <li class="bk-field bk-field--tip">
                                {{ $card->service->name }}
                            </li>
                            <li class="bk-field bk-field--tip">
                                {{ $card->service->unit }}
                                {{ $card->service->unit == 1 ? ' посещение' : ' посещений' }}
                            </li>
                        </ul>
                    </td>
                    <td title="{{ $card->client->full_name }}">
                        {{ $card->client->short_name }}
                    </td>
                    <td>{{ format_date_for_display($card->end) }}</td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--card btn btn-primary"
                               href="{{ route('cards.generate', $card) }}"
                               target="_blank"
                               title="{{ __('_field.card') }}"></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
