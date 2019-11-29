<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    private function messageType()
    {
        $type = "my";
        if ($this->to_user_id == auth()->id())
            $type = "his";
        if (filled($this->file))
            $type .= "_" . file_type($this->file);
        if (filled($this->message))
            $type .= "_text";
        return $type;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "messageId" => $this->id,
            "from" => $this->user->name,
            "to" => $this->user_to->name,
            "message" => $this->message,
            "file" => $this->file ? asset("storage/{$this->file}") : null,
            "sent" => Carbon::make($this->created_at)->toDateTimeString(),
            "edited" => $this->updated_at != $this->created_at,
            "seen" => $this->seen_at ? true : false,
            "sectionType" => $this->messageType()
        ];
    }
}
