<div class="table-responsive">
    <table class="table table-bordered" id="permits-table">
        <thead>
        <tr>
            <th>{{('#')}}</th>
            <th>وصف العمل</th>
            <th>رقم البند</th>
            <th>الكمية</th>
            <th>سعر الوحدة</th>
            <th>الإجمالي</th>
        </tr>
        </thead>
        <tbody>
        @forelse($assayForm->assayService as $assaysService)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$assaysService->service->name}}</td>
                <td>{{$assaysService->service->code}}</td>
                <td>{{$assaysService->quantity}}</td>
                <td>{{number_format($assaysService->service->price,2)}}</td>
                <td>{{number_format($assaysService->price,2)}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center; color: red; ">لا توجد بنود أعمال مض</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
