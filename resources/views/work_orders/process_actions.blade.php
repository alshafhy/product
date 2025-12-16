{!! Form::open(['route' => ['workOrders.changeStatus',"inProgressStillProgram",  $workOrder->id,$screenName], 'method' => 'patch']) !!}
<button type="submit" class="btn btn-outline-info me-75 round"  title="تحويل الى جارى العمل / متبقى البرنامج">
    تحويل الى جارى العمل / متبقى البرنامج
</button>
{!! Form::close() !!}
{{-- @if ($mode=="general" && $workOrder->status == 1 ) --}}
{!! Form::open(['route' => ['workOrders.changeStatus',"toGeneral",  $workOrder->id,$screenName], 'method' => 'patch']) !!}
<div class="modal fade" id="returnToGeneralModal" tabindex="-1" aria-labelledby="returnToGeneralLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border border-danger">
            <div class="modal-header text-danger">
                <h1 class="modal-title fs-5" id="returnToGeneralLabel">إرجاع أمر العمل الي العام</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    هل انت متأكد من ارجاع امر العمل الي أوامر العمل العامه
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-danger">إرجاع</button>
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#returnToGeneralModal" class="btn btn-outline-warning me-75 round"  title="إرجاع الي العام">
      إرجاع الي العام
</button>
{!! Form::close() !!}



@if ( $workOrder->status != 4 && $workOrder->status != 5 && $workOrder->status != 6  && $workOrder->current_department_id != 4 )
    {!! Form::open(['route' => ['workOrders.changeStatus',"temporaryStopped",  $workOrder->id,$screenName], 'method' => 'patch']) !!}
    <div class="modal fade" id="stopTemporaryModal" tabindex="-1" aria-labelledby="stopTemporaryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-danger">
                <div class="modal-header text-danger">
                    <h1 class="modal-title fs-5" id="stopTemporaryLabel">سبب الإيقاف المؤقت</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        {!! Form::label('stop_note', 'سبب الإيقاف:') !!}
                        {!! Form::textarea('stop_note', null, ['class' => 'form-control', 'rows'=>5]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">إيقاف</button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" data-bs-toggle="modal" data-bs-target="#stopTemporaryModal" class="btn btn-outline-danger me-75 round"  title="تحويل الى متوقف التنفيذ">
        تحويل الى متوقف مؤقت
    </button>
    {!! Form::close() !!}
    {!! Form::open(['route' => ['workOrders.changeStatus',"permanentStopped",  $workOrder->id,$screenName], 'method' => 'patch']) !!}
    <div class="modal fade" id="stopPermanentModal" tabindex="-1" aria-labelledby="stopPermanentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-danger">
                <div class="modal-header text-danger">
                    <h1 class="modal-title fs-5" id="stopPermanentLabel">سبب الإيقاف النهائي</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        {!! Form::label('stop_note', 'سبب الإيقاف:') !!}
                        {!! Form::textarea('stop_note', null, ['class' => 'form-control', 'rows'=>5]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">إيقاف</button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" data-bs-toggle="modal" data-bs-target="#stopPermanentModal" class="btn btn-outline-danger me-75 round"  title="تحويل الى متوقف التنفيذ">
        تحويل الى متوقف نهائي
    </button>
    {!! Form::close() !!}
@endif
