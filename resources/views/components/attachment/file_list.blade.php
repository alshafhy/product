<div>
    <div class="table-responsive">
        <table class="table table-bordered" id="cities-table">
            <thead>
                <tr>
                    @if ($options['display']['id'])
                        <th>@lang('attachment.Id')</th>
                    @endif
                    @if ($options['display']['incremental'])
                        <th>#</th>
                    @endif
                    @if ($options['display']['name'])
                        <th>@lang('attachment.File Name')</th>
                    @endif
                    @if ($options['display']['title'])
                        <th>@lang('attachment.File Title')</th>
                    @endif
                    @if ($options['display']['description'])
                        <th>@lang('attachment.File Description')</th>
                    @endif
                    @if ($options['display']['category'])
                        <th>@lang('attachment.File Category')</th>
                    @endif
                    @if ($options['display']['size'])
                        <th>@lang('attachment.File Size')</th>
                    @endif
                    @if ($options['display']['type'])
                        <th>@lang('attachment.File Type')</th>
                    @endif
                    @if ($options['display']['model_type'])
                        <th>@lang('attachment.Model Type')</th>
                    @endif
                    @if ($options['display']['model_id'])
                        <th>@lang('attachment.Model Id')</th>
                    @endif
                    @if ($options['display']['extension'])
                        <th>@lang('attachment.File Extension')</th>
                    @endif
                    @if ($options['display']['creator'])
                        <th>@lang('attachment.Creator')</th>
                    @endif
                    @if ($options['display']['action'])
                        <th class="text-center">@lang('attachment.Actions')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($attachments as $file)
                    <tr>
                        @if ($options['display']['id'])
                            <td>{{ $loop->id }}</td>
                        @endif
                        @if ($options['display']['incremental'])
                            <td>{{ $loop->iteration }}</td>
                        @endif
                        @if ($options['display']['name'])
                            <td>{{ $file->filename }}</td>
                        @endif
                        @if ($options['display']['title'])
                            <td>{{ $file->title }}</td>
                        @endif
                        @if ($options['display']['description'])
                            <td>{{ $file->description }}</td>
                        @endif
                        @if ($options['display']['category'])
                            <td>{{ $file->attachmenttype->title ?? '' }}</td>
                        @endif
                        @if ($options['display']['size'])
                            <td>{{ \App\Helpers\Helper::formatBytes($file->size) }}</td>
                        @endif
                        @if ($options['display']['type'])
                            <td>{{ $file->type }}</td>
                        @endif
                        @if ($options['display']['model_type'])
                            <td>{{ $file->model_type }}</td>
                        @endif
                        @if ($options['display']['model_id'])
                            <td>{{ $file->model_id }}</td>
                        @endif
                        @if ($options['display']['extension'])
                            <td>{{ $file->extension }}</td>
                        @endif
                        @if ($options['display']['creator'])
                            <td>{{ $file->creator->name ?? '' }}</td>
                        @endif
                        @if ($options['display']['action'])
                            <td width="120">
                                <div class='btn-group'>
                                    @if ($options['action']['view'] && config('filesystems.default') != 's3')
                                        <a href="{{ route('attachment.view', ['uuid' => $file->uuid]) }}" target="_blank"
                                            class='btn btn-outline-primary btn-sm'>
                                            <i data-feather="eye"></i>
                                        </a>
                                    @endif
                                    @if ($options['action']['download'])
                                        <a href="{{ route('attachment.download', ['uuid' => $file->uuid]) }}"
                                            target="_blank" class='btn btn-outline-warning btn-sm'>
                                            <i data-feather="download"></i>
                                        </a>
                                    @endif
                                    @if ($options['action']['delete'])
                                        <a href="{{ route('attachment.delete', ['uuid' => $file->uuid]) }}"
                                            class='btn btn-outline-danger btn-sm'
                                            onclick="return confirm('Are you sure?')">
                                            <i data-feather="trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                    {{-- @php $types[] = $file->attachment_type_id @endphp --}}
                @empty
                {{-- @php $types = array() @endphp --}}
                    <tr>
                        <td colspan="8" style="text-align:center; color: red; ">@lang('No attachment available')</td>
                    </tr>
                @endforelse
            </tbody>
            {{-- @php
                $count = 0;
                foreach (array_unique($types) as  $v) {
                    ($v == 1 || $v == 2 || $v == 3 || $v == 5 || $v == 9 || $v == 10) ? $count++ : '';
                }
            @endphp --}}
            @if (!empty($fileCatgorycount))
                <div class="card-header">
                    <h4 class="card-title"> عدد انواع الملفات : {{ $fileCatgorycount }} من 6 انواع مطلوبه</h4>
                    <div class="progress w-50" style="height: 25px">
                        <div class="progress-bar progress-bar-striped bg-primary " role="progressbar"
                            style="width:{{ (100 / 6) * $fileCatgorycount }}%" aria-valuenow="70">
                            {{ 16.66 * $fileCatgorycount }} %</div>
                    </div>
                </div>
            @else
                <div class="card-header">
                    <h4 class="card-title">لم يتم رفع اى مرفقات من الانواع المطلوبه</h4>
                    {{-- <div class="progress w-50" style="height: 25px">
                        <div class="progress-bar progress-bar-striped bg-primary " role="progressbar"
                            style="width:{{ 0 }}%" aria-valuenow="70">0%</div>
                    </div> --}}
                </div>
            @endif

        </table>
    </div>
</div>
