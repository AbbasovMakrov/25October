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
    public function store(array $data);

    public function findById($id);
    public function update(array $data, int $messageId);

    public function see(int $messageId);

    public function destroy(int $messageId);

    public function destroyAllMessages();
}
