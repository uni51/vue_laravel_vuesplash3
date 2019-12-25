<?php
// Laravel のルーティングは上から記述順にリクエストにマッチするか探索される


// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');
