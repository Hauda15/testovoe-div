<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->service = new TicketService();
    }

    /**
     * @OA\Get(
     *   path="/requests",
     *   summary="Список активных заявок",
     *   @OA\Response(
     *     response=200,
     *     description="Список заявок в статусе Active"
     *   ),
     * )
     */
    public function index()
    {
        $tickets = Ticket::where('status', 'Active')->get();
        return response()->json(['requests' => $tickets]);
    }


    /**
     * @OA\Post(
     *     path="/requests",
     *     summary="Создание заявки",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Имя пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Электронная почта пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="message",
     *         in="query",
     *         description="Вопрос пользователя",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Заявка успешно отправлена."),
     *     @OA\Response(response="400", description="Ошибка при отправке заявки. Проверьте данные.")
     * )
     */
    public function store(StoreTicketRequest $request)
    {
        if($this->service->storeTicket($request)) {
            return response()->json(
                ['description' => 'Заявка успешно отправлена.']
            );
        } else {
            return response(
                ['description' => 'Ошибка при отправке заявки. Проверьте данные.'], 400
            );
        }
    }

    /**
     * @OA\Put(
     *     path="/requests/{id}",
     *     summary="Добавить ответ к заявке и обновить статус",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Статус заявки. Доступные значения: {Active, Resolved}",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="comment",
     *         in="query",
     *         description="Ответ работника на заявку пользователя. Обязателен если статус Resolved находится в полезной нагрузке.",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Заявка обновлена."),
     *     @OA\Response(response="400", description="Ошибка при обновлении заявки. Проверьте данные.")
     * )
     */
    public function update(UpdateTicketRequest $request, string $id)
    {
        if($this->service->updateTicket($id, $request)) {
            return response()->json(
                ['description' => 'Заявка обновлена.']
            );
        } else {
            return response()->json(
                ['description' => 'Ошибка при обновлении заявки. Проверьте данные.'], 400
            );
        }
    }

    public function create()
    {
        return view('Ticket.create');
    }

    /**
     * @OA\Delete(
     *     path="/requests/{id}",
     *     summary="Удалить заявку",
     *     @OA\Response(response="200", description="Успешно удалено."),
     *     @OA\Response(response="400", description="Не найдено такой заявки.")
     * )
     */
    public function destroy(string $id)
    {
        try {
            Ticket::findOrFail($id)->delete();
            return response()->json(['description' => 'Успешно удалено.']);
        } catch (ModelNotFoundException) {
            return response()->json(['description' => 'Не найдено такой заявки.'], 404);
        }
    }
}
