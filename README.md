# Simplicityウェブフレームワーク

[![Build Status](https://travis-ci.org/aozora0000/Simplicity.svg)](https://travis-ci.org/aozora0000/Simplicity)

最新型のWebフレームワークはどれもMVC形式に則った構造なので、旧世代からのレガシーなPHPスクリプトから載せ替えるにはかなりの労力が必要でした。

そこでブラウザから.phpにアクセスする形式を踏襲したまま、ModelやViewを使う事を目的とした付け焼き刃的フレームワークを作ってみました。

- ユーティリティ系
- リクエスト系
- モデル
- ビュー
- バリデーション

# 主要機能一覧

## ユーティリティ系

### Loader ```Simplicity\Loader```
コンテナ内包のクラスを呼び出します。

#### 使い方
```
$container = new Pimple\Container;
$container['db'] = function() {
    return new PDO("sqlite::memory", null, null);
};
Simplicity\Loader::registContainer($container);
$model = Simplicity\Loader::getInstance('Simplicity\Model\Example');
```

#### プロパティ
名前 | 役割 | 備考
:----:|:----:|:----:
static::$container | コンテナを格納 | -

#### メソッド
名前 | 役割 | 備考
:----:|:----:|:----:
static::registContainer | コンテナを格納 | 引数にコンテナを格納する
static::getInstance | コンテナを引数にしたインスタンスを取得 | 呼び出す場合には要コンストラクタ引数

---

## リクエスト・レスポンス系

### Request ```Simplicity\Library\Http\Request```

***GET,POST,FILE*** 辺りの処理を行っています。

#### Request ```Simplicity\Library\Http\Request\Request```

GET,POSTのリクエストデータを取得できます。

##### 使い方
```
$id = Simplicity\Library\Http\Request\Request::get("id", null);
```

##### メソッド
名前 | 役割 | 備考
:----:|:----:|:----:
static::get | GET,POSTから特定の値を取得する | キー名,デフォルト値を引数に入れる
static::getAll | GET,POSTから値を全て取得する | デフォルト値(Array)を引数に入れる
static::map | 全てのGET,POSTの値を再帰的に加工する | 引数に変数・ラムダ関数・クロージャーを入れる
static::filter | 全てのGET,POSTの値を再帰的にフィルタリングする | 上に同じ

---

#### Method ```Simplicity\Library\Http\Request\Method```

リクエストメソッドを取得する

##### 使い方
```
if(Simplicity\Library\Http\Request\Method::isAjax()) {
    print "ajax!";
}
```

##### メソッド
名前 | 役割 | 備考
:----:|:----:|:----:
static::get | リクエストメソッドの取得 | -
static::isAjax | Ajaxリクエストの判定 | bool値で返却
---

### Response ```Simplicity\Library\Http\Respose```

---

### Cookie ```Simplicity\Library\Http\Session\Cookie```

---

### Session ```Simplicity\Library\Http\Session\Session```

---

## モデル

### Model ```Simplicity\Model\*```

PDOクラスを内包したクラスです。

***Simplicity\Model\Base***クラスを継承します。

#### 使い方

```
$example = Loader::getInstance('Simplicity\Model\Example');
$example->name = "Kohei Kinoshita";
$example->age  = 30;
$example->save();
```

#### プロパティ
 名前 | 役割 | 備考
:----:|:----:|:----:
$pdo | PDOドライバクラス | Container['db']から取得
$obj | Array | setter,getterを通して値を格納・取得します
$driver | ドライバ名 | mysqlやsqlite等、利用しているドライバを格納します
$table | テーブル名 | PHPクラス名を小文字化したテーブル名が格納されます

#### メソッド
 名前 | 役割 | 備考
:----:|:----:|:----:
__construct | プロパティ初期化 | 引数にPimple\Containerを想定しています
getbind | バインドパラメータ作成 | [[":{$key}": $value],]形式の配列を返します
getNextID | テーブルの次IDを返却 | 次のインクリメント値を返します

---

## ビュー

### View

各種テンプレートエンジンに対応したビューを利用出来ます。

テンプレートエンジンの切り替えはコンテナ格納時に行います。

***Simplicity\View\Base***抽象クラスを継承します。

#### 使い方
***bootstrap.php***
```
$container = new Pimple\Container;
$container['view.pc'] = function() use ($container) {
    \Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem(APP_DIR.'.templates/pc/');
    return new \Twig_Environment($loader);
};
$container['view.sp'] = function() use ($container) {
    \Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem(APP_DIR.'.templates/sp/');
    return new \Twig_Environment($loader);
};
```
***index.php***
```
$view  = Simplicity\Loader::getInstance("Simplicity\View\Twig");
$view->setEngine("view.pc");
$view->title = "インデックスページ";
$view->render(".index.html.twig");
```

#### プロパティ
 名前 | 内容 | 備考
:----:|:----:|:----:
$container | Container | Containerを格納
$obj | Array | setterを通してテンプレートエンジンにアサインする値を格納・取得します
$engine | Closure | 利用するテンプレートエンジンを決定します

#### メソッド
 名前 | 役割 | 備考
:----:|:----:|:----:
__construct | プロパティ初期化 | 引数にPimple\Containerを想定しています
setEngine | 利用するエンジンを決定します | Containerに格納した時のキー名を引数とします
*render | レンダリングを実行します | 抽象メソッドになっています。ファイル名を引数にレンダリングまで実行。

---

## バリデーション

フォームからの入力値や

### Validator ```Simplicity\Library\Annotationvalidator\Validator```
