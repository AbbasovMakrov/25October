<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $to_user_id
 * @property string|null $file
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\User $user_to
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $seen_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereSeenAt($value)
 * @property int $is_important
 * @property string|null $important_message_sent_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereImportantMessageSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereIsImportant($value)
 */
class Message extends Model
{
    protected $fillable = [
        "message",
        "file",
        "seen_at",
        "is_important",
        "important_message_sent_at",
        "user_id",
        "to_user_id"
    ];
    public function markAsSeen()
    {
        $this->timestamps = false;
        return $this->update([
           "seen_at" => Carbon::now()->toDateTimeString()
        ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function user_to()
    {
        return $this->belongsTo(User::class,"to_user_id","id");
    }
}
