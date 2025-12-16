@if(isset($emergencyMission) )

<!-- Needs Drilling Operations Field -->
<div class="card">
    <div class="card-body">
        <div class="row">
            {{-- <h3 class="block">سجل الملاحظات :</h3> --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="cities-table">
                    <thead>
                    <tr>
                        
                        <th>الملاحظة</th>
                        <th>بواسطة</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($emergencyMission->workOrdersNotes as $file)
                        <tr>
                            <td>{{$file->note}}</td>
                            <td>{{$file->user->name ?? $file->user_id}}</td>
                            <td data-bs-toggle="tooltip" title="{{$file->created_at}}">{{$file->created_at->toDateString()}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color: red; ">@lang("No Notes available")</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>
</div>

@endif
