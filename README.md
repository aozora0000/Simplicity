# Simplicityウェブフレームワーク

## どんなフレームワーク？
最新型のWebフレームワークはどれもMVC形式に則った構造なので、旧世代からのレガシーなPHPスクリプトから載せ替えるにはかなりの労力が必要でした。

そこでブラウザから.phpにアクセスする形式を踏襲したまま、ModelやViewを使う事を目的とした付け焼き刃的フレームワークを作ってみました。

## 機能一覧

### Loader ```src/Simplicity```
コンテナ内包のクラスを呼び出します。

#### 使い方
```
$container = new Pimple\Container;
$container['db'] = function() {
    return new PDO("sqlite::memory", null, null);
};
Loader::registContainer($container);
$model = Loader::getInstance('Simplicity\Model\Example');
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


### Model ```src/Simplicity/Model```
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
