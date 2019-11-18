<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Interfaces\MessageRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $repository;

    function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->repository = $messageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = [
          "important" => MessageResource::collection($this->repository->getImportantMessages()),
           "normal" => MessageResource::collection($this->repository->getNotImportantMessages())
        ];
        return api_response($messages);
    }

    /**
     * @param $messageId
     * @return \Illuminate\Http\Response
     */
    public function markAsImportant($messageId)
    {
        $validation = $this->idValidation($messageId);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $message = $this->repository->markAsImportantMessage($messageId);
        if (!$message)
            return api_response(null,$validation->errors()->add("message","message not found"));
        return api_response(new MessageResource($message));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $messageId
     * @return \Illuminate\Http\Response
     */
    public function destroy($messageId)
    {
        $validation = $this->idValidation($messageId);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $message = $this->repository->destroy($messageId);
        if (!$message)
            return api_response(null,$validation->errors()->add("message","message not found"));
        return api_response(new MessageResource($message));
    }
}
