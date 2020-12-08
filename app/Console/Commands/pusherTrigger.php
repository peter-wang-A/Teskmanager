<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class pusherTrigger extends Command
{
    /**
     * The name and signature of the console command
     * @var string
     * 命令行输入加参数  art pusher:trigger --data=message:newsInfo,name:peter
     * data 后面加 * 将输入的数据转换成 Array
     * 如果加上 -- 表示 option   命令行输入时必须加 --channel=....
     * 如果不加 argument 就是必填的 命令行直接输入信息,属性这块也不需要 = 号
     * 下面也需要改成相应的 argument
     */
    protected $signature = 'pusher:trigger
                            {channel : your channel name}
                            {event : your event name}
                            {data : your data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pusher message to pusher';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 显示信息
        // $channel =  $this->info('tell me your pusher channel name?');
        /* 让用户输入
        判断是否输入了相应的项目，option 里面填写 $signature 的数据
        如果上面每家 -- 这块需要换成 argument
        */
        $channel = $this->argument('channel') ?: $this->ask('tell me your pusher channel name?');

        $event = $this->argument('event') ?: $this->ask('tell me your pusher event name?');
        $data_input = $this->argument('data') ?:   $this->ask('what pusher data do want to push?');


        //让用户确认确认
        if ($this->confirm('correct or not? [y|N]')) {
            $pusher = app()->make('pusher');
            // $this->toArray($data_input) 将用户传入的数据专成array
            $pusher->trigger($channel, $event, $this->toArray($data_input));
        }

        // 将输入的信息以表格的形式在命令行显示
        $headers =['channel','event','data'];
        $row=[
            [$channel,$event,$data_input]
        ];
        $this->table($headers,$row);
    }

    private function toArray($data_input)
    {
        //将用户输入的数据 "'message'=>'info'" 转换成 Array ['message':'info']
        $data_array = [];
        foreach (explode(',', $data_input) as $item) {
            list($key, $value) = explode(':', $item);
            $data_array[$key] = $value;
        }
        return $data_array;
    }
}
