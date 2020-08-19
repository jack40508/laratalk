<?php

use Illuminate\Database\Seeder;
use App\Message\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Message::create([
          'from_id' => '1',
          'to_id' => '2',
          'message' => 'test message',
          'is_read' => false,
        ]);

        Message::create([
          'from_id' => '2',
          'to_id' => '3',
          'message' => 'test message2',
          'is_read' => false,
        ]);
    }
}
