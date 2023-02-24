<?php

namespace Controller;

use App\Container\Container;

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
        view('new_project');
    }

    public function new_project_exec()
    {

    }
}