<?php
namespace Simplicity\Library\AnnotationValidator;
use \Simplicity\Library\AnnotationValidator\ConditionTraits as Traits;

class Conditions
{
    use Traits\Required;
    use Traits\Strings;
    use Traits\Operator;
    use Traits\Date;
    use Traits\Access;
    use Traits\Web;
    use Traits\Geometory;

    use Traits\Common;
}
