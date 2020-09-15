<?php

namespace WeStacks\TeleBot\Tests\Feature;

use PHPUnit\Framework\TestCase;
use WeStacks\TeleBot\Bot;
use WeStacks\TeleBot\Objects\File;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\UserProfilePhotos;

class SendFilesTest extends TestCase
{
    /**
     * @var Bot
     */
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new Bot(getenv('TELEGRAM_BOT_TOKEN'));
    }

    public function testSendAudioFromUrl()
    {
        $message = $this->bot->sendAudio([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'audio' => "https://file-examples-com.github.io/uploads/2017/11/file_example_MP3_700KB.mp3"
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendDocument()
    {
        $message = $this->bot->sendDocument([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'document' => [
                'file' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'filename' => 'test-document.txt'
            ]
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendVideo()
    {
        $message = $this->bot->sendVideo([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'video' => 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_480_1_5MG.mp4'
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendAnimation()
    {
        $message = $this->bot->sendAnimation([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'animation' => 'https://media.giphy.com/media/xUPJPlup94kn4skee4/giphy.gif'
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendVoice()
    {
        $message = $this->bot->sendVoice([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'voice' => 'https://file-examples-com.github.io/uploads/2017/11/file_example_OOG_1MG.ogg'
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendVideoNote()
    {
        $message = $this->bot->sendVideoNote([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'video_note' => 'https://raw.githubusercontent.com/TelegramBots/book/master/src/docs/video-waves.mp4',
            'length' => 360,
            'duration' => 47
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendMediaGroup()
    {
        $message = $this->bot->sendMediaGroup([
            'chat_id' => getenv('TELEGRAM_USER_ID'),
            'media' => [
                [
                    'type' => 'video',
                    'media' => 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_480_1_5MG.mp4'
                ],[
                    'type' => 'photo',
                    'media' => fopen('https://picsum.photos/640', 'r')
                ]
            ]
        ]);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testGetFile()
    {
        $photos = $this->bot->getUserProfilePhotos([
            'user_id' => getenv('TELEGRAM_USER_ID')
        ]);
        $this->assertInstanceOf(UserProfilePhotos::class, $photos);

        $file = $this->bot->getFile([
            'file_id' => $photos->photos[0][0]->file_id
        ]);
        $this->assertInstanceOf(File::class, $file);
    }
}