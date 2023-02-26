<?php

namespace Controller;

use App\Container\Container;
use App\Project\SaveProject;

use function Util\view;

class Free extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ./login');
            exit;
        }
    }

    public function show_top()
    {
        $container = new Container();
        $get_all = $container->get(\App\Project\GetAll::class);
        $project_list = $get_all->exec($_SESSION['user_id']);

        view('free_top.html', [
            'project_list' => $project_list,
        ]);
    }

    public function new_project()
    {
        view('new_project.html', [
            'dir_info' => [
                'index.php' => "<?php\n// code...",
                'css' => [
                    'style.css' => ''
                ]
            ]
        ]);
    }

    public function new_project_exec()
    {
        $error = $this->learn_exec([]);
        echo json_encode($error);
    }

    public function save()
    {
        var_dump($_POST);
        $project_name   = $_POST['project_name'];
        $file_info_json = $_POST['files_info'];
        $user_id        = $_POST['user_id'];
        $file_info_array = json_decode($file_info_json, true);

        foreach ($file_info_array as $file_info) {
            $content   = $file_info['content'];
            $file_path = $file_info['file_path'];

            // $content
            $this->file_put_contents(__DIR__ . "/../public/storage/{$user_id}/{$project_name}" . $file_path, $content);
        }

        $container = new Container();
        $save_project = $container->get(SaveProject::class);
        $save_project->exec($user_id, $project_name);
    }

    public function edit_project()
    {
        $id = $_GET['for'];
        $dir_info = $this->get_under_path(__DIR__ . "/../public/storage/{$id}");

        $explode = explode('/', $id);
        $name = $explode[1];
        view('edit_project.html', [
            'name' => $name,
            'dir_info' => $dir_info,
        ]);
    }

    public function update()
    {
        $project_name   = $_POST['project_name'];
        $file_info_json = $_POST['files_info'];
        $user_id        = $_POST['user_id'];
        $file_info_array = json_decode($file_info_json, true);

        $this->rm_rf(__DIR__ . "/../public/storage/{$user_id}/{$project_name}");
        foreach ($file_info_array as $file_info) {
            $content   = $file_info['content'];
            $file_path = $file_info['file_path'];

            // $content
            $this->file_put_contents(__DIR__ . "/../public/storage/{$user_id}/{$project_name}" . $file_path, $content);
        }
    }

    public function download()
    {
        $for = $_GET['for'];
        $filename = explode('/', $for)[1];

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.$filename.'.zip"');

        $path = __DIR__ . "/../public/storage/{$for}";
        $tmp_name = __DIR__ . '/a.zip';
        $this->zip($path, $tmp_name);
        echo file_get_contents($tmp_name, true);
        unlink($tmp_name);
    }
}
