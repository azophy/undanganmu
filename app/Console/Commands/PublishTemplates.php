<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublishTemplates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link all template assets on storage/app/templates into public/assets folder';

    /**
     * Path of the template
     * @var string
     */
    protected $template_folder = __DIR__ . '/../../../storage/app/templates';
    protected $publish_folder = __DIR__ . '/../../../public/assets';

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

        //echo $this->publish_folder;

        // delete all links on public/assets/*
        foreach(glob($this->publish_folder . '/*') as $file){
            //echo $file;
            //unlink($file);
            if(is_dir($file)){
                echo "Deleting $file\n";
                unlink($file);
            }
        }

        // foreach foldername in storage_app_templates/*
        foreach(glob($this->template_folder . '/*') as $folder){
            $folder_single_name = basename($folder);
            //echo "\nBase folder name : ".$folder_single_name;
            if(is_dir($folder) && is_dir($folder.'/assets')){
                echo "linking folder $folder/assets\n";
                 symlink($folder.'/assets', $this->publish_folder.'/'.$folder_single_name);
            }
        }
        //     ln -s foldername/assets public/assets/foldername
    }
}
