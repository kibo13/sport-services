@extends('admin.index')

@section('title-admin', __('_section.services'))

@section('content-admin')
    <section id="services-index">
        <h3>{{ __('_section.services') }}</h3>

        @if(session()->has('success'))
            <div class="my-2 alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <table class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
            <tr>
                <th class="w-00 bk-min-w-250">{{ __('_field.name') }}</th>
                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.unit') }}</th>
                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_kid') }}</th>
                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_student') }}</th>
                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_adult') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity_id => $activity)
                @foreach($types as $type_id => $type)
                    <tr>
                        <td>
                            <b>
                                {{ is_null($type) ? $activity : $type }}
                            </b>
                        </td>
                        <td class="text-center">
                            <b>
                                {{ ServiceType::UNITS[$type_id] }}
                            </b>
                            <span class="bk-field bk-field--tip">
                                {{ $type_id == 1 ? ' посещение' : ' посещений' }}
                            </span>
                        </td>
                        @foreach($services as $service)
                            @if($service->type_id == $type_id && $service->activity_id == $activity_id)
                                @foreach($categories as $category_id => $category)
                                    @if($service->category_id == $category_id)
                                        <td class="text-center">
                                            <b>
                                                {{ format_money_for_display($service->price, 0) }}
                                            </b>
                                            <span class="bk-field bk-field--tip">
                                                руб.
                                            </span>
                                            @if(is_access('service_full'))
                                            <a class=" d-block text-primary" href="{{ route('services.edit', $service) }}">
                                                {{ __('_action.edit') }}
                                            </a>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
