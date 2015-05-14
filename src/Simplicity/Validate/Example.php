<?php
namespace Simplicity\Validate;
use Simplicity\Library\AnnotationValidator\Behavior;
class Example extends Behavior
{
    /**
     *  @required        @IDはひっすです。
     *  @numeric
     *  @range @[1,2]
     */
    public $id;

    /**
     *  @required
     *  @testValid
     *  @testVaildFailed
     *  @testValid @[1,2]
     *  @testVaildFailed @[1,2]
     *  @date            @[Y-m-d H:i:s]    @作成日は %s 形式のみです。
     */
    public $created_at;

    /**
     * @\Simplicity\Library\AnnotationValidator\Dummy\Behavior::true
     * @\Simplicity\Library\AnnotationValidator\Dummy\Behavior::false @[1,2]
     * @\Simplicity\Library\AnnotationValidator\Dummy\Behavior::hasTrue @Trueじゃないっす
     */
    public $true;
}
