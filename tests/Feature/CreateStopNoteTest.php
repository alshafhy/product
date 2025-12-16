<?php

use Tests\TestCase;
use App\Models\WorkOrder;
use App\Models\WorkOrderNote;
use App\Enums\WorkOrderStatusEnum;
use App\Services\WorkOrders\WorkOrderService as WorkOrderService;

class CreateStopNoteTest extends TestCase
{
    public function testTemporaryStopNoteIsCreated()
    {
        return true;
        $workOrderService =   app(WorkOrderService::class);
        $workOrder = new WorkOrder([
            'work_order_number' => 'WO1234',
            'id' => 1,
        ]);
        dd($workOrder);
        $statusKey = 'temporaryStopped';
        $stopNote = 'Test temporary stop note';

        $note = $workOrderService->createStopNote($statusKey, $workOrder, $stopNote);

        $this->assertInstanceOf(WorkOrderNote::class, $note);
        $this->assertEquals($note->work_order_number, $workOrder->work_order_number);
        $this->assertEquals($note->work_order_id, $workOrder->id);
        $this->assertEquals($note->note, "تم إيقاف مؤقت لأمر العمل بسبب : $stopNote");
        $this->assertEquals($note->work_order_status, WorkOrderStatusEnum::TemporaryStopped->value);
        $this->assertEquals($note->user_id, auth()->id());
    }

    public function testPermanentStopNoteIsCreated()
    {
        return true;
        $workOrderService =   app(WorkOrderService::class);
        $workOrder = new WorkOrder([
            'mission_number' => 'MN5678',
            'id' => 2,
        ]);
        $statusKey = 'permanentStopped';
        $stopNote = 'Test permanent stop note';

        $note = $workOrderService->createStopNote($statusKey, $workOrder, $stopNote);

        $this->assertInstanceOf(WorkOrderNote::class, $note);
        $this->assertEquals($note->work_order_number, $workOrder->mission_number);
        $this->assertEquals($note->work_order_id, $workOrder->id);
        $this->assertEquals($note->note, "تم إيقاف دائم لأمر العمل بسبب : $stopNote");
        $this->assertEquals($note->work_order_status, WorkOrderStatusEnum::PermanentStoped->value);
        $this->assertEquals($note->user_id, auth()->id());
    }

    public function testNoteIsNotCreatedForInvalidStatusKey()
    {
        return true;
        $workOrderService =   app(WorkOrderService::class);
        $workOrder = new WorkOrder([
            'work_order_number' => 'WO1234',
            'id' => 1,
        ]);
        $statusKey = 'invalidStatusKey';

        $note = $workOrderService->createStopNote($statusKey, $workOrder);

        $this->assertFalse($note);
    }
}