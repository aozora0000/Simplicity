<?php
namespace Simplicity\Validate;
class Example implements ValidateInterface
{
    /**
     *  @required        IDは必須です。
     */
    public $id;

    /**
     *  @reuired                    作成日は必須です。
     *  @timestamp [Y-m-d H:i:s]    作成日は %s 形式のみです。
     */
    public $created_at;
}
