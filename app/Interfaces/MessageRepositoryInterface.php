<?php


namespace App\Interfaces;


use App\Message;

interface MessageRepositoryInterface
{
    public function __construct(Message $message);

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(int $id);

    /**
     * @param array $data
     * @return Message|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * @param $id
     * @return Message|Message[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findById($id);
    public function update(array $data, int $messageId);
    public function see(int $receiverId);
    public function destroy(int $messageId);
    public function destroyAllMessages();

    public function getNotImportantMessages();

    public function getImportantMessages();

    public function markAsImportantMessage($messageId);
}
