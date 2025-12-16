<div class="table-responsive">
    <table class="table table-bordered" id="permits-table">
        <thead>
        <tr>
            <th>{{('#')}}</th>
            <th>المادة</th>
            <th>رقم البند</th>
            <th>صرف</th>
            <th>مستخدم</th>
            <th>ارجاع</th>
            <th>باقي صرف</th>
        </tr>
        </thead>
        <tbody>
        @forelse($assayForm->assayItem as $assaysItem)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$assaysItem->item->name}}</td>
                <td>{{$assaysItem->item->code}}</td>
                <td>{{$assaysItem->spend}}</td>
                <td>{{$assaysItem->used}}</td>
                <td>{{$assaysItem->returned}}</td>
                <td>{{$assaysItem->returned_spend}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center; color: red; ">لا توجد بنود أعمال مض</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
