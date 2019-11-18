<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Interfaces\MessageRepositoryInterface;
use App\Rules\IsUserExists;
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
     * @param $receiverId
     * @return \Illuminate\Http\Response
     */
    public function index($receiverId)
    {
        $validation = $this->idValidation($receiverId);
        if ($validation->fails())
            return api_response(null, $validation->errors());
        $messages = $this->repository->index($receiverId);
        return api_response(["messages" => MessageResource::collection($messages)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $receiverId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $receiverId)
    {
        $request->request->add(['receiverId' => $receiverId]);
        $validation = validator($request->all(), [
            "receiverId" => ['required', 'integer', 'min:1', new IsUserExists],
            "message" => ['nullable', 'string'],
            "message_file" => ['nullable', 'mimetypes:image/*,video/*,audio/*']
        ]);
        if ($validation->fails())
            return api_response(null, $validation->errors());
        if (!$request->message && !$request->hasFile("message_file"))
            return api_response(null, $validation->errors()->add("message", "message must be a file or text"));
        $data = [
          "message" => null,
          "message_file" => null,
          "receiverId" => $receiverId
        ];
        if ($request->hasFile("message_file"))
        {
            $file = $request->file("message_file");
            $fileName = str_random(30) . time() . ".{$file->getClientOriginalExtension()}";
            $file->storeAs("public/media",$fileName);
            $data['message_file'] = "media/{$fileName}";
        }
        if ($request->message)
            $data['message'] = $request->message;
        $message = $this->repository->store($data);
        if (!$message)
            return api_response(null,['message' => ['Sorry , There is an error the message will not update']]);
        return api_response(["message" => new MessageResource($message)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->request->add(['msgId' => $id]);
        $validation = validator($request->all(), [
            "msgId" => ['required','integer','min:1'],
            "message" => ['nullable', 'string'],
            "message_file" => ['nullable', 'mimes:jpg,png,jpeg,mp4,3gp,ogg']
        ]);
        if ($validation->fails())
            return api_response(null, $validation->errors());
        if (!$request->message && !$request->hasFile("message_file"))
            return api_response(null, $validation->errors()->add("message", "message must be a file or text"));
        $data = [
          "message" => $request->message,
          "message_file" => null
        ];
        if ($request->hasFile("message_file"))
        {
            $file = $request->file("message_file");
            $fileName = str_random(30) . time() . ".{$file->getClientOriginalExtension()}";
            $file->storeAs("public/media",$fileName);
            $data['message_file'] = "media/{$fileName}";
        }
        if ($request->message)
            $data['message'] = $request->message;
        $message = $this->repository->update($data,$id);
        if (!$message)
            return api_response(null,['message' => ['Sorry , There is an error the message will not update']]);
        return api_response(["message" => new MessageResource($message)]);
    }

    /**
     * @param $receiverId
     * @return \Illuminate\Http\JsonResponse
     */
    public function see($receiverId)
    {
        $validation = $this->idValidation($receiverId);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $messages = $this->repository->see($receiverId);
        if (!$messages)
            return api_response(null,['message' => ['not found']]);
        return api_response(["messages_seen" => "Messages seen successfully"]);
    }

    /**
     * @param $messageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($messageId)
    {
        $validation = $this->idValidation($messageId);
        if ($validation->fails())
            return api_response(null,$validation->errors());
        $message = $this->repository->destroy($messageId);
        if (!$message)
            return api_response(null,["message" => ['error has occurred']]);
        return api_response(["message" => new MessageResource($message)]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAllMessages()
    {
       return $this->repository->destroyAllMessages() ?
           api_response(['status' => "messages Deleted"]) :
           api_response(null,['message' => ['messages not found to delete']]);
    }
}
