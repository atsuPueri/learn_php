<?php

namespace Controller;

use App\Container\Container;
use App\Login\Exception\ExistsIdException;
use PDOException;

use function Util\view;

class Login extends Controller
{
    public function login()
    {
        view('login.html');
    }

    public function login_exec()
    {
        // $user_name = filter_input(INPUT_POST, 'user_name');
        $login_id  = filter_input(INPUT_POST, 'login_id');
        $password  = filter_input(INPUT_POST, 'password');

        $error = [];
        // if ($user_name === null || $user_name === '') {
        //     $error['user_name'] = 'ユーザー名を設定してください';
        // }
        if ($login_id === null || $login_id === '') {
            $error['login_id'] = 'ログインＩＤを入力してください';
        }
        if ($password === null || $password === '') {
            $error['password'] = 'パスワードを入力してください';
        }

        // エラー無し
        if (count($error) === 0) {
            $container = new Container();
            
            /** @var \App\Login\Login */
            $login = $container->get(\App\Login\UseCase\Login::class);
            try {
                $user_id = $login->exec($login_id, $password);
                if ($user_id !== -1) {

                    $_SESSION['user_id'] = $user_id;
                    header('Location: ./free');
                    exit;
                }
                $error['login'] = 'ログインID、もしくはパスワードが違います';
            } catch (\PDOException) {
                $error['login'] = 'サーバーエラーが発生しました、しばらくお待ちください。';
            }
        }

        view('login.html', [
            'error' => $error,
        ]);
    }

    public function sign_up()
    {
        view('sign_up.html');
    }

    public function sign_up_exec()
    {
        $user_name = filter_input(INPUT_POST, 'user_name');
        $login_id  = filter_input(INPUT_POST, 'login_id');
        $password  = filter_input(INPUT_POST, 'password');

        $error = [];
        if ($user_name === null || $user_name === '') {
            $error['user_name'] = 'ユーザー名を設定してください';
        }
        if ($login_id === null || $login_id === '') {
            $error['login_id'] = 'ログインＩＤを入力してください';
        }
        if ($password === null || $password === '') {
            $error['password'] = 'パスワードを入力してください';
        }

        // エラー無し
        if (count($error) === 0) {
            $container = new Container();
            
            /** @var \App\Login\SignUp */
            $sign_up = $container->get(\App\Login\UseCase\SignUp::class);
            try {
                $is_success_sign_up = $sign_up->exec($user_name, $login_id, $password);
                if ($is_success_sign_up === true) {
                    header('Location: ./free');
                    exit;
                }
            } catch (ExistsIdException $e) {
                $error['sign_up'] = $e->getMessage();
            } catch (PDOException) {
                $error['sign_up'] = 'サーバーエラーが発生しました、しばらくお待ちください。';
            }
        }

        view('sign_up.html', [
            'error' => $error,
        ]);
    }
}