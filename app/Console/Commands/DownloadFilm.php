<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Film;
use Str;

class DownloadFilm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:film';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads all of lomography\'s film database';

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
     * @return int
     */
    public function handle()
    {

        $camera = new Film;
        $allCameras = $camera->getAll();

        foreach($allCameras as $cameraResource){

            try{
                $camera = Film::firstOrNew(['lomo_id' => $cameraResource['id']]);
                if($camera->id == null) $camera->id = Str::uuid();
                $camera->name = $cameraResource['name'];
                $camera->lomo_id = $cameraResource['id'];
                $camera->save();
            }catch(\Exception $e){}

        }

        return "Success";
    }
}
